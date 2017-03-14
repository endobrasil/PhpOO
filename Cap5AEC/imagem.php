<?php
include_once "../app.widgets/TElement.class.php";
include_once "../app.widgets/TImage.class.php";
include_once "../app.widgets/TImage2.class.php";

$burra = new TImage('../app.img/burra.png');
$burra->show();

$pinguin = new TImage2('../app.img/pinguin.png');
$pinguin->show();
?>