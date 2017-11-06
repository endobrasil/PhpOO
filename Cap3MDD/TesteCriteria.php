<?php
function __autoload($classe){
	if(file_exists("../app/ado/{$classe}.class.php"))
	{
		include_once "../app/ado/{$classe}.class.php";
		echo "include_once ../app/ado/{$classe}.class.php<br>\n";
	}
}
$criteria = new TCriteria;
$criteria->add(new TFilter('idade','<', 16),TExpression::OR_OPERADOR);
$criteria->add(new TFilter('idade','>', 60),TExpression::OR_OPERADOR);
echo $criteria->dump();
echo "<br>\n";

//$criteria = new TCriteria;
$criteria->add(new TFilter('idade','IN', array(25,24,26)));
$criteria->add(new TFilter('idade','not in', array(10)));
echo $criteria->dump();
echo "<br>\n";

//$criteria = new TCriteria;
$criteria->add(new TFilter('nome','like', 'pedro%'),TExpression::OR_OPERADOR);
$criteria->add(new TFilter('nome','like', 'maria%'),TExpression::OR_OPERADOR);
echo $criteria->dump();
echo "<br>\n";

//$criteria = new TCriteria;
$criteria->add(new TFilter('telefone','is not', null));
$criteria->add(new TFilter('sexo','=', 'f'));
echo $criteria->dump();
echo "<br>\n";

//$criteria = new TCriteria;
$criteria->add(new TFilter('UF','in', array('rs','sc','pr')));
$criteria->add(new TFilter('uf','not in', array('pi','ac')));
echo $criteria->dump();
echo "<br>\n";

$criteria1 = new TCriteria;
$criteria1->add(new TFilter('sexo', '=','f'));
$criteria1->add(new TFilter('idade','>', 18));
$criteria2 = new TCriteria;
$criteria2->add(new TFilter('sexo', '=','m'));
$criteria2->add(new TFilter('idade','<', 16));
$criteria->add($criteria1,TExpression::OR_OPERADOR);
$criteria->add($criteria2,TExpression::OR_OPERADOR);
echo $criteria->dump();
echo "<br>\n";
?>