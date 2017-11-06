<?php
function __autoload($classe){
	if(file_exists("../app/ado/{$classe}.class.php"))
	{
		include_once "../app/ado/{$classe}.class.php";
		echo "include_once ../app/ado/{$classe}.class.php<br>\n";
	}
}
$filtro = new TFilter('data', '=', '2007-06-02');
echo $filtro->dump();
echo "<br>\n";

$filtro2 = new TFilter('salario','>', 3000);
echo $filtro2->dump();
echo "<br>\n";

$filtro3 = new TFilter('sexo','IN', array('M', 'F'));
echo $filtro3->dump();
echo "<br>\n";

$filtro4 = new TFilter('contato','IS NOT', NULL);
echo $filtro4->dump();
echo "<br>\n";

$filtro5 = new TFilter('ATIVO','=', TRUE);
echo $filtro5->dump();
echo "<br>\n";
?>