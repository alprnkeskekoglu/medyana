<?php

namespace App\Contracts\DataSource\Output;

abstract class BaseOutput
{
    abstract public function output(array $data);
}
