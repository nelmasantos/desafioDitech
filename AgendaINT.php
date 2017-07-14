<?php
class AgendaINT extends AgendaRN {

public static function montarAreaAgenda($diaAtual=null, $strMaisMenos=null, $strTipoServico = null){

    $bolDesativarAgendamento = false;
    $bolProximaData = false;
    $novaData = Date('d/m/Y');

    if(!is_null($diaAtual) && !is_null($strMaisMenos)){

        if($strMaisMenos == ''){
            $novaData = date('d/m/Y', strtotime(str_replace('/','-',$diaAtual)));
        }else{
            $novaData = date('d/m/Y', strtotime(str_replace('/','-',$diaAtual) . $strMaisMenos.' 1 day'));
        }

    }else{
        $bolProximaData = true;
    }

    $toTimeNova = strtotime(str_replace('/','-',$novaData));
    $toTimeHoje = strtotime(date('d-m-Y'));

    //data mínima é sempre amanha
    if($toTimeNova <= $toTimeHoje && !$bolProximaData){
        $bolDesativarAgendamento = true;
    }
   



    if($bolProximaData){
        $novaData = Date('d/m/Y', strtotime('+1 day'));
    }

    $diaSemana = self::diasemana($novaData);

    if($diaSemana == 'Domingo'){

        AgendaINT::montarAreaAgenda($novaData,(is_null($strMaisMenos)?'+':$strMaisMenos));
        return;
    }

    //buscar agendamento do dia pesquisado
    $AgendaRN = new AgendaRN();
    $arrHorarios = $AgendaRN->buscarAgendamentosDia($novaData);

    $mobileRN = new Mobile_Detect();
    $isMobile = $mobileRN->isMobile();
    ?>

    <div class="row" style="display: none">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel tile" style="">

                <?if(!$isMobile){?>
                    <div id="hoverscrollleft" style="font-size:2.6em;width: 5%; float: left"><i class="fa fa-angle-double-left"></i></div>
                <?}?>

                <div id='div30Dias' style="float:left; border: 0px solid; overflow-x: hidden; overflow-y: hidden; width: <?=$isMobile?'100':'90'?>%; white-space: nowrap; height: 50px">
                   <table border="0">
                       <tr>
                           <?
                           $data = date('d-m-Y');
                           for($i=0; $i<30; $i++){

                               if($i == 0){
                                   $data = date('d-m-Y', strtotime($data.'- 1 day'));
                               }

                               $data = date('d-m-Y', strtotime($data.'+ 1 day'));
                               $diaSemanal = self::diasemana($data);

                               if($diaSemanal == 'Domingo'){
                                   $data = date('d-m-Y', strtotime($data.'+ 1 day'));
                                   $diaSemanal = self::diasemana($data);
                               }


                               $dataFormatada = date('d/m/Y', strtotime($data));
                               $color = '';
                               if($novaData == $dataFormatada){
                                   $color='#e8e7e7';
                               }

                               echo '<td id="div'.$dataFormatada.'" onclick="controlarDiaAgenda(\'\',\''.$dataFormatada.'\',this.id);"
                                        style="background-color:'.$color.'; cursor:pointer; padding: 12px 10px; border-right: 1px solid #dcdcdc; text-align: center; font-size: 1.6em; font-weight: 500; line-height: 10px">
                                        '.$dataFormatada.'
                                        <br><span style="font-size:0.7em">'.$diaSemanal.'</span>
                                        </td>';

                           }
                           ?>
                       </tr>
                   </table>
                </div>

                <?if(!$isMobile){?>
                    <div id="hoverscrollright" style="font-size:2.6em; width: 5%; float: left; text-align: right"><i class="fa fa-angle-double-right"></i></div>
                <?}?>
            </div>
        </div>
    </div>

    <?

    $amanha = '';
    if(date('d/m/Y', strtotime(date('d-m-Y').'+ 1 day')) == $novaData){
        $amanha = 'Amanhã';
    }

    ?>

    <div class="row" id="divLinhaControleDias" style="display: ">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel tile">
                <div class="col-md-4 col-xs-12" style="border: 0px solid">
                    <button onclick="controlarDiaAgenda('-');" type="button" class="btn btn-round btn-default"
                            style="width: 100%; font-size: 1.5em;">
                        <i class="fa fa-chevron-left"></i> Dia anterior
                    </button>
                </div>
                <div class="col-md-4 col-xs-12" id="divCentralControleDias"
                     style="text-align: center; font-size: 2em; font-weight: 600;
                     font-family:Helvetica Neue Light, HelveticaNeue-Light, Helvetica Neue, Calibri, Helvetica, Arial, sans-serif">
                    <div id="divDiaAtual" style="display: inline">
                    <?=$novaData;?>
                    </div>
                    <?= ' '. ($amanha == '' ? $diaSemana:$amanha);?>
                </div>
                <div class="col-md-4 col-xs-12" style="border: 0px solid; text-align: right">
                    <button onclick="controlarDiaAgenda('+');" type="button" class="btn btn-round btn-default"
                        style="width: 100%; font-size: 1.5em">
                        <i class="fa fa-chevron-right"></i> Próximo dia
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="row" id="divAgendaHorarios">

        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="x_panel tile">
                <div class="x_title">
                    <h2>Manhã</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li>
                            <div class="checkbox" style="margin: 6px 20px">
                                <label><input type="checkbox" value=""
                                              onclick="apenasDisponiveis('divHorariosManha', this.checked);">
                                    Apenas disponíveis</label>
                            </div>
                        </li>
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content" id="divHorariosManha">

                    <table class="table">
                        <tbody>
                        <?
                        $arrControleHorarioManha = array('min' => '08:30', 'max' => '11:30');
                        AgendaINT::montarBotoesHorarios($arrHorarios,$novaData,$arrControleHorarioManha,$bolDesativarAgendamento,$strTipoServico);
                        ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>

        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="x_panel tile">
                <div class="x_title">
                    <h2>Tarde</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li>
                            <div class="checkbox" style="margin: 6px 20px">
                                <label><input type="checkbox" value=""
                                              onclick="apenasDisponiveis('divHorariosTarde', this.checked);">
                                    Apenas disponíveis</label>
                            </div>
                        </li>
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content" id="divHorariosTarde">

                    <table class="table">
                        <tbody>
                        <?
                        $arrControleHorarioTarde = array('min' => '13:30', 'max' => '18:00');
                        AgendaINT::montarBotoesHorarios($arrHorarios,$novaData,$arrControleHorarioTarde,$bolDesativarAgendamento,$strTipoServico);
                        ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>

    </div>
    <input type="hidden" id="hdnURLControleDiasAgenda" value="<?=FuncoesRN::assinarLink('controlador_ajax.php?acao=controla_dia_agenda')?>">
    <input type="hidden" id="hdnURLDesmarcarHorario" value="<?=FuncoesRN::assinarLink('controlador_ajax.php?acao=desmarcar_agendamento')?>">
    <input type="hidden" id="hdnURLAgendarHorario" value="<?=FuncoesRN::assinarLink('controlador_ajax.php?acao=marcar_agendamento')?>">
    <input type="hidden" id="hdnURLEnvioSMS" value="<?=FuncoesRN::assinarLink('controlador_ajax.php?acao=enviar_sms')?>">

<?
}




public static function montarBotoesHorarios($arrHorarios, $data, $arrControleHorario, $bolDesativarAgendamento, $tipoServico = null){

    $bolDesativarAgendamentoPadrao = $bolDesativarAgendamento;
    $arrTodosHorarios = array();

    //este serviço requer 2 horarios seguidos
    if($tipoServico == 'cb') {//deve ter um controle de horarios reservados, para saber os dias que sera possivel a marcaçao
        $cont = 0;
        $bolContinua = true;
        $horario = '';
        do {
            if ($cont == 0) {
                $horario = $arrControleHorario['min'];
            } else {
                $horario = date('H:i', strtotime($horario . ' + 60 minutes'));
                $bolContinua = (strtotime($horario) < strtotime($arrControleHorario['max']));
            }
            $bolReservado = count($arrHorarios) > 0 && in_array($horario, $arrHorarios['horarios']);
            $arrTodosHorarios[$cont] = array($horario, $bolReservado);
            $cont++;
        } while ($bolContinua);
    }

    $suspensoesRN = new SuspensoesRN();

    $cont = 0;
    $bolContinua = true;
    $horario= '';
    do {
        if ($cont == 0) {
            $horario = $arrControleHorario['min'];
        } else {
            $horario = date('H:i', strtotime($horario . ' + 60 minutes'));
            $bolContinua = (strtotime($horario) < strtotime($arrControleHorario['max']));
        }

        //horario atual esta disponivel e proximo esta indisponivel
        //ou é o ultimo horario do dia
        if(!$arrTodosHorarios[$cont][1] && $arrTodosHorarios[$cont+1][1] || ($tipoServico == 'cb' && !$bolContinua)){
            $bolDesativarAgendamento = true;
        }

        $bolReservado = count($arrHorarios)> 0 &&  in_array($horario,$arrHorarios['horarios']);

        $bolMinhaReserva = false;
        $acaoOnClickAgendar = ' onclick="agendarHorario(\''.$horario.'\',\''.$data.'\',this);" ';
        if($bolReservado){

            $bolMinhaReserva = isset($arrHorarios[$_SESSION['id_usuario']]) &&
                in_array($horario,$arrHorarios[$_SESSION['id_usuario']]);

            if($bolMinhaReserva){
                $acaoOnclickDesmarcar = 'desmarcarHorario(\''.$horario.'\',\''.$data.'\');';
                $acaoOnClickAgendar = '';
            }
        }


        //verificar se existe uma suspensao para a data
        if(!$bolDesativarAgendamento) {
            $bolDesativarAgendamento = $suspensoesRN->getBolExisteSuspensaoData($data, $horario);
        }

        //se a data for menor que a data atual - mostrar como reservado
          $dataAux= strtotime(str_replace('/','-',$data));
     $dataHoje= strtotime(date('d-m-Y'));
    

        if($dataAux <= $dataHoje){
            $bolReservado = true;
        }


        ?>
        <tr <?=($bolReservado?' id="trReservado"':' id="trDisponivel"')?>>
            <td style="text-align: center">
                <button type="button" <?=(($bolReservado || $bolDesativarAgendamento) && !$bolMinhaReserva?
                    'disabled="disabled"': $acaoOnClickAgendar)?>
                        style="width:90%"
                        class="btn btn-round btn-<?=($bolReservado||$bolMinhaReserva?'danger':'success')?>">
                    <?
                    echo $horario;

                    if($bolMinhaReserva){

                        $bolFinalizado = isset($arrHorarios[$_SESSION['id_usuario']]) && isset($arrHorarios['finalizados']) &&
                            in_array($horario,$arrHorarios['finalizados']);

                        if($bolFinalizado){
                            echo ' - '.$_SESSION['nome_usuario'] .' -
                                            <div style="color:#000; font-weight:500; display:inline">
                                            FINALIZADO
                                            </div>';
                        }
                        else{
                            echo ' - '.$_SESSION['nome_usuario'] .' -
                                            <div onClick="'.$acaoOnclickDesmarcar.'"
                                            style="color:#000; font-weight:500; display:inline">
                                            DESMARCAR
                                            </div>';
                        }

                    }else{
                        if($bolDesativarAgendamento && !$bolReservado){
                            echo ' - Indisponível';
                        }else{
                            echo $bolReservado? ' - Reservado':' - Disponível';
                        }

                    }
                    ?>
                </button>
            </td>
        </tr>

        <?
        $cont++;
        $bolDesativarAgendamento = $bolDesativarAgendamentoPadrao;
    }while ($bolContinua && $cont < 10);

}





public static function diasemana($data)
{  // Traz o dia da semana para qualquer data informada
    $ano =  substr($data,6,4);
    $mes =  substr($data,3,2);
    $dia =  substr($data,0,2);

    $diasemana = date("w", mktime(0,0,0,$mes, $dia, $ano) );
    switch($diasemana){
        case"0": $diasemana = "Domingo";   break;
        case"1": $diasemana = "Segunda-Feira"; break;
        case"2": $diasemana = "Terça-Feira";   break;
        case"3": $diasemana = "Quarta-Feira";  break;
        case"4": $diasemana = "Quinta-Feira";  break;
        case"5": $diasemana = "Sexta-Feira";   break;
        case"6": $diasemana = "Sábado";   break;
    }
    return $diasemana;
}
}