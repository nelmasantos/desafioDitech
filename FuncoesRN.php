<?

class FuncoesRN {


    public function headerPaginaInicial(){
        header('Location: index.php');
    }


    public static function assinarLink($link){
        $FuncoesRN = new FuncoesRN();

        if(strpos($link, '?') === false){
            $linkAssinado = $link.'?hash='.$FuncoesRN->gerarHash($link);
        }else{
            $linkAssinado = $link.'&hash='.$FuncoesRN->gerarHash($link);
        }
        return $linkAssinado;
    }



    private function gerarHash($link){
        $salt = md5($link.”frase de seguranca");
        $hash = strrev($salt);
        return $hash;
    }



    private function compararHash($hashURL, $link){
        $FuncoesRN = new FuncoesRN();
        $hashValido = $FuncoesRN->gerarHash($link);

        if(strcmp($hashURL, $hashValido) == 0){
            return true;
        }else{
            return false;
        }
    }

    public static function validarLink($link = null){

        $linkURL = $_SERVER['REQUEST_URI'];
        $linkComHash = strstr($linkURL,'index');

        if($linkComHash == ""){
            $linkComHash = strstr($linkURL,'login');
        }

        if(!$linkComHash){
            $linkComHash = strstr($linkURL,'controlador_ajax');
        }


        if(strpos($linkComHash, '&') !== false ) {
            $arrLink = explode('&hash=', $linkComHash);
        }else{
            $arrLink = explode('?hash=', $linkComHash);
        }

        $FuncoesRN = new FuncoesRN();
        if(!$FuncoesRN->compararHash($arrLink[1], $arrLink[0])){
            ?>
            <script>location.href = 'inc/logout.php?strMsg=Hash Invalido';</script>
            <?
            die;
        }

    }



    public static function soNumero($str) {
        return preg_replace("/[^0-9]/", "", $str);
    }





}