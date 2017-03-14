<?php
/* 
* class produto
* representa um produto a ser vendido
*/
final class Produto{
	//representa nossa estrutura de dados
	static $recordset = array();

	public function adicionar($id, $descricao, $estoque, $preco_custo){
		self::$recordset[$id]['descricao']=$descricao;
		self::$recordset[$id]['estoque']=$estoque;
		self::$recordset[$id]['preco_custo']=$preco_custo;
	}

	public function registraCompra($id, $unidades, $preco_custo){
		self::$recordset[$id]['preco_custo']=$preco_custo;
		self::$recordset[$id]['estoque']+=$unidades;
	}

	public function registraVenda($id, $unidades){
		self::$recordset[$id]['estoque']-=$unidades;
	}

	public function getEstoque($id){
		return self::$recordset[$id]['estoque'];
	}

	public function calcularPrecoVenda($id){
		return self::$recordset[$id]['preco_custo']*1.3;
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Teste Table Module</title>
</head>
<body>
<?php
$produto = new Produto;

$produto->adicionar(1, 'Vinho', 10, 15);
$produto->adicionar(2, 'Salame', 20, 25);

echo "Estoque<br>\n";
echo $produto->getEstoque(1)."<br>\n";
echo $produto->getEstoque(2)."<br><br>\n";

echo "Preço de venda<br>\n";
echo $produto->calcularPrecoVenda(1)."<br>\n";
echo $produto->calcularPrecoVenda(2)."<br><br>\n";

$produto->registraVenda(1,5);
$produto->registraVenda(2,10);

echo "Estoque 2<br>\n";
echo $produto->getEstoque(1)."<br>\n";
echo $produto->getEstoque(2)."<br><br>\n";

$produto->registraCompra(1,5,16);
$produto->registraCompra(2,10,22);

echo "Preço de venda atuais<br>\n";
echo $produto->calcularPrecoVenda(1)."<br>\n";
echo $produto->calcularPrecoVenda(2)."<br><br>\n";
?>
</body>
</html>
