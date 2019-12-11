<?php
use PHPUnit\Framework\TestCase;

class UpdateUserTest extends TestCase
{
	/****************Test of Test!******************/
	public function testIfEmptyArray()
	{
		$user_array = [];

		//check if empty array is empty!
		$this->assertSame(0, count($user_array));
	}

	
}