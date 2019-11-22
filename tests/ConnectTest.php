<?php
use PHPUnit\Framework\TestCase;

class UserAuthTest extends TestCase
{

	/****************Test of Test!******************/
	public function testIfEmptyArray()
	{
		$user_array = [];

		//check if empty array is empty!
		$this->assertSame(0, count($user_array));
	}

	/****************Connect My SQL Tests******************/
	public function testConnectMySQLPDOSetAttributeReturnsTrue()
	{
		$pdoMock = $this->createMock(PDO::class);

		$pdoMock->expects($this->once())->method('setAttribute')->willReturn(true);

		$test = $pdoMock->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$this->assertInstanceOf(PDO::class, $pdoMock);
		$this->assertTrue($test);
	}



	/****************Connect SQLite Tests******************/
	public function testConnectSQLitePDOSetAttributeReturnsTrue()
	{
		$pdoMock = $this->createMock(PDO::class);

		$pdoMock->expects($this->once())->method('setAttribute')->willReturn(true);

		$test = $pdoMock->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$this->assertInstanceOf(PDO::class, $pdoMock);
		$this->assertTrue($test);
	}

}