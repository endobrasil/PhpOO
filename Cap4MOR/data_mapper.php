<?php
final class Produto{
	private $descricao;
	private $estoque;
	private $preco_custo;

	function conecta(){
		$conn = new PDO('mysql:host=localhost;port=3306;dbname=test','root','');
		$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);
		return $conn;
	}

	function __construct($descricao, $estoque, $preco_custo){
		$this->descricao = $descricao;
		$this->estoque=$estoque;
		$this->preco_custo=$preco_custo;
	}

	function getDescricao(){
		return $this->descricao;
	}
}

final class Venda{
	private $id;
	private $itens;

	function __construct($id){
		$this->id=$id;
	}

	function getId(){
		return $this->id;
	}

	public function addItem($quantidade, Produto $produto){
		$this->itens[]= array($quantidade,$produto);
	}

	public function getIntens(){
		return $this->itens;
	}
}

final class VendaMapper{
	function insert(Venda $venda){
		$id = $venda->getId();
		date_default_timezone_set('America/Sao_Paulo');
		$data=date("Y-m-d");

		$sql = "INSERT INTO venda (id,data) VALUES ('$id', '$data')";
		echo $sql."<br>\n";

		foreach ($venda->getIntens() as $item) {
			$quantidade = $item[0];
			$produto = $item[1];
			$descricao=$produto->getDescricao();
		}

		$sql ="INSERT INTO venda_itens(ref_venda, produto, quantidade)".
			"VALUES('$id', '$descricao', $quantidade)";
		echo $sql."<br>\n";
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
	$venda = new Venda(120);
	$venda->addItem(1, new Produto('51', 12, 15));
	$venda->addItem(2, new Produto('Apresuntado', 6, 9));
	$venda->addItem(3, new Produto('Requeijão', 21, 1));

	VendaMapper::insert($venda);
?>
</body>
</html>