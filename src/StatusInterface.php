<?php

namespace StateMachine;

interface StatusInterface
{
	/**
	 * @return string
	 */
	public function getName();

	/**
	 * @return StatusInterface[]
	 */
	public function getNextStatuses();

	/**
	 * @param StatusInterface $status
	 * @return bool
	 */
	public function canChangeStatus(StatusInterface $status);

}