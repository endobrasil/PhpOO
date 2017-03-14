<?php
function __autoload($classe){
	if(file_exists("../app.widgets/{$classe}.class.php"))
	{
		include_once "../app.widgets/{$classe}.class.php";
		echo "include_once ../app.widgets/{$classe}.class.php<br>\n";
	}
}

new TMessage('error',"Error fatal");
?>