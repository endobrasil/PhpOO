<?php
function __autoload($classe){
	if(file_exists("../app.ado/{$classe}.class.php"))
	{
		include_once "../app.ado/{$classe}.class.php";
		echo "include_once ../app.ado/{$classe}.class.php<br>\n";
	}
}

class Aluno extends TRecord{
	const TABLENAME = 'Aluno';
}

class Turma extends TRecord{
	const TABLENAME = 'Turma';
}

class Inscricao extends TRecord{
	const TABLENAME = 'Inscricao';
}

?>
<!DOCTYPE html>
<html>
<head meta charset="UTF-8">
	<title>Collection GET</title>
</head>
<body>
<?php
try{
	TTransaction::open('my_curso');
	TTransaction::setLogger(new TLoggerHTML('../log/log_cap4-07.html'));

	TTransaction::log("** seleciona inscricoes da turma 13 **");
	
	$criteria = new TCriteria;
	$criteria->add(new TFilter('id_Turma','=','13'));
	$criteria->add(new TFilter('cancelada','=',FALSE));

	$repository = new TRepository('inscricao');
	$inscricoes = $repository->load($criteria);
	if($inscricoes){
		TTransaction::log("** Altera informações **");
		foreach ($inscricoes as $inscricao) {
			$inscricao->nota=8;
			$inscricao->frequencia=75;
			$inscricao->store();
		}
	}

	TTransaction::close();
}catch(Exception $e){
	echo '<b>Erro</b>'.$e->getMessage();
	TTransaction::rollback();
}
?>

</body>
</html>