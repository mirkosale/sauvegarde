<?php

class Database
{
    // Variable de classe
    private $connector;

    /**
     *  Méthode permettant de se connecter a la base de donnée avec PDO
     */
    public function __construct()
    {
    include('configDB.php');

        try {
            $this->connector = new PDO("mysql:host=$DB_SERVER;dbname=$DB_NAME;charset=utf8", $DB_USER, $DB_PASSWORD);
        } catch (PDOException $e) {
            die('Erreur : ' . $e->getMessage());
        }
        // Se connecter via PDO et utilise la variable de classe $connector
    }

    /**
     * Fonction permettant de gérer une requête MySQL simple (sans where)
     */
    private function querySimpleExecute($query)
    {
        $req = $this->connector->query($query);
        return $req;
    }

    /**
     * Fonction permettant de préparer, de binder et d’exécuter une requête (select avec where ou insert, update et delete)
     */
    private function queryPrepareExecute($query, $binds)
    {
        $req =  $this->connector->prepare($query);
        foreach ($binds as $key => $value) {
            $req->bindValue($value['name'], $value["value"], $value["type"]);
        }
        $req->execute();

        return $req;
    }

    /**
     * Traite les données pour les retourner par exemple en tableau associatif (avec PDO::FETCH_ASSOC)
     * Supprime la lisaison de la requête avec la DB en supprimant la requête
     */
    private function formatData($req)
    {
        $result = $req->fetchALL(PDO::FETCH_ASSOC);
        $this->unsetData($req);
        return $result;
    }

    /**
     * Fontion qui permet de vider le jeu d’enregistrement
     */
    private function unsetData($req)
    {
        $req->closeCursor();
    }

    /**
     * Méthode permettant de récupèrer toutes les informations de contact remplies
     */
    public function getAllInfo()
    {
        $queryRecipe = "SELECT idInfo, infName, infDescription FROM t_info";

        $reqRecipe = $this->querySimpleExecute($queryRecipe);

        $returnRecipe = $this->formatData($reqRecipe);

        return $returnRecipe;
    }

    /**
     * Méthode permettant de récupèrer une information selon l'ID de cette dernière
     */
    public function getOneInfo($id)
    {
        $queryOneRecipe
            = "SELECT * FROM t_info WHERE idInfo = :varId";
        $bindRecipe = array(
            array("name" => "varId", "value" => $id, "type" => PDO::PARAM_INT)
        );
        $reqRecipe = $this->queryPrepareExecute($queryOneRecipe, $bindRecipe);
        $returnRecipe = $this->formatData($reqRecipe);
        $this->unsetData($reqRecipe);
        return $returnRecipe;
    }

    /**
     * Méthode permettant d'ajouter des données à la base de données selon informations
     * récupérees dans le formulaire de contact et d'envoi de données
     */
    public function insertContact($contactData)
    {
        $query = "INSERT INTO t_contact (conName, conEmail, conPhoneNumber, conMessage) 
                  VALUES (:conName, :conEmail, :conPhoneNumber, :conMessage)";

        $binds = [
            ["name" => 'conName', 'value' => $contactData['name'], 'type' => PDO::PARAM_STR],
            ["name" => 'conEmail', 'value' => $contactData['email'], 'type' => PDO::PARAM_STR],
            ["name" => 'conPhoneNumber', 'value' => $contactData['phone'], 'type' => PDO::PARAM_STR],
            ["name" => 'conMessage', 'value' => $contactData['message'], 'type' => PDO::PARAM_STR]
        ];

        $req = $this->queryPrepareExecute($query, $binds);
        $this->unsetData($req);
    }

    /**
     * Méthode permettant d'ajouter des données à la base de données selon informations
     * récupérees dans le formulaire de contact et d'envoi de données
     */
    public function insertContactNoPhone($contactData)
    {
        $query = "INSERT INTO t_contact (conName, conEmail, conMessage) 
                  VALUES (:conName, :conEmail, :conMessage)";

        $binds = [
            ["name" => 'conName', 'value' => $contactData['name'], 'type' => PDO::PARAM_STR],
            ["name" => 'conEmail', 'value' => $contactData['email'], 'type' => PDO::PARAM_STR],
            ["name" => 'conMessage', 'value' => $contactData['message'], 'type' => PDO::PARAM_STR]
        ];

        $req = $this->queryPrepareExecute($query, $binds);
        $this->unsetData($req);
    }

    
}

?>