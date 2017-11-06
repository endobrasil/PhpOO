<?php
/**
* classe TMessage
* exibe mensaens ao usuário
*/
class TMessage{
	/**
	* método construtor
	* instancia objeto TMessage
	* @param $type= tipo de mensagem (info, erro)
	* @param $message= mensagem ao usuário
	*/
	public function __construct($type,$message){
		$style = new TStyle('tmessage');
		$style->position ='absolute';
		$style->left='30%';
		$style->top='30%';
		$style->width='300';
		$style->height='150';
		$style->color='black';
		$style->background='#DDDDDD';
		$style->border='4px solid #000000';
		$style->z_index='1000000';

		//exibe o estilo na tela
		$style->show();

		//instancia o painel para exibir odiálogo
		$painel=new TElement('div');
		$painel->class='tmessage';
		$painel->id='tmessage';

		//cria um botão que vaifechar o diálogo
		$button = new TElement('input');
		$button->type='button';
		$button->value='fechar';
		$button->onclick="document.getElementById('tmessage').style.display='none'";

		//criauma tabela para organizar o layout
		$table = new TTable;
		$table->aling='center';
		
		//cria uma linha para oícone e a mensagem
		$row=$table->addRow();
		$row->addCell(new TImage("../app/img/{$type}.png"));
		$row->addCell($message);

		//cria uma linha para o botão
		$row=$table->addRow();
		$row->addCell('');
		$row->addCell($button);

		//adiciona a tabela ao painel
		$painel->add($table);
		//exibe painel
		$painel->show();
	}
}
?>