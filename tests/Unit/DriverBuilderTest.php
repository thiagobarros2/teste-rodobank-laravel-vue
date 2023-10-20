<?php

use App\Builders\DriverBuilder;

beforeEach(function () {
    $this->driver = DriverBuilder::reset();
});

it('driver builder', function () {

    $driver = $this->driver
        ->name('John Due')
        ->age(42)
        ->isMaried(true)
        ->hasChildren(true)
        ->build();

    expect($driver->name)
        ->toEqual('John Due');
    expect($driver->age)
        ->toBeInt()
        ->toEqual(42);
    expect($driver->isMaried)
        ->toBeTrue();
    expect($driver->hasChildren)
        ->toBeTrue();
});

it('driver builder only name', function () {
    $driver = $this->driver;

    $driver->name('ok')
        ->build();

    expect($driver->name)
        ->toEqual('ok');
    expect($driver)
        ->toHaveProperties(['age', 'isMaried', 'hasChildren']);
    expect(isset($driver->age))
        ->toBeFalse();
    expect(isset($driver->isMaried))
        ->toBeFalse();
    expect(isset($driver->hasChildren))
        ->toBeFalse();
});
