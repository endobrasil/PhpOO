<?php
	include_once '../app/ado/TTransalation.class.php';

	TTransalation::setLanguage('pt');
	echo "Em português";

	echo _t('Function')."<br>\n";
	echo _t('Table')."<br>\n";
	echo _t('Tool')."<br>\n";

	TTransalation::setLanguage('it');
	echo "Em Italiano";

	echo _t('Function')."<br>\n";
	echo _t('Table')."<br>\n";
	echo _t('Tool')."<br>\n";
?>