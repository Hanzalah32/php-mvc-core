<?php

namespace anzalahMvc\Core\form;

use anzalahMvc\Core\Model;

abstract class BaseField
{
    public Model $model;
    public string $attribute;
      /**
     * Field constructor
     * 
     * @param \anzalahMvc\Core\Model $model
     * @param string   $attribute
     */

    public function __construct(Model $model, string $attribute)
    {
  
        $this->model = $model;
        $this->attribute = $attribute;
    }
    
    
    abstract public function renderinput(): string;
  
}