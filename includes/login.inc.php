<?php

include 'db_connection.php';

function getPassword() {
    $dbo = db_connect_PDO();
    $stmt = $dbo->prepare('SELECT password FROM security');
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    return $row['password'];
}

if(!isset($_POST['password'])) {
    header('location: ../index.php');
    exit;
} else {
    if(password_verify($_POST['password'], password_hash(getPassword(), PASSWORD_DEFAULT))) {
        session_start();
        $_SESSION['logged'] = true;
        header('location: ../index.php');
        exit;
    } else {
        header('location: ../login.php?error=wrong_password');
        exit;
    }
}

