<?php
/**
 * ETML
 * Auteur : Cindy Hardegger
 * Date: 22.01.2019
 * Controlleur pour gérer les différents messages de contacts
 */

include_once 'model/database.php';

class InfoController extends Controller {

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
    private function listAction() {
        $db = new Database();
        $infos = $db->getAllInfo();

        $view = file_get_contents('view/page/info/list.php');

        ob_start();
        eval('?>' . $view);
        $content = ob_get_clean();

        return $content;
    }

    private function detailAction()
    {
        #Check si l'ID de la recette a été mis
        if (!isset($_GET['id'])) {
            $view = file_get_contents('view/page/info/badInfo.php');
        }

        #Check si la recette avec l'ID correspondant existe
        if (isset($_GET['id'])) {
            $db = new Database();
            $info = $db->getOneInfo($_GET['id']);;

            if (!isset($info[0])) {
                $view = file_get_contents('view/page/info/badInfo.php');
            }
        }

        #Affichage de la page de détail si pas d'erreur
        if (!isset($view)) {
            $view = file_get_contents('view/page/info/detail.php');
        }

        ob_start();
        eval('?>' . $view);

        $content = ob_get_clean();

        return $content;
    }
    
}

?>