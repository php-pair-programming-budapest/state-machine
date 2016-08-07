<?php
namespace Tests\StateMachine\Unit\Fixture;

use StateMachine\StateAbleInterface;
use StateMachine\StatusInterface;

class DummyModel implements StateAbleInterface
{
	/**
	 * @var StatusInterface
	 */
	private $status;

	/**
	 * @return StatusInterface
	 */
	public function getState()
	{
		return $this->status;
	}

	/**
	 * @param StatusInterface $status
	 * @return void
	 */
	public function setState(StatusInterface $status)
	{
		$this->status = $status;
	}
}