<?php
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

echo "<table border=1 width=600>";
echo "<tr bgcolor='#a0a0a0'>".
	"<td>Código</td>".
	"<td>Nome</td>".
	"<td>Endereço</td>".
	"<td>Telefone</td>".
	"<td>Cidade</td>".
	"</tr>";

$i=0;

foreach ($dados as $pessoa) {
	$bgcolor=($i%2)==0?'#d0d0d0':'#ffffff';
	echo "<tr bgcolor='$bgcolor'>".
		"<td>{$pessoa[0]}</td>".
		"<td>{$pessoa[1]}</td>".
		"<td>{$pessoa[2]}</td>".
		"<td>{$pessoa[3]}</td>".
		"<td>{$pessoa[4]}</td>".
		"<tr>";
		$i++;
}


?>

