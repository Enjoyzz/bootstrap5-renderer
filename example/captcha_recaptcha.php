<?php

use Enjoys\Forms\Captcha\reCaptcha\reCaptcha;
use Enjoys\Forms\Form;
use Enjoys\Forms\Renderer\Bootstrap5\Bootstrap5Renderer;
use Enjoys\ServerRequestWrapper;
use HttpSoft\ServerRequest\ServerRequestCreator;

require __DIR__ . '/../vendor/autoload.php';

$faker = Faker\Factory::create();
$request = new ServerRequestWrapper(ServerRequestCreator::createFromGlobals());

$form = new Form();


$form->header('Captcha');
//options: verify_url, privatekey, publickey, language (also method setLanguage)
$captcha = new reCaptcha();
$captcha->setLanguage('ru');
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



