<?php
/**
* classe TTranslation
* classe utilitária para a tradução de textos
*/

class TTranslation{
	private static $instance;	//instância de TTransalation
	private $lang; 				//linguagem de destino

	/**
	* método __construct()
	* instancia um objeto TTranslation
	*/
	private function __construct(){
		$this->messages['en'][]='Function';
		$this->messages['en'][]='Table';
		$this->messages['en'][]='Toll';

		$this->messages['pt'][]='Função';
		$this->messages['pt'][]='Tabela';
		$this->messages['pt'][]='Ferramenta';

		$this->messages['it'][]='Funzione';
		$this->messages['it'][]='Tabelle';
		$this->messages['it'][]='Strumento';
	}

	/**
	* método getInstance()
	* retorna a única instância de TTranslation
	*/
	public static function getInstance(){
		//se não existir instância ainda
		if(empty(sel:$instance)){
			//instancia um objeto
			self::$instance = new TTranslation;
		}
		//retorna a instância
		return self::$instance;
	}

	/**
	* método setlanguage()
	* define a linguagem a ser utilizada
	* @param $lang = limguagem(en,pt,it)
	*/
	public static function setLanguagem($lang){
		$instance=self::getInstance();
		$instance->lang=$lang;
	}

	/**
	* método getLanguage()
	* retorna a linguagem atual
	*/
	public static function getLanguage(){
		$instance=self::getInstance();
		return $instance->lang;
	}

	/**
	* método Translate()
	* traduz uma palavra para a linguagem definida
	* @param $word = palavra a ser traduzida
	*/
	public function Translate($word){
		//obtém a instância atual
		$instance = self::getInstance();
		//busca o índice numérico da palavra dentro do vetor
		$key = array_search($word, $instance->messages['en']);

		//obtem a linguagem para a tradução
		$language=self::getLanguage();
		//retorna a palavra traduzida
		//vetor indexado pela linguagem e pela chave
		return $instance->messages[$language][$key];
	}
}	//fim da classe

/**
* método _t()
* fachada para o método Translate da classe translation
* @param $word = palavra a ser traduzida 
*/
function _t($word){
	return TTranslation::Translate($word);
}
?>	