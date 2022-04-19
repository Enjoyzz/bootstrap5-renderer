<?php

use Enjoys\Forms\AttributeFactory;
use Enjoys\Forms\Elements\Button;
use Enjoys\Forms\Elements\Select;
use Enjoys\Forms\Elements\Text;
use Enjoys\Forms\Form;
use Enjoys\Forms\Renderer\Bootstrap5\Bootstrap5Renderer;
use Enjoys\Forms\Renderer\Bootstrap5\Group;
use Enjoys\Forms\Rules;

require __DIR__ . '/../vendor/autoload.php';

$faker = Faker\Factory::create();

$form = new Form();

$form->header('Input');

$form->text('text_foo1', $faker->sentence(2))
    ->setDescription($faker->paragraph())
    ->addRule(Rules::REQUIRED)
;

$form->group('Group Label', 'group_id')->add([
    (new Text('text_foo2', $faker->sentence(1)))
        ->addRule(Rules::REQUIRED)
        ->setDescription($faker->paragraph(1))
    ->addClass('col-md-1', Group::ATTRIBUTES_GROUP)
    ,
    (new Select('select_foo1', $faker->sentence(2)))->fill($faker->sentences(5)),
    (new Text('text_foo3', $faker->sentence(3)))
        ->setAttr(AttributeFactory::create('placeholder', $faker->sentence(2)))
        ->setDescription($faker->paragraph())->addRule(Rules::REQUIRED),
    new Button('btn', $faker->sentence(2) . ' <b>' . $faker->sentence(1) . '</b>')
]);
$form->select('select_multiple')->fill($faker->words(8))->setMultiple();
$form->select('select_foo2', 'Select City')->fill([
    [
        $faker->word(),
        [
            'class' => 'h1 text-danger'
        ]
    ],
    $faker->word()
]);

$form->header('Header 2');

$form->select('select_group', 'Select Group')
    ->setOptgroup($faker->word(), [
        $faker->word(),
        [$faker->word(), ['class' => 'text-warning']]
    ], [
        'class' => 'text-primary'
    ])
    ->setOptgroup($faker->word(), $faker->words())
;

$form->checkbox('checkbox1', 'Выбор1')->fill($faker->words(), true)->setDescription('Выбор1 Description')
    ->addClass('text-muted')
    ->addRule(Rules::REQUIRED)
;

$form->image('image_name', 'https://avatars.mds.yandex.net/get-entity_search/5735732/551767088/S122x122Fit_2x');

$form->header('Header 3');

$form->radio('r1')->fill($faker->words());

$form->html('<div style="margin: 2em 0"><i>HTML embed</i></div>');

$form->datalist('datalist_name', 'Datalist')->fill($faker->words(5));

$form->file('file_name', $faker->word())->addRule(Rules::UPLOAD, params: ['required'])
    ->setDescription($faker->paragraph())
;

$form->file('file_name2')
    ->addAttrs(
        AttributeFactory::createFromArray([
            'placeholder' => $faker->word(),
            'multiple'
        ])
    )
;

$form->textarea('textares1', $faker->word())->setValue($faker->paragraphs(2, true))->setCols(10)->setRows(5);

$form->submit('sbmt1', $faker->sentence(1));
$form->reset('reset1', $faker->sentence(2));

if (!$form->isSubmitted()) {
    $renderer = new Bootstrap5Renderer();
    $renderer->setForm($form);
    echo include __DIR__.'/.assets.php';
    echo sprintf('<div class="container">%s</div>', $renderer->output());
}



