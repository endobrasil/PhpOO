<?php
include_once "../app.widgets/TElement.class.php";
include_once "../app.widgets/TStyle.class.php";

$estilo1=new TStyle('texto');
$estilo1->color='#ff0000';
$estilo1->font_family='Verdana';
$estilo1->font_size='20pt';
$estilo1->font_weight='bold';
$estilo1->show();

$p=new TElement('p');
$p->align='center';
$p->add('O homem da vida dela é quem ela escolher.');

$p->class='texto';
$p->show();
?>