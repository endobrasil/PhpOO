<?php
function __autoload($classe){
	$pastas = array('app/widgets', 'app/ado');
	foreach ($pastas as $pasta) {
		if(file_exists("../{$pasta}/{$classe}.class.php")){
			include_once "../{$pasta}/{$classe}.class.php";
			echo "include_once ../{$pasta}/{$classe}.class.php<br>\n";
		}	
	}
}


new TSession;

if(!TSession::getValue('counted')){
	echo "registado visita";
	TSession::setValue('counted',true);
}else{
	echo "Visita já registrada";	
}