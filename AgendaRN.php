<?php
public function buscarAgendamentosDia($data)
    {

        $data = date('Y-m-d', strtotime(str_replace('/','-',$data)));

        $sql = "SELECT * FROM agenda a
              WHERE
            a.data = ?";

        $arrObj = $this->consultar($sql,array($data));

        $arrRetorno = array();
//        $arrRetorno['desmarcados'] = array();
        foreach($arrObj as $obj){
            $arrRetorno[$obj->id_cliente][]= $obj->horario;
            $arrRetorno['horarios'][] = $obj->horario;

            if($obj->situacao == 'desmarcado') {
                $arrRetorno['desmarcados'][] = $obj->horario;
            }

            if($obj->situacao == 'finalizado') {
                $arrRetorno['finalizados'][] = $obj->horario;
            }
        }

//        echo '<pre>';
//        print_r($arrObj);
//        echo '</pre>';

        return $arrRetorno;


    }



    public function desmarcarHorario($idCliente,$data,$horario){
        //consultar e garantir que o horario existe
        $sqlBuscarHorario = 'SELECT * FROM agenda WHERE id_cliente=? AND data=? AND horario=? AND situacao=?';
        $objHorario = $this->consultar($sqlBuscarHorario, array($idCliente,$data,$horario,'agendado'));

        if(count($objHorario)>0){
            //desmarcar horario
            $arrColunas = array('id_cliente','data','horario','situacao');
            $arrValores = array($idCliente, $data, $horario, 'agendado');
            $this->apagar($arrColunas,$arrValores);

        }
    }

    public function agendarHorario($idCliente,$data,$horario,$strTipoServico){

        $dataFormatada = date('Y-m-d', strtotime(str_replace('/','-',$data)));
        $arrColunas = array('id_cliente','data','horario','situacao','id_tipo_agendamento');
        $arrDados = array($idCliente, $dataFormatada, $horario, 'agendado','2');
        $this->cadastrar($arrColunas,$arrDados);

        if($strTipoServico == 'cb'){
            //agenda mais um - próximo horario
            $horaNova = strtotime("$horario + 30 minutes");
            $horaNovaFormatada = date("H:i",$horaNova);

            $arrDados = array($idCliente, $dataFormatada, $horaNovaFormatada, 'agendado','2');
            $this->cadastrar($arrColunas,$arrDados);
        }

    }