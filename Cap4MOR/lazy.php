<?php
function __autoload($classe){
	if(file_exists("../app.ado/{$classe}.class.php"))
	{
		include_once "../app.ado/{$classe}.class.php";
		echo "include_once ../app.ado/{$classe}.class.php<br>\n";
	}
}

class Inscricao extends TRecord{
	const TABLENAME = 'Inscricao';

	public function get_aluno(){
		$aluno=new Aluno($this->id_Aluno);
		return $aluno;
	}
}

class Aluno extends TRecord{
	const TABLENAME='Aluno';

	function get_inscricoes(){
		$criteria=new TCriteria;
		$criteria->add(new TFilter('id_Aluno','=',$this->id));

		$repository=new TRepository('Inscricao');
		return $repository->load($criteria);
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
	TTransaction::setLogger(new TLoggerHTML('../log/log_cap4-11.html'));

	TTransaction::log("** Obtendo o aluno de uma inscrição **");
	$inscricao = new Inscricao(5);

	echo "<h3>** Obtendo o aluno de uma inscrição **</h3>\n";

	echo "id inscrição: {$inscricao->id} | ".
		"Frequencia: {$inscricao->frequencia} | ".
		"Aluno: {$inscricao->aluno->nome} | ".
		"Endereço: {$inscricao->aluno->endereco} |".
		"<br>\n";


	TTransaction::log("** Obtendo inscrições do aluno  **");
	$aluno = new Aluno(6);

	echo "<h3>** Obtendo o aluno de uma inscrição **</h3>\n";
	foreach ($aluno->inscricoes as $inscricao) {
		echo "<li>Inscricao: {$inscricao->id} | ".
			"turma: {$inscricao->id_Turma} | ".
			"Nota: {$inscricao->nota} | ".
			"frequencia: {$inscricao->frequencia}".
			"<br>\n";
	}

	
	TTransaction::close();
}catch(Exception $e){
	echo '<b>Erro</b>'.$e->getMessage();
	TTransaction::rollback();
}
?>

</body>
</html>