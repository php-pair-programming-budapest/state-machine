<?php

namespace Tests\StateMachine\Unit;


use StateMachine\StatusObject;

class StatusObjectTest extends \PHPUnit_Framework_TestCase
{

	/**
	 * @tests
	 * @dataProvider nameDataProvider
	 * @param string $name
	 */
	public function nameTest($name)
	{
		$stateObject = new StatusObject($name);
		$this->assertEquals($name, $stateObject->getName());
	}

	/**
	 * @return array
	 */
	public function nameDataProvider()
	{
		return array(
			array('foo'),
			array('*+&#'),
			array('_$ v'),
			array('őúűáéüó'),
			array(10),
		);
	}

	/**
	 * @tests
	 * @dataProvider wrongNameDataProvider
	 * @expectedException \InvalidArgumentException
	 * @param string $name
	 */
	public function wrongName($name)
	{
		new StatusObject($name);
	}

	/**
	 * @return array
	 */
	public function wrongNameDataProvider()
	{
		return array(
			array(''),
			array(' '),
			array('  '),
			array(array(true)),
			array(false),
			array(new \stdClass())
		);
	}

	/**
	 * @tests
	 */
	public function nextStatuses()
	{
		$status = new StatusObject('foo');
		$nextStatus1 = new StatusObject('bar');
		$nextStatus2 = new StatusObject('foobar');

		$status->addNextStatus($nextStatus1);
		$status->addNextStatus($nextStatus2);

		$this->assertEquals(
			array(
				$nextStatus1,
				$nextStatus2
			),
			$status->getNextStatuses()
		);
	}

	/**
	 * @tests
	 */
	public function canChangeStatus_ok()
	{
		$status = new StatusObject('foo');
		$nextStatus1 = new StatusObject('bar');
		$status->addNextStatus($nextStatus1);

		$this->assertTrue(
			$status->canChangeStatus($nextStatus1)
		);
	}

	/**
	 * @tests
	 */
	public function canChangeStatus_notAddedStatus()
	{
		$status = new StatusObject('foo');
		$nextStatus1 = new StatusObject('bar');
		$nextStatus2 = new StatusObject('foobar');
		$status->addNextStatus($nextStatus2);

		$this->assertFalse(
			$status->canChangeStatus($nextStatus1)
		);
	}

	/**
	 * @tests
	 */
	public function canChangeStatus_emptyStatus()
	{
		$status = new StatusObject('foo');
		$nextStatus1 = new StatusObject('bar');

		$this->assertFalse(
			$status->canChangeStatus($nextStatus1)
		);
	}
}
