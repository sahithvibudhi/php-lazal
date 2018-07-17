<?php 

/**
*  Corresponding Class to Lazal Client
*
*
*  @author sahith vibudhi
*/
class LazalTest extends PHPUnit_Framework_TestCase{
	
  /**
  * Just check if the LazalCLient has no syntax error 
  *
  * This is just a simple check to make sure your library has no syntax error. This helps you troubleshoot
  * any typo before you even use this library in a real project.
  * Also checks if connection is working
  *
  */
  public function testIsThereAnySyntaxError(){
    $var = new Lazal\Client\Lazal(['host'=>'localhost', 'port'=>'5555']);
    $this->assertTrue(is_object($var));
    unset($var);
  }
  
  /**
  * Just check if set is working
  *
  */
  public function testSet(){
    $var = new Lazal\Client\Lazal;
    $this->assertTrue($var->set("key", "value") === true);
    unset($var);
  }
  
}