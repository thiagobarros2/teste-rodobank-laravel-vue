<?php

namespace App\Builders;

interface Name
{
    public function name(string $name): Age|DriverBuilder;
}

interface Age
{
    public function age(int $age): HasChildren|IsMaried|DriverBuilder;
}

interface HasChildren
{
    public function hasChildren(bool $hasChildren): IsMaried|DriverBuilder;
}

interface IsMaried
{
    public function isMaried(bool $isMaried): HasChildren|DriverBuilder;
}

interface Build
{
    public function build(): DriverBuilder;
}

class DriverBuilder implements Name, Age, HasChildren, IsMaried, Build
{
    public string $name;

    public int $age;

    public bool $hasChildren;

    public bool $isMaried;

    public static function reset(): Name
    {
        return new DriverBuilder();
    }

    public function name(string $name): Age
    {
        $this->name = $name;

        return $this;
    }

    public function age(int $age): HasChildren|IsMaried
    {
        $this->age = $age;

        return $this;
    }

    public function hasChildren(bool $hasChildren): IsMaried|DriverBuilder
    {
        $this->hasChildren = $hasChildren;

        return $this;
    }

    public function isMaried(bool $isMaried): HasChildren|DriverBuilder
    {
        $this->isMaried = $isMaried;

        return $this;
    }

    public function build(): DriverBuilder
    {
        return $this;
    }
}
