<?php

declare(strict_types=1);


namespace Enjoys\Forms\Renderer\Bootstrap5;


use Enjoys\Forms\Element;

class Submit extends \Enjoys\Forms\Renderer\Html\TypesRender\Button
{

    public function __construct(Element $element)
    {
        $element->addClass('btn btn-primary');
        parent::__construct($element);
    }
}
