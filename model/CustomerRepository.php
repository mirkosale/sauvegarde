<?php
/**
 * ETML
 * Auteur : Cindy Hardegger
 * Date: 22.01.2019
 * Recueil des méthodes permettant de charger les données pour les clients
 */

include_once 'Entity.php';

class CustomerRepository implements Entity {

    /**
     * Récupérer tous les clients
     *
     * @return array
     */
    public function findAll() {

        include './data/customers.php';

        return $customers;

    }

    /**
     * Find One entry
     *
     * @param $idProduct
     *
     * @return array
     */
    public function findOne($idCustomer) {

        include './data/customers.php';
        
        $customerCurrent = array();

        // Boucler sur tous les clients et sélectionner seulement celui que l'on veut afficher
        foreach($customers as $customer) {

            if($customer['idContact'] == $idCustomer){
                $customerCurrent = $customer;
            }
        }

        return $customerCurrent;
    }


}