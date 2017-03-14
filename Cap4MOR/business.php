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

	function inscrever($turma){
		$inscricao = new Inscricao;
		$inscricao->id_Aluno=$this->id;
		$inscricao->id_Turma=$turma;
		$inscricao->store();
	}
}

?>
<!DOCTYPE html>
<html>
<head meta charset="UTF-8">
	<title>Negócios</title>
</head>
<body>
<?php
try{
	TTransaction::open('my_curso');
	TTransaction::setLogger(new TLoggerHTML('../log/log_cap4-12.html'));

	TTransaction::log("** Inserindo o Aluno Carlos **");
	$aluno = new Aluno;
	$aluno->nome="Carlos Ranzi";
	$aluno->endereco="Rua Francisco Oscar";
	$aluno->telefone="(89) 9 7786.1234";
	$aluno->cidade="fortaleza";
	$aluno->store();

	TTransaction::log("** Inscrvendo o Aluno Carlos nas turmas**");

	$aluno->inscrever(1);
	$aluno->inscrever(11);
	$aluno->inscrever(12);
	$aluno->inscrever(13);
	$aluno->inscrever(14);
	$aluno->inscrever(15);
	
	TTransaction::close();
}catch(Exception $e){
	echo '<b>Erro</b>'.$e->getMessage();
	TTransaction::rollback();
}
?>

</body>
</html>