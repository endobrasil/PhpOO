<?php
function __autoload($classe){
	if(file_exists("../app.widgets/{$classe}.class.php"))
	{
		include_once "../app.widgets/{$classe}.class.php";
		echo "include_once ../app.widgets/{$classe}.class.php<br>\n";
	}
}

class Receptor{
	function acao($parameter){
		echo "Açãoexecutad comsucesso<br>\n";
	}
}

$receptor = new Receptor;
$action1=new TAction(array($receptor,'acao'));
$action1->setParameter('nome','wedel');
echo $action1->serialize();

echo "<br>\n";

$action2 = new TAction('strtoup');
$action2->setParameter('nome','dezin');
echo $action2->serialize();
?>