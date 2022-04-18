<?php

declare(strict_types=1);


namespace Enjoys\Forms\Renderer\Bootstrap5;


class Html extends \Enjoys\Forms\Renderer\Html\TypesRender\Input
{

    public function render(): string
    {
        return "{$this->getElement()->getLabel()}";
    }

}
