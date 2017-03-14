<?php
class  pessoa{
	private $nome;
	private $cidadeId;
	
	function __construct($nome, $cidadeId) {
		$this->nome=$nome;
		$this->cidadeId=$cidadeId;
	}
	
	function __get($propriedade) {
		if($propriedade=='cidade'){
			return new cidade($this->cidadeId);
		}
	}
}

class cidade{
	private $id;
	private $nome;
	
	function __construct($id) {
		$cid[1]='Porto Alegre';
		$cid[2]='São Paulo';
		$cid[3]='Fortaleza';
		$cid[4]='Rio de Janeiro';
		
		$this->id=$id;
		$this->setNome($cid[$id]);
	}
	
	function setNome($nome){
		$this->nome = $nome;
	}
	
	function getNome(){
		return $this->nome;
	}
}

$maria = new pessoa('Maeia Silva', 1);
$pedro = new pessoa('Pedin', 3);

echo $maria->cidade->getNome()."<br>\n";
echo $pedro->cidade->getNome()."<br>\n";

print_r($pedro->cidade);
?>