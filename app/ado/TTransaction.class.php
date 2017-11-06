<?php
/*
* classe TTransaction
* essa classe preve os métodos necessários para manipular transações
*/
final class TTransaction{
	private static $conn;	//conexão ativa
	private static $logger;	//objeto de LOG

	/*
	* método __construct()
	* está marcado como private para impedirque se crie instâncias de TTransaction
	*/
	private function __construct(){}

	/*
	* método open()
	* Abre uma transação e uma conecção com o BD
	* @param $database = nome do banco de dados
	*/
	public static function open($database){
		//abre uma conexão e armazena na propriedade estática $conn
		if(empty(self::$conn)){
			self::$conn=TConnection::open($database);
			//inicia a transação
			self::$conn->beginTransaction();
			//desliga o log SQL
			self::$logger=NULL;
		}
	}

	/*
	* método get()
	* retorna a conexão ativa da transação
	*/
	public static function get(){
		//retorna a conexão ativa
		return self::$conn;
	}

	/*
	* método rollback()
	* desfaz todas as operações realizadas na transação
	*/
	public static function rollback(){
		if(self::$conn){
			//desfaz as operações realizadas na transação
			self::$conn->rollback();
			self::$conn=NULL;
		}
	}

	/**
	* método close()
	* Aplica todas as operações realizadas e fecha atransação
	*/
	public static function close(){
		if(self::$conn){
			//aplica as operações realizadas durante a transação
			self::$conn->commit();
			self::$conn=NULL;
		}
	}

	/**
	* método SetLogger()
	* define qual a estratégia(algorítimo deLOGserá usado)
	*/
	public static function setLogger(TLogger $logger){
		self::$logger = $logger;
	}

	/**
	* método log()
	* armazena umamensagem no arquivo de LOG
	* baseada naestratégia ($logger) atual
	*/
	public static function log($message){
		//verefica se existe um logger
		if(self::$logger){
			self::$logger->write($message);
		}
	}
}
?>