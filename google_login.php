<?php
session_start();

require_once 'vendor/autoload.php';

$clientID = '683718431094-hiso8bps2oq92v5doevm4omqvjf35adk.apps.googleusercontent.com';
$clientSecret = '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';
$redirectURI = 'http://localhost:80'; 

$client = new Google_Client();
$client->setClientId($clientID);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($redirectURI);
$client->addScope('email');
$client->addScope('profile');

if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $client->setAccessToken($token);

    $oauth = new Google_Service_Oauth2($client);
    $userData = $oauth->userinfo->get();

    $_SESSION['user_id'] = $userData->id;
    $_SESSION['username'] = $userData->name;

    header("Location: index.php");
    exit();
} else {
    $authURL = $client->createAuthUrl();
    header("Location: $authURL");
    exit();
}
?>