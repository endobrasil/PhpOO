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
	TTransaction::setLogger(new TLoggerHTML('../log/log_cap4-06.html'));

	TTransaction::log("** Lista das turmas em andamento no turno da tarde **");
	
	$criteria = new TCriteria;
	$criteria->add(new TFilter('turno','=','t'));
	$criteria->add(new TFilter('encerrada','=',FALSE));

	$repository = new TRepository('turma');
	$turmas = $repository->load($criteria);
	if($turmas){
		echo "<h3>** Lista das turmas em andamento no turno da tarde **</h3>\n";
		foreach ($turmas as $turma) {
			echo "<li>ID: {$turma->id} 	| ".
				"Dia: {$turma->dia} 	| ".
				"Sala: {$turma->sala} 	| ".
				"Turno: {$turma->turno} | ".
				"professor: {$turma->professor}<br>\n";
		}
	}

	TTransaction::log("** Lista os alunos aprovados da turma X **");
	
	$criteria = new TCriteria;
	$criteria->add(new TFilter('nota','>=',7));
	$criteria->add(new TFilter('frequencia','>=','75'));
	//$criteria->add(new TFilter('id_turma','=','13'));
	$criteria->add(new TFilter('cancelada','=','false'));
	$repository = new TRepository('inscricao');
	$inscricoes = $repository->load($criteria);
	if($inscricoes){
		echo "<h3>** Lista os alunos aprovados da turma X **</h3>\n";
		foreach ($inscricoes as $inscricao) {
			$aluno = new Aluno($inscricao->id_Aluno);
			echo "<li>ID inscricao: {$inscricao->id} 	| ".
				"Nota: {$inscricao->nota} 	| ".
				"AlunoID: {$inscricao->id_Aluno} | ".
				"Aluno: {$aluno->nome} | ".
				"Endereço: {$aluno->endereco} | ".
				"<br>\n";
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