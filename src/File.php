<?php

declare(strict_types=1);


namespace Enjoys\Forms\Renderer\Bootstrap5;


use Enjoys\Forms\Attribute;
use Enjoys\Forms\AttributeFactory;
use Enjoys\Forms\Element;
use Enjoys\Forms\Form;
use Enjoys\Forms\Interfaces\AttributeInterface;

class File extends \Enjoys\Forms\Renderer\Html\TypesRender\Input
{

    private AttributeInterface $placeholder;

    public function __construct(Element $element)
    {
        $element->addClass('custom-file-input');
        $element->addClass('custom-file-label', 'placeholder');

        if (method_exists($element, 'isRuleError') && $element->isRuleError()) {
            $element->addClass('is-invalid');
            $element->addClass('invalid-feedback d-block', Form::ATTRIBUTES_VALIDATE);
        }

        if (null === $placeholder = $element->getAttr('placeholder')) {
            $placeholder = AttributeFactory::create('placeholder', 'Choose file');
        }
        $this->placeholder = $placeholder;

        $element->removeAttr('placeholder');

        parent::__construct($element);
    }


    private function placeHolderRender(): string
    {



        if (null !== $idAttribute = $this->getElement()->getAttr('id')) {
            $this->getElement()->setAttr($idAttribute->withName('for'), 'placeholder');
        }
        return sprintf(
            '<label%s>%s</label>',
            $this->getElement()->getAttributesString('placeholder'),
            $this->placeholder->getValueString(),
        );
    }

    public function render(): string
    {
        return sprintf(
            "<div class='form-group'>%s<div class='custom-file'>%s\n%s</div>%s\n%s</div>",
            $this->labelRender(),
            $this->bodyRender($this->getElement()),
            $this->placeHolderRender(),
            $this->validationRender(),
            $this->descriptionRender(),

        );
    }

}
