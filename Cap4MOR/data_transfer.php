<?php
class Produto{
	public $id; 
	public $descricao;
	public $estoque;
	public $preco_custo;
}

class ProdutoGateway{
	function conecta(){
		$conn = new PDO('mysql:host=localhost;port=3306;dbname=test','root','');
		$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);
		return $conn;
	}

	function insert(Produto $object){
		$sql = "INSERT INTO produtos(descricao, estoque, preco_custo)".
				"VALUES ('$object->descricao', $object->estoque, $object->preco_custo)";

		$conn= $this->conecta();

		$conn->exec($sql);
		unset($conn);
	}

	function update(Produto $object){
		$sql = "UPDATE produtos SET ".
				"descricao = '$object->descricao', ".
				"estoque = $object->estoque,".
				"preco_custo = $object->preco_custo".
				" WHERE id=$object->id";
		
		$conn= $this->conecta();
		$conn->exec($sql);
		unset($conn);
	}

	function delete($id){
		$sql = "DELETE FROM produtos".
				" WHERE id=$id";
		
		$conn= $this->conecta();
		$conn->exec($sql);
		unset($conn);
	}

	function select($id){
		$sql = "SELECT * FROM produtos".
				" WHERE id=$id";
		
		$conn= $this->conecta();
		$result = $conn->query($sql);
		$data = $result->fetch(PDO::FETCH_ASSOC);
		unset($conn);
		return $data;
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
</head>
<body>
<?php
	$gateway = new ProdutoGateway;
	
	$vinho_branco = new Produto;
	$vinho_branco->descricao='Vinho Branco';
	$vinho_branco->estoque=10;
	$vinho_branco->preco_custo=12.6;

	$gateway->insert($vinho_branco);
	print_r($gateway->selects());
?>
</body>
</html>