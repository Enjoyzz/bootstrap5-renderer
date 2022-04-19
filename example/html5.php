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


$form->header('HTML5 inputs');
$form->color('color1', 'Color');
$form->date('date1', 'Date');
$form->datetime('datetime1', 'DateTime');
$form->datetimelocal('datetimelocal1', 'DateTime Local');
$form->email('email1', 'E-mail');
$form->email('email2', 'E-mail / multiple')->setAttr(AttributeFactory::create('multiple'))->setDescription('Список e-mail вводится через запятую');
$form->month('month1', 'Month');
$form->number('number1', 'Number');
$form->range('range1', 'Range');
$form->search('search1', 'Search');
$form->tel('tel1', 'Tel');
$form->time('time1', 'Time');
$form->url('url1', 'Url');
$form->week('week1', 'Week');

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



