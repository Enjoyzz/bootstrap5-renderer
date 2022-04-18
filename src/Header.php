<?php

declare(strict_types=1);


namespace Enjoys\Forms\Renderer\Bootstrap5;


use Enjoys\Forms\Element;

class Header extends \Enjoys\Forms\Renderer\Html\TypesRender\Input
{

    public function __construct(Element $element)
    {
        $element->addClass('h4');
        parent::__construct($element);
    }

    public function render(): string
    {
        return "<div{$this->getElement()->getAttributesString()}>{$this->getElement()->getLabel()}</div>";
    }

}
