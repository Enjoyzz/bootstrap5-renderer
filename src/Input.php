<?php

declare(strict_types=1);


namespace Enjoys\Forms\Renderer\Bootstrap5;


use Enjoys\Forms\Element;
use Enjoys\Forms\Form;

class Input extends \Enjoys\Forms\Renderer\Html\TypesRender\Input
{

    public function __construct(Element $element)
    {
        $element->addClass('form-control');
        $element->addClass('form-label', Form::ATTRIBUTES_LABEL);

        if (method_exists($element, 'isRuleError') && $element->isRuleError()) {
            $element->addClass('is-invalid');
            $element->addClass('text-danger', Form::ATTRIBUTES_LABEL);
            $element->addClass('invalid-feedback d-block', Form::ATTRIBUTES_VALIDATE);
        }

        parent::__construct($element);
    }


    public function render(): string
    {
        return sprintf(
            "<div class='mb-3'>%s\n%s\n%s\n%s</div>",
            $this->labelRender(),

            $this->bodyRender($this->getElement()),
            $this->validationRender(),
            $this->descriptionRender(),

        );
    }
}
