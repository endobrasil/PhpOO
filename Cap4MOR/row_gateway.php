<?php
class ProdutoGateway{
	private $data;

	function conecta(){
		$conn = new PDO('mysql:host=localhost;port=3306;dbname=test','root','');
		$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);
		return $conn;
	}

	function __get($prop){
		return $this->data[$prop];
	}

	function __set($prop, $value){
		$this->data[$prop]=$value;
	}

	function insert(){
		$sql = "INSERT INTO produtos(descricao, estoque, preco_custo)".
				"VALUES ('{$this->descricao}', {$this->estoque}, {$this->preco_custo})";

		$conn= $this->conecta();

		$conn->exec($sql);
		unset($conn);
	}

	function update(){
		$sql = "UPDATE produtos SET ".
				"descricao = '{$this->descricao}', ".
				"estoque = {$this->estoque},".
				"preco_custo = {$this->preco_custo}".
				" WHERE id={$this->id}";
		
		$conn= $this->conecta();
		$conn->exec($sql);
		unset($conn);
	}

	function delete(){
		$sql = "DELETE FROM produtos".
				" WHERE id={$this->id}";
		
		$conn= $this->conecta();
		$conn->exec($sql);
		unset($conn);
	}

	function select($id){
		$sql = "SELECT * FROM produtos".
				" WHERE id=$id";
		
		$conn= $this->conecta();
		$result = $conn->query($sql);
		$this->data = $result->fetch(PDO::FETCH_ASSOC);
		unset($conn);
	}

	function selects(){
		$sql = "SELECT * FROM produtos";
		
		$conn= $this->conecta();
		$result = $conn->query($sql);
		$data = $result->fetchAll(PDO::FETCH_ASSOC);
		unset($conn);
		return $data;
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>teste GateWay</title>
	<meta charset="utf-8">
</head>
<body>
<?php
	/*
	$vinho_co = new ProdutoGateway;
	$vinho_co->descricao='Vinho Cabernet';
	$vinho_co->estoque=10.2;
	$vinho_co->preco_custo=12.6;
	$vinho_co->insert();

	$objeto = new ProdutoGateway;
	$objeto->select(1);
	$objeto->estoque*2;
	$objeto->descricao='Mariê Doidinha';
	$objeto->update();
*/
	$objeto = new ProdutoGateway;

	$objeto->select(1);
	print_r($objeto);

	$objeto->select(14);
	$objeto->delete();



?>
</body>
</html>