<?php
require_once '../vendor/autoload.php';
session_start();
$fb = new Facebook\Facebook([
    'app_id' => '327102486769135',
    'app_secret' => '380402fccaa88b39dbf6b63d6fc0c446',
    'default_graph_version' => 'v12.0',
]);

$helper = $fb->getRedirectLoginHelper();

try {
    $accessToken = $helper->getAccessToken();
} catch (Facebook\Exception\ResponseException $e) {
    // Handle error
} catch (Facebook\Exception\SDKException $e) {
    // Handle error
}
$_SESSION['fb_access_token'] = $accessToken;
if (isset($accessToken)) {
    // Logged in
    // Get user details
    try {
        $response = $fb->get('/me?fields=id,name,email', $accessToken);
        $user = $response->getGraphUser();
        $userId = $user->getId();
        $userName = $user->getName();
        $userEmail = $user->getEmail();
       
        $_SESSION['userName'] = $userName;
        $_SESSION['userEmail'] = $userEmail;
        // You can use the user details as required, e.g., store in database, set session, etc.
        // Example: $_SESSION['user'] = ['id' => $userId, 'name' => $userName, 'email' => $userEmail];

        // Redirect to a logged-in page or perform further actions
        header('Location: ./Home.php');
        exit();
    } catch (Facebook\Exception\FacebookResponseException $e) {
        // Handle error
    } catch (Facebook\Exception\FacebookSDKException $e) {
        // Handle error
    }
}

// If user denies permissions or something goes wrong, redirect to login page
header('Location: ./Home.php');
exit();