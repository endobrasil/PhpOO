<?php
/**
 * class TCheckGroup
 * classe para a exibição de um grupo de Radio Buttons 
 */
 class TRadioGroup extends TField{
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
 				$button = new TRadioButton($this->name);
 				$button->setValue($index);
 				
 				//se pussui qualquer valor
 				if($this->value==$index){
 					//marca o radio button
 					$button->setProperty('checked','1');
 				}
 				$button->show();
 				$obj = new TLabel($label);
 				$obj->show();
 				if($this->layout=='vertical'){
				//exibe uma tag de quebra de linha
				$br=new TElement('br');
				$br->show();
				}
				echo "\n";
			}
		}
	}
}
?> 
