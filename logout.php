<?php 
include_once 'user_session.php';

$userSession = new UserSession();
$userSession->closeSession();
header("Location: /index.php");

?>