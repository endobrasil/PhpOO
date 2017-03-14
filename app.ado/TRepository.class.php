<?php
/*
* Classe TRepository
* esta classe provê os métodos necessários para manipular coleções de objetos
*/
final class TRepository{
	private $class; //nome da classe manipulada pelo repostório

	/*
	* método __construct()
	* instancia um repositório de Objetos
	* @param $class = Classe dos Objetos
	*/
	function __construct($class){
		$this->class=$class;
	}

	/*
	* método load()
	* Recupera um conjunto de objetos(collection) da base de dados
	* através de um critério de seleção, e instanciá-lo em memória
	* @param $criteria = objeto do tipo TCiteria
	*/
	function load(TCriteria $criteria){
		//instancia a instrução select
		$sql = new TSqlSelect;
		$sql->addColumn('*');
		$sql->setEntity(constant($this->class.'::TABLENAME'));
		//atribui um critério passado como parâmetro
		$sql->setCriteria($criteria);

		//obtem a transação ativa
		if($conn=TTransaction::get()){
			//registra mensagem de log
			TTransaction::log($sql->getInstruction());

			//executa a consulta no banco de dados
			$result=$conn->Query($sql->getInstruction());
			$results=array();

			if($result){
				//percorre o resultado da consulta, retornando um objeto
				while ($row=$result->fetchObject($this->class)) {
					//armazena no array o resultado
					$results[]=$row;
				}
			}
			return $results;
		}else{
			//se não tiver transação, retorna uma exceção
			throw new Exception('Não há transação ativa!!!');
		}
	}

	/*
	* método delete()
	* exclui umconjunto de objetos (collection) da base de dados
	* através de um critério de seleção
	* @param $criteria = objeto do tipo TCriteria
	*/
	function delete(Tcriteria $criteria){
		$sql = new TSqlDelete;
		$sql->setEntity(constant($this->class.'::TABLENAME'));
		//atribui um critério passado como parâmetro
		$sql->setCriteria($criteria);

		//obtem a transação ativa
		if($conn=TTransaction::get()){
			//registra mensagem de log
			TTransaction::log($sql->getInstruction());

			//executa a instrução delete
			$result=$conn->exec($sql->getInstruction());
			return $result;
		}else{
			//se não tiver transação, retorna uma exceção
			throw new Exception('Não há transação ativa!!!');
		}
	}

	/*
	* método count()
	* retorna aquantidade deobjetos da base de dados
	* que satisfazem um determinado critério de seleçã
o	* @param $criteria = objeto do tipo TCriteria
	*/
	function count(Tcriteria $criteria){
		//instancia a instrução select
		$sql = new TSqlSelect;
		$sql->addColumn('count(*)');
		$sql->setEntity(constant($this->class.'::TABLENAME'));
		//atribui um critério passado como parâmetro
		$sql->setCriteria($criteria);

		//obtem a transação ativa
		if($conn=TTransaction::get()){
			//registra mensagem de log
			TTransaction::log($sql->getInstruction());

			//executa a consulta no banco de dados
			$result=$conn->Query($sql->getInstruction());
			if($result){
				$row=$result->fetch();
			}
			//retorna o resultado
			return $row[0];
		}else{
			//se não tiver transação, retorna uma exceção
			throw new Exception('Não há transação ativa!!!');
		}
	}
}
?>