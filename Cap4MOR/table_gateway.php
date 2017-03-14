<?php
class ProdutoGateway{
	function conecta(){
		$conn = new PDO('mysql:host=localhost;port=3306;dbname=test','root','');
		$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);
		return $conn;
	}
	function insert($descricao, $estoque, $preco_custo){
		$sql = "INSERT INTO produtos(descricao, estoque, preco_custo)".
				"VALUES ('$descricao', $estoque, $preco_custo)";

		$conn= $this->conecta();

		$conn->exec($sql);
		unset($conn);
	}

	function update($id, $descricao, $estoque, $preco_custo){
		$sql = "UPDATE produtos SET ".
				"descricao = '$descricao', ".
				"estoque = $estoque,".
				"preco_custo = $preco_custo".
				" WHERE id=$id";
		
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
/*
	$gateway->insert('Vinho', 10, 10.5);
	$gateway->insert('Salame', 20, 20.1);
	$gateway->insert('Queijo', 30, 30);

	$gateway->insert('Sisqueiro', 9, 3.5);
	
	$gateway->update(10, 'Salame', 25, 27);

	$gateway->delete(12);	

*/
	print_r($gateway->selects());
	print_r($gateway->selects(12));
?>
</body>
</html>