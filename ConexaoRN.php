
<?php
class ConexaoRN extends PDO {


    private $dsn = 'mysql:dbname=salaReuniaoDB;host=localhost';
    private $user = 'root';
    private $password = '12345';
    public  $handle = null;


    function __construct( ) {
        try {

            if ( $this->handle == null ) {
                $dbh = parent::__construct( $this->dsn , $this->user , $this->password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8" ));
                $this->handle = $dbh;
                $this->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
                return $this->handle;
            }
        }
        catch ( PDOException $e ) {
            echo 'Connection failed: ' . $e->getMessage( );
            return false;
        }
    }

    function __destruct( ) {
        $this->handle = NULL;
    }


    public function apagar($arrColunas, $arrDados){
        try{

            $tabela = $this->getStrNomeTabela();

            if(count($arrColunas) != count($arrDados)){
                throw new Exception('Erro ao apagar dados.');
            }

            $sql = "DELETE FROM ".$tabela." WHERE ";

            $separador = '';
            foreach($arrColunas as $coluna){
                $sql .= $separador.$coluna.'= :'.$coluna;
                $separador=' AND ';
            }

            $query = $this->prepare($sql);

            for ($i = 0; $i < count($arrDados); $i++) {

                $arrDados[$i] = (strlen($arrDados[$i])==0) ? NULL : $arrDados[$i];

                $query->bindParam(':'.$arrColunas[$i], $arrDados[$i]);
            }


            if($query->execute()){
                return true;
            }else{
                return false;
            }


        }catch (Exception $e){
            throw new Exception('Erro: '.$e->__toString());
        }
    }


    public function consultar($sql, $params = array(), $bolReturnArray = false){

        try {
            $query = $this->prepare($sql);

            $params = array_filter($params);

//            _dbg($params);


            for ($i = 0; $i < count($params); $i++) {
                $tipo = (is_numeric($params[$i]) ? PDO::PARAM_INT : PDO::PARAM_STR);
                $query->bindParam($i + 1, $params[$i], $tipo);
            }


            if ($query->execute()) {

                if ($bolReturnArray) {
                    return $query->fetchAll(PDO::FETCH_ASSOC);
                } else {
                    return $query->fetchAll(PDO::FETCH_OBJ);
                }

            } else {
                return false;
            }

        }catch (Exception $e){
            throw new Exception('Erro: '.$e->getMessage());
        }
    }


    public function cadastrar($arrColunas, $arrDados, $bolRetornaIdInserido = false, $retornaSQL = false, $tabela=''){
        try{


            $tabela = ($tabela == "" ? $this->getStrNomeTabela() : $tabela);


            if(count($arrColunas) != count($arrDados)){
                FuncoesINT::exibirAlerta('warning','<strong>Não foi possível realizar a nova inclusão.</strong>');
                return;
            }


            $sql = "INSERT INTO ".$tabela."(";

            $separador = '';
            foreach($arrColunas as $coluna){
                $sql .= $separador.$coluna;
                $separador=', ';
            }

            $sql .= ') VALUES (';

            $separador = '';
            foreach($arrDados as $valor){

                $valor = (is_null($valor) || $valor=="" || $valor==" " || strlen($valor)==0) ? NULL : "'".$valor."'";

                $sql .= $separador.$valor;
                $separador=', ';
            }
            $sql .= ');';

            if($retornaSQL){
                var_dump($sql);
                return false;
            }


            $query = $this->prepare($sql);

            if($query->execute()) {
                if($bolRetornaIdInserido){
                    return $this->lastInsertId();
                }
                return true;
            }else{
                return false;
            }


        }catch (Exception $e){
            throw new Exception('Erro: '.$e->__toString());
        }
    }


    public function alterar($arrColunas, $arrDados, $valPK, $tabela = '', $descpk = ''){
        try{

            $tabela = ($tabela == "" ? $this->getStrNomeTabela() : $tabela);
            $strDescPK = ($descpk == "" ? $this->getStrChavePrimaria() : $descpk);

            if(count($arrColunas) != count($arrDados)){
                throw new Exception('Erro ao alterar dados.');
            }


            $sql = "UPDATE ".$tabela." SET ";

            $separador = '';
            foreach($arrColunas as $coluna){
                $sql .= $separador.$coluna.'= :'.$coluna;
                $separador=', ';
            }
            $sql .= ' WHERE '.$strDescPK.'= :'.$strDescPK;

            $query = $this->prepare($sql);

            for ($i = 0; $i < count($arrDados); $i++) {

                $arrDados[$i] = (strlen($arrDados[$i])==0) ? NULL : $arrDados[$i];

                $query->bindParam(':'.$arrColunas[$i], $arrDados[$i]);
            }

            $query->bindParam(':'.$strDescPK, $valPK);



            if($query->execute()){
                return true;
            }else{
                return false;
            }


        }catch (Exception $e){
            throw new Exception('Erro: '.$e->__toString());
        }
    }

}
?>