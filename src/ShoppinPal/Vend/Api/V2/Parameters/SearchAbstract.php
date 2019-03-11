<?php

namespace ShoppinPal\Vend\Api\V2\Parameters;

abstract class SearchAbstract
{
    protected $parameters = [];

    protected function exclude($name, $value)
    {
        $this->parameters["-{$name}"] = $value;
        return $this;
    }

    protected function include($name, $value)
    {
        $this->parameters["{$name}"] = $value;
        return $this;
    }

    public function getParameters()
    {
        return $this->parameters;
    }
}
