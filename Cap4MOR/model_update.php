<?php
function __autoload($classe){
	if(file_exists("../app/ado/{$classe}.class.php"))
	{
		include_once "../app/ado/{$classe}.class.php";
		echo "include_once ../app/ado/{$classe}.class.php<br>\n";
	}
}


class Aluno extends TRecord{
	const TABLENAME = 'Aluno';
}

class Curso extends TRecord{
	const TABLENAME = 'Curso';
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>teste Update</title>
</head>
<body>
<?php
try{
	TTransaction::open('my_curso');
	TTransaction::setLogger(new TLoggerHTML('../log/log_cap4-03.html'));

	TTransaction::log("** Obtendo alunos **");
	echo "<h1>** Obtendo aluno 1 **</h1>\n";

	$daline = new Aluno(11);
	if($daline){
		echo "Telefone atual da aluna {$daline->nome}: {$daline->telefone} <br>\n";
		$daline->telefone='(51) 1111-3333';
		TTransaction::log("** Atualizando o telefone da aluna 1 **");
		$daline->store();
		echo "Novo telefone da aluna {$daline->nome}: {$daline->telefone} <br>\n";
	}

		TTransaction::log("** Obtendo curso 1 **");
		$record = new Curso;
		$curso = $record->load(1);
		if($curso){
			echo "Duração atual do curso {$curso->descricao} é {$curso->duracao}<br>\n";
			$curso->duracao=28;
			TTransaction::log("** persistindo curso 1 **");
			$curso->store();
			echo "Nova duração do curso {$curso->descricao} é {$curso->duracao}<br>\n";
		}
	TTransaction::close();
}catch(Exception $e){
	echo '<b>Erro</b>'.$e->getMessage();
	TTransaction::rollback();
}
?>

</body>
</html>
