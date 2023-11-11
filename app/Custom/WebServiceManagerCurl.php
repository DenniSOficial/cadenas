<?php namespace App\custom;

class WebServiceManagerCurl
{
    private $url;
    private $args;
    private $header;
    private $proxy;
    private $proxyIp;
    private $proxyUser;
    private $proxyPass;
    /**
     * WebServiceManagerCurl constructor.
     * @param string $url
     * @param Array $args Argumentos para enviar al Webservice
     * @param bool $proxy
     * @param int $proxyIp Ip con Puerto Ej: 190.0.0.1:8080
     * @param string $proxyUser
     * @param string $proxyPass
     */
    public function __construct($url, $args = '', $header = '' , $proxy = false, $proxyIp = 0, $proxyUser = '', $proxyPass = '')
    {
        $this->url = $url;
        $this->args = $args;
        $this->header = $header;
        $this->proxy = $proxy;
        if ($proxy) {
            $this->proxyIp = $proxyIp;
            $this->proxyUser = $proxyUser;
            $this->proxyPass = $proxyPass;
        }
    }
    public function get()
    {
        $curl = curl_init($this->url);
        if ($this->proxy) {
            curl_setopt($curl, CURLOPT_PROXY, $this->proxyIp);     // PROXY details with port
            $proxyUserPwd = $this->proxyUser . ':' . $this->proxyPass;
            curl_setopt($curl, CURLOPT_PROXYUSERPWD, $proxyUserPwd);
        }
        /**
         * CURLOPT_RETURNTRANSFER
         * TRUE para devolver el resultado de la transferencia como string
         * del valor de curl_exec() en lugar de mostrarlo directamente.
         * - tomado de php.net
         **/
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('User-Agent: php-curl'));
        /**
         * CURLOPT_SSL_VERIFYPEER
         * FALSE para que cURL no verifique el peer del certificado.
         * Para usar diferentes certificados para la verificación se pueden especificar con la opción CURLOPT_CAINFO
         * o se puede especificar el directorio donde se encuentra el certificado con la opción CURLOPT_CAPATH.
         * - tomado de php.net
         *
         */
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        /**
         * curl_exec
         * Ejecuta la sesión cURL que se le pasa como parámetro.
         * - tomado de php.net
         */
        $response = curl_exec($curl);
        /**
         *  curl_getinfo
         *  Obtener información relativa a una transferencia específica
         *  - tomado de php.net
         */
        
        $info = curl_getinfo($curl);
        if ($info['http_code'] == 200) {
            //print_r($response);
            //print_r($info);
        } else {
            //echo "Curl error: " . curl_error($curl);
        }
        //dd($response);
        curl_close($curl);

        return json_decode($response);
    }

    public function post()
    {

        $dataJSON = json_encode($this->args);
        $headerJSON = json_encode($this->header);
        
        $ch = curl_init($this->url);
        
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataJSON);
        curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            
        $rpta = curl_exec($ch);
        //dd($rpta);
        curl_close($ch);
       
        $respuesta = json_decode($rpta, true);
        
        return $respuesta;
    }
}