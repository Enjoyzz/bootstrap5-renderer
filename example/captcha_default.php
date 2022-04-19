<?php

use Enjoys\Forms\AttributeFactory;
use Enjoys\Forms\Captcha\Defaults\Defaults;
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


$form->header('Captcha');
$captcha = new Defaults();
$captcha->setOptions([
    'size' => 3,
    'width'=>100,
    'height'=>30
]);
$form->captcha($captcha);

$form->submit(uniqid());

if ($form->isSubmitted(false)) {
    dump($request->getPostData()->getAll());
}



if (!$form->isSubmitted()) {
    $renderer = new Bootstrap5Renderer();
    $renderer->setForm($form);

    echo include __DIR__.'/.assets.php';

    echo sprintf('<div class="container">%s</div>', $renderer->output());
} else {
    echo 'Форма валидна и отправлена';
}



