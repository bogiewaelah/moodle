<?php

if (isset($_POST['regId']) && isset($_POST['message'])) {
    $regId = $_POST['regId'];
    $message = $_POST['message'];
    
    require_once './GCM.php';
    $gcm = new GCM();
    echo $gcm->sendNotification(array($regId), array('code' => $message));
}