<?php

class Five9ContactsTest extends PHPUnit_Framework_TestCase
{
	
  /**
  * Just check if the YourClass has no syntax error
  *
  * This is just a simple check to make sure your library has no syntax error. This helps you troubleshoot
  * any typo before you even use this library in a real project.
  *
  */
  	public function testIsThereAnySyntaxError()
  	{
		$credentials = [
		    'login' => "",
		    'password' => "",
		];
		
		$var = new Bradstw\Five9\Methods\Contacts($credentials);
	 	$this->assertTrue(is_object($var));
	  	unset($var);
  	}
}
