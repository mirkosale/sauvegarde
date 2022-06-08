<?php
/**
 * ETML
 * Auteur : Cindy Hardegger
 * Date: 22.01.2019
 * Controlleur pour gérer les différents messages de contacts
 */

include_once 'model/database.php';
include_once 'model/configSMTP.php';

class ContactController extends Controller {

    /**
     * Permet de choisir l'action à effectuer
     *
     * @return mixed
     */
    public function display() {

        $action = $_GET['action'] . "Action";

        // Appelle une méthode dans cette classe (ici, ce sera le nom + action (ex: listAction, detailAction, ...))
        return call_user_func(array($this, $action));
    }

    /**
     * Display Contact Action
     *
     * @return string
     */
    private function contactAction() {

        $view = file_get_contents('view/page/contact/contact.php');

        ob_start();
        eval('?>' . $view);
        $content = ob_get_clean();

        return $content;
    }

    /**
     * Check Form action
     *
     * @return string
     */
    private function checkContactAction() {
        //Vérification de si l'utilisateur a bel et bien utilisé le formulaire pour accéder à la page
        if (isset($_POST['btnSubmit'])) {

            $errors = array();

            #Récupération et filtrage de toutes les informations entrées dans la page de contact
            $name = trim(htmlspecialchars($_POST["name"]));
            $email = trim(htmlspecialchars($_POST["email"]));
            $phoneNumber = trim(htmlspecialchars($_POST["phone"]));
            $message = trim(htmlspecialchars($_POST["message"]));

            #Check de si toutes les informations entrées ne sont pas vides
            if (!isset($name) || empty($name)) {
                $errors[] = "Vous devez entrer un nom";
            }

            if (!isset($email) || empty($email)) {
                $errors[] = "Vous devez entrer un email";
            }

            #Check de si le numéro de téléphone contient uniquement des bons symboles et est au moins de 3 de long et qu'il ne soit pas plus long que 20 caractères
            if (isset($phoneNumber) && !empty($phoneNumber) && !preg_match("/^[+]{0,1}[0-9-()]{3,19}$/", $phoneNumber)) {
                $errors[] = "Vous devez entrer un numéro de téléphone qui fait au minimum 5 de longueur avec uniquement des chiffres et des +, / et -";
            }
            if (!isset($message) || empty($message)) {
                $errors[] = "Vous devez entrer un message";
            }

            #Retour à l'accueil si aucune erreur
            if (empty($errors)) {
                $contactData["name"] = $name;
                $contactData["email"] = $email;
                $contactData["message"] = $message;

                $db = new Database();

                #Check de si l'utilisateur a rentré un numéro de téléphone ou non
                if (!isset($phoneNumber) || empty($phoneNumber))
                {
                    $db->insertContactNoPhone($contactData);
                }
                else
                {
                    $contactData["phone"] = $phoneNumber;

                    $db->insertContact($contactData);
                }

                $view = file_get_contents('view/page/home/index.php');
            } else {
                $view = file_get_contents('view/page/contact/errors.php');
            }
        } else {
            $view = file_get_contents('view/page/contact/noSubmit.php');
        }

        ob_start();
        eval('?>' . $view);
        $content = ob_get_clean();
        return $content;
    }
}

?>