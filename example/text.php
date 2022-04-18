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
    ->setAttr(AttributeFactory::create('placeholder', $faker->paragraph))
;

$form->text('text4', 'type=text / with placeholder, description and rule')
    ->setDescription($faker->paragraph)
    ->setAttr(AttributeFactory::create('placeholder', $faker->paragraph))
    ->addRule(Rules::REQUIRED)
;

//$form->text(uniqid(), 'type=text / with error')->setRuleError(sprintf('Error #%d', $faker->randomDigit()));


$form->header('HTML5 inputs');
$form->color('color1', 'Color');
$form->date('date1', 'Date');
$form->datetime('datetime1', 'DateTime');
$form->datetimelocal('datetimelocal1', 'DateTime Local');
$form->email('email1', 'E-mail');

$form->month('month1', 'Month');

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



