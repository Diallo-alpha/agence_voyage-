<?php
require_once "config.php";

if(isset($_GET['id'])){
    $id = $_GET['id'];
}
$billet->deleteBillet($id);

header ('location: ReadBillet.php');
exit();


?>