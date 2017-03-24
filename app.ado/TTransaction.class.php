<?php
/*
* classe TTransaction
* essa classe preve os métodos necessários para manipular transações
*/
final class TTransaction{
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
			//ver o que o self ta bugando aki...
			//self::$conn=TConnection::open($database);
			$conn = new PDO('mysql:host=localhost;port=3306;dbname=cursos','root','Ab123456');
			//inicia a transação
			//self::$conn->beginTransaction();
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
			self:$conn->rollback();
			self::$conn=NULL;
		}
	}

	/*
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
}
?>