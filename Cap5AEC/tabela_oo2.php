<?php
function __autoload($classe){
	if(file_exists("../app.widgets/{$classe}.class.php"))
	{
		include_once "../app.widgets/{$classe}.class.php";
		echo "include_once ../app.widgets/{$classe}.class.php<br>\n";
	}
}


$dados[]=array( 3 , 'Daline Dall Oglio' , 'Rua da ConceiÃ§Ã£o'  , '(51) 1111-2222'   , 'Cruzeiro do Sul');
$dados[]=array( 4 , 'William Scatolla'  , 'Rua de FÃ¡tima'      , '(51) 1111-4444'   , 'Encantado');
$dados[]=array( 5 , 'Daline Dall Oglio' , 'Rua da ConceiÃ§Ã£o'  , '(51) 1111-2222'   , 'Cruzeiro do Sul');
$dados[]=array( 6 , 'William Scatolla'  , 'Rua de FÃ¡tima'      , '(51) 1111-4444'   , 'Encantado');
$dados[]=array( 7 , 'FÃ¡bio Locatelli'  , 'Rua Merlin'          , '(51) 9 2222-1111' , 'Largeiro');
$dados[]=array( 8 , 'JÃºlia Locatelli'  , 'Rua Merlin'          , '(51) 9 2222-1111' , 'Largeiro');
$dados[]=array( 9 , 'FÃ¡bio Locatelli'  , 'Rua Merlin'          , '(51) 9 2222-1111' , 'Largeiro');
$dados[]=array(10 , 'JÃºlia Locatelli'  , 'Rua Merlin'          , '(51) 9 2222-1111' , 'Largeiro');
$dados[]=array(11 , 'Carlos Ranzi'      , 'Rua Francisco Oscar' , '(89) 9 7786.1234' , 'fortaleza');
$dados[]=array(12 , 'Carlos Ranzi'      , 'Rua Francisco Oscar' , '(89) 9 7786.1234' , 'fortaleza');

$table = new TTable;
$table->width=600;
$table->border=1;

$cabecalho=$table->addRow();
$cabecalho->bgcolor='#a0f0d0';

$cabecalho->addCell('Código');
$cabecalho->addCell('Nome');
$cabecalho->addCell('Endereço');
$cabecalho->addCell('Telefone');
$cabecalho->addCell('Cidade');

$i=0;

foreach ($dados as $pessoa) {
	$bgcolor=($i%2)==0?'#d0d0d0':'#ffffff';

	$linha=$table->addRow();
	$linha->bgcolor=$bgcolor;

	$linha->addCell($pessoa[0]);
	$linha->addCell($pessoa[1]);
	$linha->addCell($pessoa[2]);
	$linha->addCell($pessoa[3]);
	$linha->addCell($pessoa[4]);

	$i++;
}

$table->show();

$table = new TTable;
$linha = $table->addRow();
$paragrafo=new TParagraph("este é o logo do Dragão!!!");
$paragrafo->set_aling('left');
$linha->addCell($paragrafo);

$imagem=new TImage('../app.img/dragao.png');
$imagem->height=120;
$imagem->weight=120;
$linha->addCell($imagem);

$linha = $table->addRow();
$paragrafo=new TParagraph("este é o logo do Tigre!!!");
$paragrafo->set_aling('left');
$linha->addCell($paragrafo);

$imagem=new TImage('../app.img/tigre.png');
$imagem->height=120;
$imagem->weight=120;
$linha->addCell($imagem);

$linha = $table->addRow();
$paragrafo=new TParagraph("este é o logo do Verminho!!!");
$paragrafo->set_aling('left');
$linha->addCell($paragrafo);

$imagem=new TImage('../app.img/verme.png');
$imagem->height=120;
$imagem->weight=120;
$linha->addCell($imagem);

$table->show();
?>

