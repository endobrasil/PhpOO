<?php
	include_once '../app/ado/TSession.class.php';

	new TSession;

	if(!TSession::getValue('counted')){
		echo 'registrando visira';
		TSession::setValue('counted',true);
	}else{
		echo 'Visita já registrada';
	}
?>