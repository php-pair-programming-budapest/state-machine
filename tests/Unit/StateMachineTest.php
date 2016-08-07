<?php

namespace Tests\StateMachine\Unit;


use StateMachine\StateMachine;
use StateMachine\StatusObject;
use Tests\StateMachine\Unit\Fixture\DummyModel;

class StateMachineTest extends \PHPUnit_Framework_TestCase
{

	/**
	 * @tests
	 */
	public function changeState_ok()
	{
		$state1 = new StatusObject('1');
		$state2 = new StatusObject('2');

		$state1->addNextStatus($state2);

		$stateMachine = new StateMachine();

		$model = new DummyModel();
		$model->setState($state1);

		$stateMachine->process($model, $state2);

		$this->assertEquals($state2, $model->getState());
	}

	/**
	 * @tests
	 * @expectedException \InvalidArgumentException
	 */
	public function changeState_notAllowed()
	{
		$state1 = new StatusObject('1');
		$state2 = new StatusObject('2');
		$state3 = new StatusObject('3');

		$state1->addNextStatus($state2);

		$stateMachine = new StateMachine();

		$model = new DummyModel();
		$model->setState($state1);



		$stateMachine->process($model, $state3);
	}

}
