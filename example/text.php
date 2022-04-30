<?php

use Enjoys\Forms\AttributeFactory;
use Enjoys\Forms\Elements\Button;
use Enjoys\Forms\Elements\Select;
use Enjoys\Forms\Elements\Text;
use Enjoys\Forms\Form;
use Enjoys\Forms\Renderer\Bootstrap5\Bootstrap5Renderer;
use Enjoys\Forms\Rules;
use Enjoys\ServerRequestWrapper;
use HttpSoft\ServerRequest\ServerRequestCreator;

require __DIR__ . '/../vendor/autoload.php';

$faker = Faker\Factory::create();
$request = new ServerRequestWrapper(ServerRequestCreator::createFromGlobals());

$form = new Form();


$form->text('text1', 'type=text / base');

$form->text('text2', 'type=text / with description')
    ->setDescription($faker->paragraph)
;

$form->text('text3', 'type=text / with placeholder')
    ->setAttribute(AttributeFactory::create('placeholder', $faker->paragraph))
;

$form->text('text4', 'type=text / with placeholder, description and rule')
    ->setDescription($faker->paragraph)
    ->setAttribute(AttributeFactory::create('placeholder', $faker->paragraph))
    ->addRule(Rules::REQUIRED)
;

//$form->text(uniqid(), 'type=text / with error')->setRuleError(sprintf('Error #%d', $faker->randomDigit()));


$form->submit(uniqid());

if ($form->isSubmitted(false)) {
    dump($request->getPostData()->getAll());
}



if (!$form->isSubmitted()) {
    $renderer = new Bootstrap5Renderer();
    $renderer->setForm($form);

    echo include __DIR__.'/.assets.php';

    echo sprintf('<div class="container">%s</div>', $renderer->output());
}



