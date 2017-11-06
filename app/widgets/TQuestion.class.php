<?php
/**
* class TQuestion
* exibe perguntas aousuário
*/
class TQuestion{
	/**
	* método construtor
	* instancia objeto TQuestion
	* @param $message = pergunta ao usuário
	* @param $action_yes= ação para resposta positiva
	* @param $action_no = açãopara resposta negativa
	*/
	function __construct($message, TAction $action_yes, TAction $action_no){
		$style=new TStyle('tquestion');
		$style->position='absolute';
		$style->left='30%';
		$style->top='30%';
		$style->width='300';
		$style->height='150';
		$style->border_width='1px';
		$style->color='black';
		$style->background='#eeeeee';
		$style->border='4px solid #333333';
		$style->z_index='1000000';

		//converte os nomes dos métodos em URL
		$url_yes=$action_yes->serialize();
		$url_no=$action_no->serialize();

		//exibe o estilo na tela
		$style->show();

		//instancia o painel para exibir o diálogo
		$painel=new TElement('div');
		$painel->class='tquestion';

		//cria um botão para a resposta positiva
		$buttonSim = new TElement('input');
		$buttonSim->type='button';
		$buttonSim->value='sim';
		$buttonSim->onclick="javascript:location='$url_yes'";

		//cria um botão para a resposta negativa
		$buttonNao = new TElement('input');
		$buttonNao->type='button';
		$buttonNao->value='não';
		$buttonNao->onclick="javascript:location='$url_no'";

		//cria uma tabela para organizar o layout
		$table=new TTable;
		$table->aling='center';
		$table->cellspacing=10;
		//cria uma linha para o ícone e a mensagem
		$row=$table->addRow();
		$row->addCell(new TImage('../app.img/question.png'));
		$row->addCell($message);

		//cria uma linha para os botões
		$row=$table->addRow();
		$row->addCell($buttonSim);
		$row->addCell($buttonNao);

		//adiciona a tabela no painel
		$painel->add($table);
		//exibe painel
		$painel->show();
	}

}
?>