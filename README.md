# bootstrap5-renderer
Renderer for enjoys/forms


## Run built-in server for view example
```shell
php -S localhost:8000 -t ./example .route
```

## Usage

```php
use Enjoys\Forms\Renderer\Bootstrap5\Bootstrap5Renderer;
$renderer = new Bootstrap5Renderer();
/** @var \Enjoys\Forms\Form $form */
$renderer->setForm($form);
$renderer->output();
```
or
```php
use Enjoys\Forms\Renderer\Bootstrap5\Bootstrap5Renderer;
/** @var \Enjoys\Forms\Form $form */
$renderer = new Bootstrap5Renderer($form);
$renderer->output();
```
