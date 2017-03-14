<?php
include_once "../app.widgets/TElement.class.php";

$html=new TElement('html');
$head=new TElement('head');
$html->add($head);
$title=new TElement('title');
$title->add('Título da página');
$head->add($title);

$body=new TElement('body');
$body->gbcolor="#ffffdd";
$html->add($body);
$center =new TElement('center');
$body->add($center);

$p=new TElement('p');
$p->align='center';
$p->add('O homem da vida dela é quem ela escolher.');
$center->add($p);

$img=new TElement('img');
$img->src='../app.img/dancarina.png';
$img->width='120';
$img->height='120';
$center->add($img);

$hr =new TElement('hr');
$hr->width='150';
$hr->aling='center';
$center->add($hr);

$a=new TElement('a');
$a->href='http://www.dancaria.edu.br';
$a->add('Visite o site oficial');
$center->add($a);

$br=new TElement('br');
$center->add($br);

$input=new TElement('input');
$input->type='button';
$input->value='Clique aki...';
$input->onclick="alert('Clude das dancarinas felizes não...')";
$center->add($input);

$html->show();
?>