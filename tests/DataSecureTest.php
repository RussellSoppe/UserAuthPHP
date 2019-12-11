 <?php
use PHPUnit\Framework\TestCase;

class DataSecureTest extends TestCase
{
	private $register_array = array(
		"firstname"=> "First",
		"lastname"=> "Last",
		"username"=> "cool@cool.com",
		"password"=> "1234", 
		"re-password"=> "1234",
		"address"=> ""
	);

	private $register_array_honey_pot = array(
		"firstname"=> "First",
		"lastname"=> "Last",
		"username"=> "cool@cool.com",
		"password"=> "1234", 
		"re-password"=> "1234",
		"address"=> "1234 Street"
	);

	private $register_array_no_match = array(
		"firstname"=> "First",
		"lastname"=> "Last",
		"username"=> "cool@cool.com",
		"password"=> "1234", 
		"re-password"=> "12345",
		"address"=> ""
	);

	private $register_array_empty_required = array(
		"firstname"=> "First",
		"lastname"=> "",
		"username"=> "cool@cool.com",
		"password"=> "1234", 
		"re-password"=> "1234",
		"address"=> ""
	);

	private $login_array = array(
		"username"=> "cool@cool.com",
		"password"=> "1234", 
		"address"=> ""
	);

	private $login_array_empty_required = array(
		"username"=> "cool@cool.com",
		"password"=> "", 
		"address"=> ""
	);

	private $login_array_honey_pot = array(
		"username"=> "cool@cool.com",
		"password"=> "1234", 
		"address"=> "1234 Street"
	);

	private $script_array = array(
		"username"=> "cool@cool.com",
		"password"=> "1234", 
		"address"=> "",
		"code" => "<script>console.log('test');</script>"
	);

	private $password = '1234$Yes!';
	private $password_match = '1234$Yes!';
	private $password_no_match = '1234$No!';

	/****************Test of Test!******************/
	public function testIfEmptyArray()
	{
		$user_array = [];

		//check if empty array is empty!
		$this->assertSame(0, count($user_array));
	}

	/****************Filter User Data******************/

	public function testFilterUserDataIsArray()
	{
		// Register Case
		$user_array = DataSecure::filterUserData($this->register_array);
		$this->assertIsArray($user_array);

		// Login Case
		$user_array = DataSecure::filterUserData($this->login_array);
		$this->assertIsArray($user_array);

	}

	public function testFilterUserDataHasKeyUsername()
	{
		// Register Case
		$user_array = DataSecure::filterUserData($this->register_array);
		$this->assertArrayHasKey('username', $user_array);

		// Login Case
		$user_array = DataSecure::filterUserData($this->login_array);
		$this->assertArrayHasKey('username', $user_array);

	}

	public function testFilterUserDataIsString()
	{
		// Register Case
		$user_array = DataSecure::filterUserData($this->register_array);
		$this->assertContainsOnly('string', $user_array);

		// Login Case
		$user_array = DataSecure::filterUserData($this->login_array);
		$this->assertContainsOnly('string', $user_array);

	}

	public function testFilterUserDataNoScriptTag()
	{
		
		$user_array = DataSecure::filterUserData($this->script_array);

		// check if script tag is present - small level of sanitization check
		foreach($user_array as $item){
			$this->assertStringNotContainsString('script', $item);
		}

	}

	/****************CheckHasHoneyPot******************/

	// String In The HoneyPot Returns False, !empty("") = false
	public function testCheckHasHoneyPotCheckBoolAndFalse()
	{

		$check_false = DataSecure::checkHasHoneyPot($this->register_array['address']);
		$this->assertIsBool($check_false);
		$this->assertFalse($check_false);

	}

	// String In The HoneyPot Returns true, !empty("string") = true
	public function testCheckHasHoneyPotCheckBoolAndTrue()
	{

		$check_true = DataSecure::checkHasHoneyPot($this->register_array_honey_pot['address']);
		$this->assertIsBool($check_true);
		$this->assertTrue($check_true);
	}


	/****************CheckHasEmptyFields******************/
	
	// Check if empty field exists True if fields are empty, false if filled up (2) tests
	public function testCheckHasEmptyFieldsBoolAndTrue()
	{
		$check_true = DataSecure::checkHasEmptyFields($this->register_array);
		$this->assertIsBool($check_true);
		$this->assertTrue($check_true);

	}

	public function testCheckHasEmptyFieldsBoolAndFalse()
	{
		$check_false = DataSecure::checkHasEmptyFields($this->login_array_honey_pot);
		$this->assertIsBool($check_false);
		$this->assertFalse($check_false);
	}

	/****************Check Password Match******************/

	// Check if passwords match or don't match (2) tests
	public function testCheckPasswordMatchBoolAndTrue()
	{
		$check_match = UserAuth::checkPasswordMatch($this->password, $this->password_match);

		$this->assertIsBool($check_match);
		$this->assertTrue($check_match);
	}

	public function testCheckPasswordMatchBoolAndFalse()
	{
		$check_not_match = UserAuth::checkPasswordMatch($this->password, $this->password_no_match);

		$this->assertIsBool($check_not_match);
		$this->assertFalse($check_not_match);
	}
	
	/****************Create Hash******************/
	public function testCreateHashIfHashIsString()
	{
		$check = UserAuth::createHash($this->password);

		$this->assertIsString($check);

		return $check;
	}


	
	/****************VerifyCred******************/

	/**
     * @depends testCreateHashIfHashIsString
     */
	public function testVerifyCredPasswordHashMatchTrue($hash)
	{
		
		$check = UserAuth::verifyCred($this->password_match, $hash);

		$this->assertIsBool($check);
		$this->assertTrue($check);
	}

	/**
     * @depends testCreateHashIfHashIsString
     */
	public function testVerifyCredPasswordHashMatchFalse($hash)
	{
		
		$check = UserAuth::verifyCred($this->password_no_match, $hash);

		$this->assertIsBool($check);
		$this->assertFalse($check);
	}


	/****************CheckRegisterFields******************/

	// checkRegisterFields Method (4) Tests
	public function testCheckRegisterFieldsReturnArrayFalseAndStringHoneyPot()
	{
		$check_array = DataSecure::checkRegisterFields($this->register_array_honey_pot);

		$this->assertIsArray($check_array);
		$this->assertFalse($check_array[0]);
		$this->assertIsString($check_array[1]);
	}

	
	public function testCheckRegisterFieldsReturnArrayFalseAndStringHasEmptyField()
	{
		$check_array = DataSecure::checkRegisterFields($this->register_array_empty_required);

		$this->assertIsArray($check_array);
		$this->assertFalse($check_array[0]);
		$this->assertIsString($check_array[1]);
	}

	public function testCheckRegisterFieldsReturnArrayFalseAndStringPasswordNotMatch()
	{
		$check_array = DataSecure::checkRegisterFields($this->register_array_no_match);

		$this->assertIsArray($check_array);
		$this->assertFalse($check_array[0]);
		$this->assertIsString($check_array[1]);
	}


	public function testCheckRegisterFieldsReturnArrayTrueAndArray()
	{
		$check_array = DataSecure::checkRegisterFields($this->register_array);
		$this->assertIsArray($check_array);
		$this->assertTrue($check_array[0]);
		$this->assertIsArray($check_array[1]);
	}


	/****************CheckLoginFields******************/

	// checkLoginFields Method (3) Tests
	public function testCheckLoginFieldsReturnArrayFalseAndStringHoneyPot()
	{
		$check_array = DataSecure::checkLoginFields($this->login_array_honey_pot);

		$this->assertIsArray($check_array);
		$this->assertFalse($check_array[0]);
		$this->assertIsString($check_array[1]);
	}

	
	public function testCheckLoginFieldsReturnArrayFalseAndStringHasEmptyField()
	{
		$check_array = DataSecure::checkLoginFields($this->login_array_empty_required);

		$this->assertIsArray($check_array);
		$this->assertFalse($check_array[0]);
		$this->assertIsString($check_array[1]);
	}

	public function testCheckLoginFieldsReturnArrayTrueAndArray()
	{
		$check_array = DataSecure::checkLoginFields($this->login_array);

		$this->assertIsArray($check_array);
		$this->assertTrue($check_array[0]);
		$this->assertIsArray($check_array[1]);
	}
}