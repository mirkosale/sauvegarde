<?php
/**
 * Auteur : Cindy Hardegger
 * Date: 22.01.2019
 * Contrôleur principal
 */

include_once 'model/database.php';

abstract class Controller {

    /**
     * Méthode permettant d'appeler l'action 
     *
     * @return mixed
     */
    public function display() {

        $page = $_GET['action'] . "Display";

        $this->$page();
    }
}