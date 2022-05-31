<!--
ETML 
Author : Kandasamy Pruthvin, Tim Froidevaux, Dylan Bontems, Mirko Sale
Date   : 28.02.2022
Description: les données sont traitées et affichées directement dans la page d’accueil.
 Mais, nous allons créer plusieurs pages avec des liaisons à la BD. A terme, nous ne voulons pas recopier toujours les mêmes instructions.
 De ce fait, nous allons créer une classe afin de regrouper les méthodes nécessaires à nos requêtes.
-->
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
        require('config.php');

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
     * Méthode permettant de récupèrer tout les recettes
     */
    public function getAllRecipe()
    {
        $queryRecipe = "SELECT *  FROM t_recipe";

        $reqRecipe = $this->querySimpleExecute($queryRecipe);

        $returnRecipe = $this->formatData($reqRecipe);

        return $returnRecipe;
    }

    /**
     * Méthode qui permet de récupérer les recettes seuelement d'un certain type de plats
     */
    public function getAllRecipeSort($id)
    {
        $queryOneRecipe
            = "SELECT * FROM t_recipe WHERE fkTypeDish = :varId";
        $bindRecipe = array(
            array("name" => "varId", "value" => $id, "type" => PDO::PARAM_INT)
        );
        $reqRecipe = $this->queryPrepareExecute($queryOneRecipe, $bindRecipe);
        $returnRecipe = $this->formatData($reqRecipe);
        $this->unsetData($reqRecipe);
        return $returnRecipe;
    }

    /**
     * Fonction qui retourne la dernière ajoutée à la base de données
     */
    public function getLatestRecipe()
    {
        $queryRecipe = "SELECT idRecipe, recName,recListOfItems,recPreparation,recImage  FROM t_recipe ORDER BY idRecipe desc limit 1";
        $reqRecipe = $this->querySimpleExecute($queryRecipe);

        $returnRecipe = $this->formatData($reqRecipe);
        $this->unsetData($reqRecipe);
        return $returnRecipe;
    }
    /**
     * Méthode permettant de récupèrer un recette selon l'ID de cette dernière
     */
    public function getOneRecipe($id)
    {
        $queryOneRecipe
            = "SELECT * FROM t_recipe INNER JOIN t_typedish ON t_recipe.fkTypeDish = t_typedish.idTypeDish WHERE idRecipe=:varId";
        $bindRecipe = array(
            array("name" => "varId", "value" => $id, "type" => PDO::PARAM_INT)
        );
        $reqRecipe = $this->queryPrepareExecute($queryOneRecipe, $bindRecipe);
        $returnRecipe = $this->formatData($reqRecipe);
        $this->unsetData($reqRecipe);
        return $returnRecipe;
    }

    /**
     * Méthode permettant d'ajouter un recette à la base de données selon informations
     * récupérees dans le formulaire d'ajout
     */
    public function InsertRecipe($recipeData)
    {
        $query = "INSERT INTO t_recipe (recName, fkTypeDish, recListOfItems, recPreparation, recImage) 
                  VALUES (:name, :typedish, :itemList, :preparation, :image)";

        $binds = [
            ["name" => 'name', 'value' => $recipeData['name'], 'type' => PDO::PARAM_STR],
            ["name" => 'itemList', 'value' => $recipeData['itemList'], 'type' => PDO::PARAM_STR],
            ["name" => 'preparation', 'value' => $recipeData['preparation'], 'type' => PDO::PARAM_STR],
            ["name" => 'image', 'value' => $recipeData['image'], 'type' => PDO::PARAM_LOB],
            ["name" => 'typedish', 'value' => $recipeData['typedish'], 'type' => PDO::PARAM_INT]
        ];

        $req = $this->queryPrepareExecute($query, $binds);
        $this->unsetData($req);
    }

    /**
     * Méthode permettant de modifier un recette selon les informations entrées dans le 
     * formulaire de modification d'une recette
     */
    public function modifyRecipe($recipeData)
    {
        $query = "UPDATE t_recipe SET recName =  :name, recListOfItems = :itemList, recPreparation = :preparation,
                     recImage = :image, fkTypeDish = :typedish WHERE t_recipe.idRecipe = :id";

        $binds = [
            ["name" => 'name', 'value' => $recipeData['name'], 'type' => PDO::PARAM_STR],
            ["name" => 'itemList', 'value' => $recipeData['itemList'], 'type' => PDO::PARAM_STR],
            ["name" => 'preparation', 'value' => $recipeData['preparation'], 'type' => PDO::PARAM_STR],
            ["name" => 'image', 'value' => $recipeData['image'], 'type' => PDO::PARAM_STR],
            ["name" => 'typedish', 'value' => $recipeData['typedish'], 'type' => PDO::PARAM_INT],
            ["name" => 'id', 'value' => $recipeData['id'], 'type' => PDO::PARAM_INT]
        ];

        $this->queryPrepareExecute($query, $binds);
    }

    /**
     * Méthode permettant de modifier un recette si l'utilisateur (sans image)
     */
    public function modifyRecipeNoImage($recipeData)
    {
        $query = "UPDATE t_recipe SET recName =  :name, recListOfItems = :itemList, recPreparation = :preparation, fkTypeDish = :typedish WHERE t_recipe.idRecipe = :id";

        $binds = [
            ["name" => 'name', 'value' => $recipeData['name'], 'type' => PDO::PARAM_STR],
            ["name" => 'itemList', 'value' => $recipeData['itemList'], 'type' => PDO::PARAM_STR],
            ["name" => 'preparation', 'value' => $recipeData['preparation'], 'type' => PDO::PARAM_STR],
            ["name" => 'typedish', 'value' => $recipeData['typedish'], 'type' => PDO::PARAM_INT],
            ["name" => 'id', 'value' => $recipeData['id'], 'type' => PDO::PARAM_INT]
        ];

        $req = $this->queryPrepareExecute($query, $binds);
        $this->unsetData($req);
    }

    /**
     * Méthode permettant de supprimer une recette selon son ID
     */
    public function deleteRecipe($idRecipe)
    {
        $query = 'DELETE FROM t_recipe WHERE idRecipe = :idRecipe';

        $binds = [
            ["name" => "idRecipe", "value" => $idRecipe, "type" => PDO::PARAM_INT]
        ];
        $req = $this->queryPrepareExecute($query, $binds);
        $result = $this->formatData($req);
        $this->unsetData($req);

        return $result;
    }

    /**
     * Méthode permettant de récupérer les types de plats (entrées, desserts)
     */
    public function getTypes()
    {
        $query = 'SELECT * FROM t_typedish';
        $req = $this->querySimpleExecute($query);

        return $this->formatData($req);
    }

    /**
     * Méthode permettant de récupérer tous les utilisateurs présents dans la base de données
     */
    public function getAllUsers()
    {
        //récupère un utilisateur de la BD
        //avoir la requête sql
        //appeler la méthode pour executer la requête
        $query = 'SELECT * FROM t_user';

        $req = $this->querySimpleExecute($query);

        $result = $this->formatData($req);

        return $result;
    }

    /**
     * Méthode permettant de récupérer un utilisateur selon son ID
     */
    public function getUser($idUser)
    {
        $query = 'SELECT * FROM t_user WHERE idUser = :idUser';
        $binds = [
            ["name" => "idUser", "value" => $idUser, "type" => PDO::PARAM_INT]
        ];
        $req = $this->queryPrepareExecute($query, $binds);

        return $this->formatData($req);
    }

    /**
     * Méthode permettant de récupérer les information d'un utilisateur selon son nom
     */
    public function getLoggedUserID($userName)
    {
        $query = 'SELECT idUser FROM t_user WHERE useLogin = :userName';
        $binds = [
            ["name" => "userName", "value" => $userName, "type" => PDO::PARAM_STR]
        ];
        $req = $this->queryPrepareExecute($query, $binds);

        return $this->formatData($req);
    }

    /**
     * Méthode qui va regarder toutes les notes pour une recette et retourner la moyenne de toutes les notes
     */
    public function getRecipeNoteAverage($idRecipe)
    {
        $query = "SELECT AVG(notStars) FROM t_note WHERE fkRecipe = :idRecipe";
        $binds = [
            ["name" => 'idRecipe', 'value' => $idRecipe, 'type' => PDO::PARAM_INT]
        ];

        $req = $this->queryPrepareExecute($query, $binds);
        $note = $this->formatData($req);

        return $note;
    }

    /**
     * Méthode qui retourne l'utilisateur qui a entré la note de la recette
     */
    public function getNoteUser($idNote)
    {
        $query = "SELECT fkUser FROM t_note WHERE idNote = :idNote";
        $binds = [
            ["name" => 'idNote', 'value' => $idNote, 'type' => PDO::PARAM_INT]
        ];

        $req = $this->queryPrepareExecute($query, $binds);
        $note = $this->formatData($req);

        return $note;
    }

    /**
     * Va regarder si une certaine note existe par un utilisateur sur une recette
     */
    public function getRecipeNoteOfUser($idRecipe, $userName)
    {
        $query = "SELECT * FROM t_note AS n INNER JOIN t_user AS u ON u.idUser = n.fkUser WHERE fkRecipe = :idRecipe AND u.useLogin = :userName";
        $binds = [
            ["name" => 'idRecipe', 'value' => $idRecipe, 'type' => PDO::PARAM_INT],
            ["name" => 'userName', 'value' => $userName, 'type' => PDO::PARAM_STR]
        ];

        $req = $this->queryPrepareExecute($query, $binds);
        $note = $this->formatData($req);

        return $note;
    }

    /**
     * Methode permettant d'ajouter une note à une recette avec un certain nombre d'étoiles
     */
    public function addNote($starNB, $idRecipe, $idUser)
    {
        $query = "INSERT INTO t_note (notStars, fkRecipe, fkUser) VALUES (:starNB, :idRecipe, :idUser)";
        $binds = [
            ["name" => 'starNB', 'value' => $starNB, 'type' => PDO::PARAM_INT],
            ["name" => 'idRecipe', 'value' => $idRecipe, 'type' => PDO::PARAM_INT],
            ["name" => 'idUser', 'value' => $idUser, 'type' => PDO::PARAM_INT]
        ];

        $req = $this->queryPrepareExecute($query, $binds);
        $this->unsetData($req);
    }

    /**
     * Méthode permettant de supprimer une note
     */
    public function deleteNote($idNote)
    {
        $query = 'DELETE FROM t_note WHERE idNote = :idNote';

        $binds = [
            ["name" => "idNote", "value" => $idNote, "type" => PDO::PARAM_INT]
        ];

        $req = $this->queryPrepareExecute($query, $binds);
        $this->unsetData($req);
    }


    /**
     * Méthode permettant de retourner tous les types de plats
     */
    public function getAllTypedish()
    {
        $query = "SELECT * FROM t_typedish";

        $req = $this->querySimpleExecute($query);
        $session = $this->formatData($req);

        $this->unsetData($req);

        return $session;
    }

    /**
     * Méthode qui permet de faire une recherche dans la base de donnée depuis une barre de recherche
     */
    public function searchRecipe($recName)
    {
        $query = 'SELECT * FROM t_recipe WHERE recName LIKE :search';
        $binds = [
            ["name" => 'search', 'value' => "%$recName%", 'type' => PDO::PARAM_STR]
        ];

        $req = $this->queryPrepareExecute($query, $binds);
        $result = $this->formatData($req);

        return $result;
    }
}

?>