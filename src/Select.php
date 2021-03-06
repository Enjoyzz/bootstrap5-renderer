<?php

declare(strict_types=1);


namespace Enjoys\Forms\Renderer\Bootstrap5;


use Enjoys\Forms\Element;
use Enjoys\Forms\Elements\Optgroup;
use Enjoys\Forms\Form;

class Select extends \Enjoys\Forms\Renderer\Html\TypesRender\Input
{
    public function __construct(Element $element)
    {
        $element->addClass('form-select');
        $element->addClass('form-label', Form::ATTRIBUTES_LABEL);

        parent::__construct($element);

        if (method_exists($element, 'isRuleError') && $element->isRuleError()) {
            $element->addClass('is-invalid text-danger');
            $element->addClass('text-danger', Form::ATTRIBUTES_LABEL);
            $element->addClass('invalid-feedback d-block', Form::ATTRIBUTES_VALIDATE);
        }
    }

    public function render(): string
    {
        return sprintf(
            "<div class='mb-3'>%s\n%s\n%s\n%s\n%s\n%s</div>",
            $this->labelRender(),
            "<select{$this->getElement()->getAttributesString()}>",
            $this->bodyRender($this->getElement()),
            "</select>",
            $this->descriptionRender(),
            $this->validationRender(),
        );
    }

    protected function bodyRender(Element $element): string
    {
        $return = "";
        /** @var \Enjoys\Forms\Elements\Select $element  */
        foreach ($element->getElements() as $data) {
            if ($data instanceof Optgroup) {
                $return .= "<optgroup{$data->getAttributesString()}>";
                $return .= $this->bodyRender($data);
                $return .= "</optgroup>";
                continue;
            }
            $return .= parent::bodyRender($data);
        }
        return $return;
    }
}
