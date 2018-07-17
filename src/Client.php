<?php 

namespace Lazal;

use Exception;
/**
*  returns a Lazal connection
*
*
*  @author v.sahithkumar@gmail.com
*/
class Client {

   /**  @var string $_socket instance of php socket*/
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

        $address = $params['host'];
        $service_port = $params['port'];
        $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);

        if ($socket === false) {
            throw new Exception("socket_create() failed: reason: " . socket_strerror(socket_last_error()) . "\n");
        } 
        try {
          $result = socket_connect($socket, $address, $service_port);
          if ($result === false) {
              throw new Exception("socket_connect() failed.\nReason: ($result) " . socket_strerror(socket_last_error($socket)) . "\n");
          } 
        }catch(Exception $e) {
          throw new Exception("Could not establish connection with Lazal");
        }
        $this->_sock = $socket;
    
   }

   public function set($key, $val) {
        $this->sockWrite("SET $key $val \r");
        return (bool)$this->sockRead();
   }

   public function get($key) {
        $this->sockWrite("GET $key \r");
        return $this->sockRead();
   }

   public function delete($key) {
        $this->sockWrite("DEL $key \r");
        return $this->sockRead();
   }

   private function sockWrite($command) {
        socket_write($this->_sock, $command, strlen($command));
   }

   private function sockRead() {
        $r = '';
        while ($out = socket_read($this->_sock, 2048)) {
            $r .= $out;
            if (strpos($out, "\n") !== false) break;
        }
        return $r;
   }

   public function close() {
        socket_close($this->_sock);
   }

}