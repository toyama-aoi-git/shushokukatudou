<?php
require_once "../../config.php";
session_start();

if(isset($_GET['login'])){
    setcookie('id', $_SESSION['id'], time() + 24 * 60);
    unset($_SESSION['id']);
    header("location:index.php");
    exit;
}
require_once "./tmp/regi_comp.php";

?>