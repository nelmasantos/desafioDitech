<?php
switch ($_GET['acao']) {

case 'controla_dia_agenda':

$diaAtual = $_POST['dataAtual'];
$strMaisMenos = $_POST['strMaisMenos'];
$strTipoServico = $_POST['tipoServico'];

AgendaINT::montarAreaAgenda($diaAtual,$strMaisMenos,$strTipoServico);

break; 