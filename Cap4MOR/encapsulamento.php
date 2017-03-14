<?php
function __autoload($classe){
	if(file_exists("../app.ado/{$classe}.class.php"))
	{
		include_once "../app.ado/{$classe}.class.php";
		echo "include_once ../app.ado/{$classe}.class.php<br>\n";
	}
}

class Turma extends TRecord{
	const TABLENAME = 'Turma';

	function set_dia_semana($valor){
		if(is_int($valor) and ($valor>=1)and($valor<=7)){
			$this->data['dia_semana']=$valor;
		}else{
			echo "Tentou atribuir {$valor} em dia_semana<br>\n";
		}
	}

	function set_turno($valor){
		if(($valor=='M')or($valor=='T')or($valor=='N')){
			$this->data['turno']=$valor;
		}else{
			echo "Tentou atribuir {$valor} em turno<br>\n";
		}
	}
}

?>
<!DOCTYPE html>
<html>
<head meta charset="UTF-8">
	<title>Collection Count</title>
</head>
<body>
<?php
try{
	TTransaction::open('my_curso');
	TTransaction::setLogger(new TLoggerHTML('../log/log_cap4-10.html'));

	TTransaction::log("** Inserindo turma 1 **");
	$turma=new Turma;
	$turma->dia_semana=1;
	$turma->turno='M';
	$turma->professor='Carlos Bellin';
	$turma->data_inicio='2002-09-01';
	$turma->sala='100';
	$turma->encerrada=FALSE;
	$turma->id_Curso=1;
	$turma->store();

	TTransaction::log("** Inserindo turma 2 **");
	$turma=new Turma;
	$turma->dia_semana='segunda';
	$turma->turno='Manhã';
	$turma->professor='Sérgio Crespo';
	$turma->data_inicio='2002-09-01';
	$turma->sala='200';
	$turma->encerrada=FALSE;
	$turma->id_Curso=1;
	$turma->store();
	
	TTransaction::close();
}catch(Exception $e){
	echo '<b>Erro</b>'.$e->getMessage();
	TTransaction::rollback();
}
?>

</body>
</html>