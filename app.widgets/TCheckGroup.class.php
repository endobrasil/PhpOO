<?php
/**
 * class TCheckGroup
 * classe para a construção de botões para verificação 
 */
 class TCheckGroup extends TField{
 	private $layout = 'vertical';
 	private $itens;
 	
 	/**
 	 * método setLayout
 	 * define a diração das opções (vertical ou horizontal)
 	 */
 	public function setLayout($dir){
 		$this->layout=$dir;
 	}
 	
 	/**
 	 * método addItens($itens)
 	 * adiciona itens ao check group
 	 * @param $itens = um vetor indexado de itens
 	 */
 	public function addItens($itens){
 		$this->itens=$itens;
 	}
 		
 	/**
 	 * método show()
 	 * exibe o widget na tela
 	 */
 	public function show(){
 		if($this->itens){
 			//percorre cada uma das opções do rádio
 			foreach ($this->itens as $index=>$label){
 				$button = new TCheckButton("{$this->name}[]");
 				$button->setValue($index);
 				
 				//verefica se deve ser marcado
 				if(@in_array($index,$this->value)){
 					$button->setProperty('checked',1);
 				}
 				$button->show();
 				$obj = new TLabel($label);
 				$obj->show();
 				
 				if($this->layout=='vertical'){
 					//exibe uma tag de quebra de linha
 					$br=new TElement('br');
 					$br->show();
 					echo "\n";
 				}
 			}
 		}
 	}
}
?> 
