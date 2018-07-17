<?php namespace Lazal\Client;

/**
*  A sample class
*
*  Use this section to define what this class is doing, the PHPDocumentator will use this
*  to automatically generate an API documentation using this information.
*
*  @author yourname
*/
class Lazal{

   /**  @var string $m_SampleProperty define here what this variable is for, do this for every instance variable */
   private $_sock = '';
 
  /**
  * Opens connections to Lazal Instance 
  *
  *
  * @param array $params An Array of connection details
  *
  * @return Lazal Instance
  */
   public function __construct($params){

        $address = $params[$address];
        $port = $params[$port];
        $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);

        if ($socket === false) {
            throw new Exception("socket_create() failed: reason: " . socket_strerror(socket_last_error()) . "\n");
        } 

        $result = socket_connect($socket, $address, $service_port);
        if ($result === false) {
            throw new Exception("socket_connect() failed.\nReason: ($result) " . socket_strerror(socket_last_error($socket)) . "\n");
        } 
        $this->_sock = $socket;
    
   }

   public function set($key, $val) {
        $this->sockWrite("SET $key $val");
        return (bool)$this->sockRead();
   }

   public function get($key) {
        $this->sockWrite("GET $key");
        return $this->sockRead();
   }

   public function delete($key) {
        $this->sockWrite("DEL $key");
        return $this->sockRead();
   }

   private function sockWrite($command) {
        socket_write($socket, $command, strlen($in));
   }

   private function sockRead() {
        $r = '';
        while ($out = socket_read($this->sock, 2048)) {
            $r .= $output;
        }
        return $r;
   }

}