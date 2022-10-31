<?php

declare(strict_types=1);

namespace Enjoys\Forms\Renderer\Bootstrap5;

use Enjoys\Forms\AttributeFactory;
use Enjoys\Forms\Element;
use Enjoys\Forms\Elements;
use Enjoys\Forms\Elements\Hidden;
use Enjoys\Forms\Form;
use Enjoys\Forms\Helper;
use Enjoys\Forms\Interfaces\ElementInterface;
use Enjoys\Forms\Renderer\AbstractRenderer;
use Enjoys\Forms\Renderer\Html\TypesRender\TypeRenderInterface;

class Bootstrap5Renderer extends AbstractRenderer
{

    private const _MAP_ = [
        Button::class => Elements\Button::class,
        Submit::class => Elements\Submit::class,
        Image::class => Elements\Image::class,
        Reset::class => Elements\Reset::class,
        Range::class => Elements\Range::class,
        Radio::class => [
            Elements\Radio::class,
            Elements\Checkbox::class
        ],
        Select::class => Elements\Select::class,
        Group::class => Elements\Group::class,
        Header::class => Elements\Header::class,
        Html::class => [
            Elements\Html::class,
            Elements\Header::class
        ],
    ];

    public function output(): string
    {
        return sprintf(
            "<form%s>\n%s\n%s\n</form>",
            $this->getForm()->getAttributesString(),
            $this->rendererHiddenElements(),
            $this->rendererElements()
        );
    }

    public function rendererHiddenElements(): string
    {
        $html = [];
        foreach ($this->getForm()->getElements() as $element) {
            if ($element instanceof Hidden) {
                $this->getForm()->removeElement($element);
                $html[] = $element->baseHtml();
            }
        }
        return implode("\n", $html);
    }

    public function rendererElements(): string
    {
        $html = [];
        foreach ($this->getForm()->getElements() as $element) {
            $html[] = $this->_rendererElement($element);
        }
        return implode("\n", $html);
    }

    public function rendererElement(string $elementName): string
    {
        $element = $this->getForm()->getElement($elementName);
        return $this->_rendererElement($element);
    }

    private function _rendererElement(ElementInterface|Element $element): string
    {
        if (method_exists($element, 'getDescription') && !empty($element->getDescription())) {
            $element->setAttributes(
                AttributeFactory::createFromArray([
                    'id' => $element->getAttribute('id')->getValueString() . 'Help',
                    'class' => 'form-text'
                ]),
                Form::ATTRIBUTES_DESC
            );
            $element->setAttributes(
                AttributeFactory::createFromArray([
                    'aria-describedby' => $element->getAttribute('id', Form::ATTRIBUTES_DESC)->getValueString()
                ])
            );
        }

        $element->addClass('form-label', Form::ATTRIBUTES_LABEL);

        return self::createTypeRender($element)->render();
    }

    public static function createTypeRender(Element $element): TypeRenderInterface
    {
        $typeRenderClass = Helper::arrayRecursiveSearchKeyMap(get_class($element), self::_MAP_)[0] ?? false;
        if ($typeRenderClass === false || !class_exists($typeRenderClass)) {
            return new Input($element);
        }
        return new $typeRenderClass($element);
    }
}
