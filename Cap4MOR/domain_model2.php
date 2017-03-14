<?php
final class Produto{
	private $descricao;
	private $estoque;
	private $preco_custo;
	
	public function __construct($descricao, $estoque, $preco_custo){
		$this->descricao=$descricao;
		$this->estoque=$estoque;
		$this->preco_custo=$preco_custo;
	}
	
	public function registraCompra($unidades, $preco_custo){
		$this->preco_custo=$preco_custo;
		$this->estoque +=$unidades;
	}
	
	public function registraVenda($unidades) {
		$this->estoque-=$unidades;
	}
	
	public function getEstoque() {
		return $this->e;
	}
	
	public function calculaPrecoVenda(){
		return $this->preco_custo*1.3;
	}
}

final class venda{
	private $itens;
	/*
	 * Método addItem
	 * adiciona um iten na venda
	 * @param $quantidade = quantidade vendida
	 * @param $produto = obejeto produto
	 */
	public function addItem($quantidade, Produto $produto){
		$this->itens[]=array($quantidade,$produto);
	}
	
	public function getItens() {
		return $this->itens;
	}
}

$venda = new venda();
$venda->addItem(3, new Produto('vinho', 10, 15));
$venda->addItem(2, new Produto('Salame', 20, 20));
$venda->addItem(1, new Produto('Queijo', 30, 10));

$total=0;

foreach ($venda->getItens() as $item){
	$quantidade = $item[0];
	$produto = $item[1];
	$total+=$produto->calculaPrecoVenda()*$quantidade;
	$produto->registraVenda($quantidade);
}

echo $total;

?>