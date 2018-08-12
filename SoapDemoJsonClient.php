<?php
/**
 * @service SoapDemoJsonClient
 */
class SoapDemoJsonClient{
	/**
	 * The WSDL URI
	 *
	 * @var string
	 */
	public static $_WsdlUri='http://wan24.de/test/phpwsdl2/demo.php?WSDL';
	/**
	 * The PHP SoapClient object
	 *
	 * @var object
	 */
	public static $_Server=null;
	/**
	 * The endpoint URI
	 *
	 * @var string
	 */
	public static $_EndPoint='http://wan24.de/test/phpwsdl2/demo.php';

	/**
	 * Send a SOAP request to the server
	 *
	 * @param string $method The method name
	 * @param array $param The parameters
	 * @return mixed The server response
	 */
	public static function _Call($method,$param){
		$call=Array(
			"call"=>$method,
			"param"=>$param
		);
		return json_decode(file_get_contents(self::$_EndPoint."?JSON=".urlencode(json_encode($call))));
	}

	/**
	 * Get a complex type object
	 *
	 * @return ComplexTypeDemoB The object
	 */
	public function GetComplexType(){
		return self::_Call('GetComplexType',Array(
		));
	}

	/**
	 * Print an object
	 *
	 * @param ComplexTypeDemoB $obj The object
	 * @return string The result of print_r
	 */
	public function PrintComplexType($obj){
		return self::_Call('PrintComplexType',Array(
			$obj
		));
	}

	/**
	 * Print an array of objects
	 *
	 * @param ComplexTypeDemoBArray $arr A ComplexTypeDemoB array
	 * @return stringArray The results of print_r
	 */
	public function ComplexTypeArrayDemo($arr){
		return self::_Call('ComplexTypeArrayDemo',Array(
			$arr
		));
	}

	/**
	 * Say hello demo
	 *
	 * @param string $name Some name (or an empty string)
	 * @return string Response string
	 */
	public function SayHello($name){
		return self::_Call('SayHello',Array(
			$name
		));
	}

	/**
	 * This method has no parameters and no return value, but it is visible in WSDL, too
	 *
	 */
	public function DemoMethod(){
		return self::_Call('DemoMethod',Array(
		));
	}
}

/**
 * This is how to define a complex type f.e. - the class ComplexTypeDemo doesn't need to exists,
 * but it would make it easier for you to return that complex type from a method
 *
 * @pw_element string $StringA A string with a value
 * @pw_element string $StringB A string with a NULL value
 * @pw_element int $Integer An integer
 * @pw_element boolean $Boolean A boolean
 * @pw_element DemoEnum $Enum An enumeration
 * @pw_complex ComplexTypeDemo
 */
class ComplexTypeDemo{
	/**
	 * A string with a value
	 *
	 * @var string
	 */
	public $StringA;
	/**
	 * A string with a NULL value
	 *
	 * @var string
	 */
	public $StringB;
	/**
	 * An integer
	 *
	 * @var int
	 */
	public $Integer;
	/**
	 * A boolean
	 *
	 * @var boolean
	 */
	public $Boolean;
	/**
	 * An enumeration
	 *
	 * @var DemoEnum
	 */
	public $Enum;
}

/**
 * This complex type inherits all properties of ComplexTypeDemo
 *
 * @pw_element string $AdditionalString An additional string
 * @pw_complex ComplexTypeDemoB
 */
class ComplexTypeDemoB extends ComplexTypeDemo{
	/**
	 * An additional string
	 *
	 * @var string
	 */
	public $AdditionalString;
}




/**
 * This is how to define an enumeration. You don't need the class DemoEnum - it's just to demonstrate how
 * I handle enumerations in PHP.
 *
 * @pw_enum string DemoEnum ValueA=ValueA,ValueB=ValueB,ValueC=ValueC
 */
abstract class DemoEnum{
	/**
	 * @var string
	 */
	const $ValueA="ValueA";
	/**
	 * @var string
	 */
	const $ValueB="ValueB";
	/**
	 * @var string
	 */
	const $ValueC="ValueC";
}

/**
 * This is the exception type for all methods
 *
 * @pw_element string $message The message
 * @pw_element int $code The code
 * @pw_element string $file The file name
 * @pw_element int $line The line number
 * @pw_complex SoapFault
 */
class SoapFault{
	/**
	 * The message
	 *
	 * @var string
	 */
	public $message;
	/**
	 * The code
	 *
	 * @var int
	 */
	public $code;
	/**
	 * The file name
	 *
	 * @var string
	 */
	public $file;
	/**
	 * The line number
	 *
	 * @var int
	 */
	public $line;
}