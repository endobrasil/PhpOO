<?php
function __autoload($classe){
	if(file_exists("../app.widgets/{$classe}.class.php"))
	{
		include_once "../app.widgets/{$classe}.class.php";
		echo "include_once ../app.widgets/{$classe}.class.php<br>\n";
	}
}

class Mundo extends TPage{
	function ola($param){
		echo "Olá meu grande amigo".$param['nome'];
	}

}

$pagina =new Mundo;
$pagina->show();
?>