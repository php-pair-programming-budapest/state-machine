<?php

namespace StateMachine;

interface StateAbleInterface
{

	/**
	 * @return StatusInterface
	 */
	public function getState();

	/**
	 * @param StatusInterface $status
	 * @return void
	 */
	public function setState(StatusInterface $status);

}