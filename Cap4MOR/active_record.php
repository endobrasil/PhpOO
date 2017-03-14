<?php
class Produto{
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
		$sql = "DELETE FROM produtos WHERE id={$this->id}";
		
		$conn= $this->conecta();
		$conn->exec($sql);
		unset($conn);
	}

	public function registraCompra($unidades, $preco_custo){
		$this->preco_custo=$preco_custo;
		$this->estoque+=$unidades;
	}

	public function registraVenda($unidades){
		$this->estoque-=$unidades;
	}

	public function calculaPrecoVenda(){
		return $this->preco_custo*1.3;
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
	
	$vinho_co2 = new Produto;
	$vinho_co2->descricao='Vinho Cabernet4';
	$vinho_co2->estoque=12.3;
	$vinho_co2->preco_custo=13.2;
	$vinho_co2->insert();

	$vinho_co2->registraVenda(5);
	$vinho_co2->registraCompra(12,15);
?>
</body>
</html>