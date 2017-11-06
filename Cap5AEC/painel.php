<?php
function __autoload($classe){
	if(file_exists("../app/widgets/{$classe}.class.php"))
	{
		include_once "../app/widgets/{$classe}.class.php";
		echo "include_once ../app/widgets/{$classe}.class.php<br>\n";
	}
}

$painel = new TPanel(400,300);
$texto=new TParagraph('isso é um teste, x:10,y:10');
$painel->put($texto,10,10);

$texto=new TParagraph('outro teste, x:200,y:200');
$painel->put($texto,200,200);

$imagem = new TImage('../app/img/porco.png');
$imagem->height=120;
$imagem->width=120;
$painel->put($imagem,150,90);

$imagem = new TImage('../app/img/outroMundo.png');
$imagem->height=120;
$imagem->width=120;
$painel->put($imagem,12,60);

$painel->show();

?>