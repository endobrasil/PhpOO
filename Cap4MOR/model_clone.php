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
	<title>teste Clone</title>
</head>
<body>
<?php
try{
	TTransaction::open('my_curso');
	TTransaction::setLogger(new TLoggerHTML('../log/log_cap4-04.html'));

	$daline = new Aluno;
	$daline->nome='Fábio Locatelli #BOSTA';
	$daline->endereco='Rua Merlin';
	$daline->telefone='(51) 9 2222-1111';
	$daline->cidade='Largeiro';

	$julia = clone $daline;

	$julia->nome='Júlia Locatelli #FEZES';

	TTransaction::log("*** Persistindo \$daline ***");
	$daline->store();
	TTransaction::log("*** Persistindo \$julia ***");
	$julia->store();

	TTransaction::close();
}catch(Exception $e){
	echo '<b>Erro</b>'.$e->getMessage();
	TTransaction::rollback();
}
?>

</body>
</html>
