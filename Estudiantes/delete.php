<?php
include '../helpers/utilities.php';
session_start();

$heroes = $_SESSION['estudiantes'];

if(isset($_GET['id'])){
    $heroId = $_GET['id'];

    $elementIndex = getIndexElement($heroes,'id',$heroId);

    unset($heroes[$elementIndex]);

    $_SESSION['estudiantes'] = $heroes;
}

header("Location: ../index.php");
exit();

?>