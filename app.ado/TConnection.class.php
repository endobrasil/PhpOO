<?php
/*
* classe TConnection
* gerencia aconexões combanco dedados através dearquivos deconfiguração.
*/
final class TConnection{
	/*
	* Método __construct()
	* Não existirá instâncias de TConnection, 
	* por isto estamos marcando-o como private
	*/
	private function __construct(){}
	
	/*
	* método open()
	* recebe o nome do banco de dados e
	* instancia o PDO correspondente
	*/
	public static function open($name){
		//verefica se existe o arquivo de configuração para este banco de dados
		if(file_exists("../app.config/{$name}.ini")){

			//lê o INI e retorna um array
			$db=parse_ini_file("../app.config/{$name}.ini");
		}else{
			//se não existir lança um erro
			throw new Exception("Arquivo '$name' não encontrado");
		}
		
		//lê as informações contidas no arquivo
		$user = isset($db['user'])?$db['user']:NULL;
		$pass = isset($db['pass'])?$db['pass']:NULL;
		$name = isset($db['name'])?$db['name']:NULL;
		$host = isset($db['host'])?$db['host']:NULL;
		$type = isset($db['type'])?$db['type']:NULL;
		$port = isset($db['port'])?$db['port']:NULL;
		
		//descobre qual otipo dedriver sql a ser utilizado
		switch($type)
		{
			case 'pgsql':
				$port = $port?$port:'5432';
				$conn = new PDO("pgsql:dbname={$name};user={$user};password={$pass};host={$host};port{$port}");
				break;
				
			case 'mysql':
				$port = $port?$port:'3306';
				$conn = new PDO("mysql:host={$host};port={$port};dbname={$name}",$user,$pass);
				break;
				
			case 'sqlite':
				//código
				break;
			case 'ibase':
				//codigo
				break;
		}
		
		//define para que o PDO lance exceçõe na ocorrência de erros
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);		
		
		//retorna o objeto instanciado
		return $conn;
	}

}
?>