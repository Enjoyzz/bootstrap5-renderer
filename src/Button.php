<?php

declare(strict_types=1);


namespace Enjoys\Forms\Renderer\Bootstrap5;


use Enjoys\Forms\Element;

class Button extends \Enjoys\Forms\Renderer\Html\TypesRender\Button
{

    public function __construct(Element $element)
    {
        $element->addClass('btn btn-link');
        parent::__construct($element);
    }

    public function render(): string
    {
        return $this->bodyRender($this->getElement());
    }

}
