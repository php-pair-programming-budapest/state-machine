# State machine

## Usage examples

```php
$inStock = new StatusObject('in-stock');
$ordered = new StatusObject('ordered');
$shipped = new StatusObject('shipped');

$inStock->addNextStatus($ordered);

$ordered->addNextStatus($shipped);
$ordered->addNextStatus($inStock); // in case of cancelling the order

$stateMachine = new StateMachine();

$model = new Order(); 
$model->setState($inStock);

if ($model->getState()->canChangeStatus($ordered)) {
	$stateMachine->process($model, $ordered);
}


```

## Test

[![Build Status](https://travis-ci.org/php-pair-programming-budapest/state-machine.svg?branch=master)](https://travis-ci.org/php-pair-programming-budapest/state-machine)