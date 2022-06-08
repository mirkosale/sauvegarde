<?php

  /**
   * ETML
   * Auteur	   : Mirko Sale
   * Date		   : 31.05.2022
   * Description : Fichier de constantes pour la connexion à l'API de Sendinblue
   */

  $from_email = 'mirko.sale@eduvaud.com';
  $from_name = 'Nora Sale';
  $to_email = 'nora.sale@outlook.com';
  $to_name = 'Nora Encore';
  $subject = 'Salut moi !';
  $message = '<h2>LE TITRE</h2><p>Here goes the paragraph blah blah blah</p>';

  include("./resources/vendor/autoload.php");
  $api_key = file_get_contents('./model/api_key.txt');

  // Configure API key authorization: api-key
  $config = SendinBlue\Client\Configuration::getDefaultConfiguration()->setApiKey('api-key', "$api_key");
  // Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
  // $config = SendinBlue\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('api-key', 'Bearer');
  // Configure API key authorization: partner-key
  $config = SendinBlue\Client\Configuration::getDefaultConfiguration()->setApiKey('partner-key', "$api_key");
  // Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
  // $config = SendinBlue\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('partner-key', 'Bearer');

  $apiInstance = new SendinBlue\Client\Api\TransactionalEmailsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
  );

  $sendSmtpEmail = new \SendinBlue\Client\Model\SendSmtpEmail();
  $sendSmtpEmail['subject'] = "$subject";
  $sendSmtpEmail['htmlContent'] = "$message";
  $sendSmtpEmail['sender'] = array('name' => "$from_name", 'email' => "$from_email");
  $sendSmtpEmail['to'] = array(
  array('email' => "$to_email", 'name' => "$to_name")
  );

  
try {
  $result = $apiInstance->sendTransacEmail($sendSmtpEmail);
  } catch (Exception $e) {
  echo 'Exception when calling TransactionalEmailsApi->sendTransacEmail: ', $e->getMessage(), PHP_EOL;
  }
  var_dump($result);
?>