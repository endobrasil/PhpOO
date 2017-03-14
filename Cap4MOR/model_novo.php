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

class Curso extends TRecord{
	const TABLENAME = 'Curso';
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>teste inserir</title>
</head>
<body>
<?php
//insere novos objetos no banco de dados.
try{
	TTransaction::open('my_curso');
	TTransaction::setLogger(new TLoggerTXT('../log/log_cap4-01.txt'));

	TTransaction::log("** inserindo alunos **");

	$daline = new Aluno;
	$daline->nome='Daline Dall Oglio';
	$daline->endereco='Rua da Conceição';
	$daline->telefone='(51) 1111-2222';
	$daline->cidade='Cruzeiro do Sul';
	$daline->store();

	$william= new Aluno;
	$william->nome='William Scatolla';
	$william->endereco='Rua de Fátima';
	$william->telefone='(51) 1111-4444';
	$william->cidade='Encantado';
	$william->store();

	TTransaction::log("** inserindo cursos **");

	$curso = new Curso;
	$curso->descricao='Desenvolvendo em PHP-GTK';
	$curso->duracao=32;
	$curso->store();

	TTransaction::close();
	echo "registros inseridos com sucesso";
}catch(Exception $e){
	echo '<b>Erro</b>'.$e->getMessage();
	TTransaction::rollback();
}
?>

</body>
</html>
