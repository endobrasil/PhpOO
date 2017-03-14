<?php
include_once "../app.widgets/TElement.class.php";
include_once "../app.widgets/TParagraph.class.php";

$text1=new TParagraph('teste1<b>test1</b>teste1');
$text1->set_aling('left');

$text1->show();

$text2=new TParagraph('teste2<br>teste2<br>teste2');
$text2->set_aling('right');
$text2->show();
?>