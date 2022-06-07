<?php
    /**
     * ETML
     * Auteur	   : Mirko Sale
     * Date		   : 31.05.2022
     * Description : Fichier de constantes pour la connexion à l'API de Sendinblue
     */

   
    $api_key = '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';

    $from_email = 'mirko.sale@eduvaud.com';
    $from_name = 'Nora Sale';
    $to_email = 'mirko.sale@eduvaud.com';
    $to_name = 'Nora Encore';
    $subject = 'Bienvenue dans le mail !';
    $message = '<h2>LE TITRE</h2><p>Here goes the paragraph blah blah blah</p>';

    include("./resources/vendor/autoload.php");
    include("./resources/V2.0/Mailin.php'");


    $mailin = new Mailin('https://api.sendinblue.com/v2.0',$api_key);
 
    /**
    Le message de succès sera renvoyé sous cette forme:
    {'result' => true, 'message' => 'Email envoyé'}
    */


    // // Configure API key authorization: api-key
    // $config = SendinBlue\Client\Configuration::getDefaultConfiguration()->setApiKey('api-key', "$api_key");
    // // Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
    // // $config = SendinBlue\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('api-key', 'Bearer');
    // // Configure API key authorization: partner-key
    // $config = SendinBlue\Client\Configuration::getDefaultConfiguration()->setApiKey('partner-key', "$api_key");
    // // Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
    // // $config = SendinBlue\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('partner-key', 'Bearer');

    // $apiInstance = new SendinBlue\Client\Api\AccountApi(
    //     // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    //     // This is optional, `GuzzleHttp\Client` will be used as default.
    //     new GuzzleHttp\Client(),
    //     $config
    // );

    // try {
    //     $result = $apiInstance->getAccount();
    //     # print_r($result);
    // } catch (Exception $e) {
    //     echo 'Exception when calling AccountApi->getAccount: ', $e->getMessage(), PHP_EOL;
    // }


    // $mailin = new Mailin('https://api.sendinblue.com/v2.0',$api_key);
    // $data = array( 
    // "to" => array($to_email=>$to_name),
    // "from" => array($from_email,$from_name),
    // "subject" => $subject,
    // "html" => $message,
    // "attachment" => array()
    // );
    // $response = $mailin->send_email($data);
    // if(isset($response['code']) && $response['code']=='success'){
    // echo 'Email Sent';
    // }else{
    // echo 'Email not sent';
    // }
  

    /**
    *    Le message de succès sera renvoyé sous cette forme:
    *    {'result' => true, 'message' => 'Email envoyé'}
    */
?>