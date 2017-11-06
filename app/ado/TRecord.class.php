<?php
/*
* class TRecord
* Esta classe proVê os métodos necessários para persistir e
* Recuperar objetos da base de dados (Active Record)
*/
abstract class TRecord{
	protected $data;	//array contendo os dados do objeto

	/*
	* método __construct()
	* instancia um Active Record. Se passado o $id, já carrega o objeto
	* @param [$id] = ID do objeto
	*/
	public function __construct($id=NULL){
		if($id){	//se o id for informado
			//carrega o objeto correspondente
			$object= $this->load($id);
			if($object){
				$this->fromArray($object->toArray());
			}
		}
	}

	/*
	* método __clone()
	* executado quando o objeto for clonado
	* limpa o ID para que seja gerado um novo ID para o clone
	* evitar complicações na hora da persistência
	*/
	public function __clone(){
		unset($this->id);
	}

	/*
	* método __set()
	* executado sempre que uma propriedade for atibuida.
	*/
	public function __set($prop, $value){
		//verefica se existe um método set_<propriedade> previamente definido
		if(method_exists($this, 'set_'.$prop)){
			//executa o método existente
			call_user_func(array($this,'set_'.$prop), $value);
		}else{
			if($value===NULL){
				unset($this->data[$prop]);
			}else{
				//atribui valor da propriedade
				$this->data[$prop]=$value;
			}
		}
	}

	/*
	* método __get()
	* executado sempre que uma propriedade for requerida
	*/
	public function __get($prop){
		//verefica se existe um get para a propriedade
		if(method_exists($this, 'get_'.$prop)){
			//executa o método existente
			return call_user_func(array($this,'get_'.$prop));
		}else{
			//retorna o valor da propriedade
			if(isset($this->data[$prop])){
				return $this->data[$prop];
			}
		}
	}

	/*
	* método getEntity()
	* retorna o nome da entidade (tabela)
	* ele verifica a existência da constante TABLENAME na classe
	*/
	private function getEntity(){
		//obtem o nome da classe
		$class = get_class($this);
		//retorna a constante de classe TABLENAME
		return constant("{$class}::TABLENAME");
	}

	/*
	* método fromArray
	* preenche os dados do objeto com um array
	* usado para preencher os atributos
	*/
	public function fromArray($data){
		$this->data=$data;
	}

	/*
	* método toArray
	* retorna os dados do objeto como array
	*/
	public function toArray(){
		return $this->data;
	}

	/*
	* método store()
	* armazena o objeto na base de dados e retorna
	* o número de linhas afetadas pela instrução SQL (zero ou um)
	*/
	public function store(){
		//verefica se tem ID ou se existe na base de dados
		if(empty($this->data['id']) or !($this->load($this->id))){
			//incrementa o ID
			if(empty($this->data['id'])){
				$this->id=$this->getLast()+1;
			}
			//cria uma instrução de insert
			$sql = new TSqlInsert;
			$sql->setEntity($this->getEntity());
			//percorre dos dados do objeto
			foreach ($this->data as $key => $value) {
				//passa os dados do objeto para o SQL
				$sql->setRowData($key,$value);
			}
		}else{
			//instancia a instrução do update
			$sql=new TSqlUpdate;
			$sql->setEntity($this->getEntity());
			//cria um criterio de seleção baseado no id
			$criteria = new TCriteria;
			$criteria->add(new TFilter('id','=',$this->id));
			$sql->setCriteria($criteria);
			//percorre os dados do objeto
			foreach ($this->data as $key => $value) {
				if($key !== 'id'){ //o id não precisa ir no update
					//passa os dados do objeto para o sql
					$sql->setRowData($key,$value);
				}
			}
		}
		//obtem a transação ativa
		$conn=TTransaction::get();
		if($conn){
			//faz o log e executa o SQL
			TTransaction::log($sql->getInstruction());
			$result = $conn->exec($sql->getInstruction());
			//retorna o resultado
			return $result;
		}else{
			//se não tiver transação, retorna uma exceção
			throw new Exception("Error: Não há transação ativa!!!");			
		}
	}

	/*
	* método load()
	* recupera (retorna) um objeto da classe de dados
	* através de seu ID e instanciaele na memória
	* @param $id=ID do objeto
	*/
	public function load($id){
		//instancia a instução de SELECT
		$sql = new TSqlSelect;
		$sql->setEntity($this->getEntity());
		$sql->addColumn('*');

		//cria o criterio de seleção baseado no ID
		$criteria = new TCriteria;
		$criteria->add(new TFilter('id','=',$id));
		//define o critério de seleção dos dados
		$sql->setCriteria($criteria);
		//obtem a transação ativa
		if($conn=TTransaction::get()){
			//cria mensagem de log e executa a consulta
			TTransaction::log($sql->getInstruction());
			$result=$conn->Query($sql->getInstruction());
			//se retornou algum dado
			if($result){
				//retorna os dados em forma de objeto
				$object=$result->fetchObject(get_class($this));
			}
			return $object;
		}else{
			//se não tiver transação, retorna uma exceção
			throw new Exception("Error: Não há transação ativa!!!");			
		}
	}

	/*
	* método delete()
	* exclui um objeto da base de dados através de seu ID
	* se ID omitido se excluirá o objeto atual por padrão
	*/
	public function delete($id=null){
		// o ID é o parametro ou a propriedade ID?
		$id=$id?$id:$this->id;
		//instrancia uma instrução de delete
		$sql = new TSqlDelete;
		$sql->setEntity($this->getEntity());

		//cria criterio de seleção de dados
		$criteria=new TCriteria;
		$criteria->add(new TFilter('id','=',$id));
		//define o criterio de seleção baseado no id
		$sql->setCriteria($criteria);

		//obtem a transação ativa
		if($conn=TTransaction::get()){
			//faz o log e executa o sql
			TTransaction::log($sql->getInstruction());
			$result=$conn->exec($sql->getInstruction());
			//retorna o resultado
			return $result;
		}else{
			//se não tiver transação, retorna uma exceção
			throw new Exception("Error: Não há transação ativa!!!");			
		}

	}

	/*
	* método getLast()
	* retorna o ultimo ID
	* caso seja necessário para inserir registros...
	*/
	private function getlast(){
		//Inicia a transação
		if($conn=TTransaction::get()){
			//instancia uma instrução select
			$sql= new TSqlSelect;
			$sql->addColumn('max(ID) as ID');
			$sql->setEntity($this->getEntity());
			//cria o log e executa a instrução sql
			TTransaction::log($sql->getInstruction());
			$result=$conn->Query($sql->getInstruction());
			//retorna os dados do banco
			$row=$result->fetch();
			return $row[0];
		}else{
			//se não tiver transação, retorna uma exceção
			throw new Exception("Error: Não há transação ativa!!!");
		}
	}

}
?>