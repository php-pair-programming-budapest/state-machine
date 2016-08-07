<?php

namespace StateMachine;

class StatusObject implements StatusInterface
{
	/**
	 * @var StatusInterface[]
	 */
	private $statuses = array();

	/**
	 * @var
	 */
	private $name;

	/**
	 * StatusObject constructor.
	 * @param string $name
	 */
	public function __construct($name)
	{
		if (!is_scalar($name) || empty(trim($name))) {
			throw new \InvalidArgumentException();
		}
		$this->name = $name;
	}

	/**
	 * @param StatusInterface $status
	 */
	public function addNextStatus(StatusInterface $status)
	{
		$this->statuses[$status->getName()] = $status;
	}

	/**
	 * @return string
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * @return StatusInterface[]
	 */
	public function getNextStatuses()
	{
		return array_values($this->statuses);
	}

	/**
	 * @param StatusInterface $status
	 * @return bool
	 */
	public function canChangeStatus(StatusInterface $status)
	{
		return isset($this->statuses[$status->getName()]);
	}
}