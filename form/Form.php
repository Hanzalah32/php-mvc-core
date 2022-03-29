<?php


namespace anzalahMvc\Core\form;

use anzalahMvc\Core\Model;

class Form
{
    public static function begin($action, $method)
    {
        echo sprintf('<form action="%s" method="%s">', $action, $method);
        return new self();
    }

    public static function end()
    {
        echo '</form>';
    }

    public function field(Model $model, $attribute)
    {
        return (new InputField($model, $attribute))
            ->render();
    }
}