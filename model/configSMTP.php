<?php
  /**
   * ETML
   * Auteur	   : Mirko Sale
   * Date		   : 31.05.2022
   * Description : Fichier de configuration pour la connexion à l'API de Sendinblue
   */

  $from_email = 'mirko.sale@eduvaud.com';
  $from_name = 'Retour contact Sauvegarde';
  $to_email = 'mirkosale@outlook.com';
  $to_name = 'Mirko Sale';

  include("./resources/vendor/autoload.php");
  $api_key = file_get_contents('./model/api_key.txt');

  $config = SendinBlue\Client\Configuration::getDefaultConfiguration()->setApiKey('api-key', "$api_key");
  $config = SendinBlue\Client\Configuration::getDefaultConfiguration()->setApiKey('partner-key', "$api_key");

  $apiInstance = new SendinBlue\Client\Api\TransactionalEmailsApi(
    new GuzzleHttp\Client(),
    $config
  );
?>