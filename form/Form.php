<?php


namespace anzalahmvc\core\form;

use anzalahmvc\core\Model;

class Form
{
    public static function begin($action, $method)
    {
       sprintf('<form action="%s" method="%s">', $action, $method);
        return new form();
        
    }

    public static function end()
    {
        echo '</form>';
    }
    public static function field(Model $model, $attribute)
    {
        return new InputField($model, $attribute);
    }
}