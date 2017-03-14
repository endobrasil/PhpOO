<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>teste PHPOO</title>
</head>
<body>
<h1>Teste com produto</h1>
<pre>
include_once 'produto.class.php';
	
	$produto = new Produto;
	
	$produto->Codigo=4001;
	$produto->Descricao="CD - The Beste of Eric Clapton";
	
	$produto2 = new Produto;
	
	$produto2->Codigo=4002;
	$produto2->Descricao="CD - the Eagles Hotel California";
	
	$produto->ImprimeEtiqueta();
	$produto2->ImprimeEtiqueta()
</pre>
<?php 
include_once 'produto.class.php';

$produto = new Produto;

$produto->Codigo=4001;
$produto->Descricao="CD - The Beste of Eric Clapton";

$produto2 = new Produto;

$produto2->Codigo=4002;
$produto2->Descricao="CD - the Eagles Hotel California";

$produto->ImprimeEtiqueta();
$produto2->ImprimeEtiqueta()

?>

<h1>Pessoa e conta</h1>
<pre>
 
	include_once 'Pessoa.class.php';
	include_once 'Conta.class.php';

	$carlos=new Pessoa;
	$carlos->Codigo=10;
	$carlos->Nome='Carlos da silva';
	$carlos->Altura=1.85;
	$carlos->Idade=25;
	$carlos->Nascimento='10/04/1976';
	$carlos->Escolaridade="Ensino Médio";


	var_dump($carlos);
	echo "<br><br><br>";
	echo "Manipulando o objeto {$carlos->Nome}:<br>\n";
	echo "{$carlos->Nome} é formado em {$carlos->Escolaridade}<br>\n";
	echo "{$carlos->Nome} possui {$carlos->Idade}<br>\n";
	$carlos->Envelhecer(1);
	echo "{$carlos->Nome} possui {$carlos->Idade}<br>\n";

	$carlos->Formar("Técnico em Eletricidade");
	echo "Agora {$carlos->Nome} é formado em {$carlos->Escolaridade}<br>\n";

	$conta_carlos=new Conta;
	$conta_carlos->Agencia=6677;
	$conta_carlos->Codigo="CC.1234.56";
	$conta_carlos->dataDeCriacao="10/07/02";
	$conta_carlos->Titular=$carlos;
	$conta_carlos->Senha=9876;
	$conta_carlos->Saldo=567.89;
	$conta_carlos->Cancelado=FALSE;

	echo "Manipulando a conra de {$conta_carlos->Titular->Nome} <br>\n";
	echo "O saldo atual é R\$ {$conta_carlos->obterSaldo()}<br>\n";
	$conta_carlos->depositar(20);
	echo "O saldo atual é R\$ {$conta_carlos->obterSaldo()}<br>\n";
	$conta_carlos->retirar(10);
	echo "O saldo atual é R\$ {$conta_carlos->obterSaldo()}<br>\n";
</pre>
<?php 
	include_once 'Pessoa.class.php';
	include_once 'Conta.class.php';

	$carlos=new Pessoa;
	$carlos->Codigo=10;
	$carlos->Nome='Carlos da silva';
	$carlos->Altura=1.85;
	$carlos->Idade=25;
	$carlos->Nascimento='10/04/1976';
	$carlos->Escolaridade="Ensino Médio";


	var_dump($carlos);
	echo "<br><br><br>";
	echo "Manipulando o objeto {$carlos->Nome}:<br>\n";
	echo "{$carlos->Nome} é formado em {$carlos->Escolaridade}<br>\n";
	echo "{$carlos->Nome} possui {$carlos->Idade}<br>\n";
	$carlos->Envelhecer(1);
	echo "{$carlos->Nome} possui {$carlos->Idade}<br>\n";

	$carlos->Formar("Técnico em Eletricidade");
	echo "Agora {$carlos->Nome} é formado em {$carlos->Escolaridade}<br>\n";

	$conta_carlos=new Conta;
	$conta_carlos->Agencia=6677;
	$conta_carlos->Codigo="CC.1234.56";
	$conta_carlos->dataDeCriacao="10/07/02";
	$conta_carlos->Titular=$carlos;
	$conta_carlos->Senha=9876;
	$conta_carlos->Saldo=567.89;
	$conta_carlos->Cancelado=FALSE;
	
	echo "<br><br><br>";	
	var_dump($conta_carlos);
	echo "<br><br><br>";
	echo "<p>Manipulando a conra de {$conta_carlos->Titular->Nome} <br>\n";
	echo "O saldo atual é R\$ {$conta_carlos->obterSaldo()}<br>\n";
	$conta_carlos->depositar(20);
	echo "O saldo atual é R\$ {$conta_carlos->obterSaldo()}<br>\n";
	$conta_carlos->retirar(10);
	echo "O saldo atual é R\$ {$conta_carlos->obterSaldo()}<br>\n";
?>

<pre>

</pre>

<?php 
include_once 'Pessoa.class.php';
include_once 'Conta.class.php';
include_once 'ContaCorrente.class.php';
include_once 'ContaPoupanca.class.php';


?>
</body>
</html>