<?php

namespace StateMachine;

class StateMachine
{
	/**
	 * @param StateAbleInterface $model
	 * @param StatusInterface $status
	 */
	public function process(StateAbleInterface $model, StatusInterface $status)
	{
		if (!$model->getState()->canChangeStatus($status)) {
			throw new \InvalidArgumentException(sprintf('Cannot change status to: %s', $status->getName()));
		}

		$model->setState($status);
	}
}