<?php


namespace anzalahMvc\Core\form;

use anzalahMvc\Core\Model;

class InputField extends BaseField
{
    public const TYPE_TEXT = 'text';
    public const TYPE_PASSWORD = 'password';
    public const TYPE_NUMBER = 'number';

    public string $type;

    /**
     * Field Constructor
     * 
     * @param \anzalahmvc\core\Model $model
     * @param string   $attribute
     */

    public function __construct(Model $model, string $attribute)
    {
        $this->type = self::TYPE_TEXT;
      
        parent::__construct($model, $attribute);
    }


    public function passwordField()
    {
        $this->type = self::TYPE_PASSWORD;
        return $this;
    }

    public function render() 
    {
        
        return sprintf(
            '
            <div class="form-group">
                <label>%s</label>
                    %s
                <div class="invalid-feedback">
                            %s
                </div>
            </div>
            ',
            $this->model->getLabel($this->attribute),
            $this->renderinput(),
            $this->model->getFirstError($this->attribute)
        );
    }

    public function __toString()
    {
        return get_class($this->model);
        
    }

    public function renderinput(): string
    {
        return sprintf(
            '<input type="%s" name="%s" value="%s" class="form-control%s">',
            $this->type,
            $this->attribute,
            $this->model->{$this->attribute},
            $this->model->hasError($this->attribute) ? ' is-invalid' : '',
        );
    }
}
