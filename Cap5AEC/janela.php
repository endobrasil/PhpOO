<?php
function __autoload($classe){
	if(file_exists("../app.widgets/{$classe}.class.php"))
	{
		include_once "../app.widgets/{$classe}.class.php";
		echo "include_once ../app.widgets/{$classe}.class.php<br>\n";
	}
}

$janela1=new TWindow('janela1');
$janela1->setPosition(20,20);
$janela1->setSize(200,200);
$janela1->add(new TParagraph('Conteúdo da janela1'));
$janela1->show();

$janela2=new TWindow('janela2');
$janela2->setPosition(300,20);
$janela2->setSize(200,200);
$img = new TImage('../app.img/porco.png');
$img->height='120';
$img->width='90';
$janela2->add($img);
$janela2->show();

$painel=new TPainel(210,130);
$painel->put(new TParagraph('<b>texto1</b>'),20,20);
$img = new TImage('../app.img/sereia.png');
$img->height='120';
$img->width='90';
$painel->put($img,80,20);

$janela3=new TWindow('janela3');
$janela3->setPosition(140,120);
$janela3->setSize(220,160);
$janela3->add($painel);
$janela3->show();
?>