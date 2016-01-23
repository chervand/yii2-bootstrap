# Extension of yiisoft/yii2-bootstrap with additional components.

## Panel

Bootstrap 3 Panel Widget

### Usage examples

```php
<?php Panel::begin() ?>
<p>
    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto enim error illo ipsam repellat velit vero.
    Aliquid at culpa ea nihil non odio odit veritatis vero. A delectus labore provident!
</p>
<?php Panel::end() ?>
```

```php
<?= Panel::widget([
    'options' => ['class' => 'panel-primary'],
    'heading' => 'Heading', // string
    'body' => [ // view file
        'view' => '@app/views/site/about',
        'params' => ['model' => $model],
    ],
    'footer' => [ // string with options
        'options' => ['class' => 'clearfix'],
        'content' => \yii\bootstrap\Html::button('Button', ['class' => ' btn btn-primary pull-right'])
    ]
]) ?>
```

```php
<?= Panel::widget([
    'options' => ['class' => 'panel-primary'],
    'heading' => function () { // closure
            return 'Heading';
        },
    'body' => [ // partial view
        'view' => '_body',
        'params' => ['model' => $model],
    ],
    'footer' => [ // closure with options
        'options' => ['class' => 'clearfix'],
        'content' => 'overridden by view',
        'view' => function () {
                return \yii\bootstrap\Html::button('Button', ['class' => ' btn btn-primary pull-right']);
            }
    ]
]) ?>
```

## Nav

`\chervand\bootstrap\Nav` is an extension of `\yii\bootstrap\Nav` widget
which additionally implements collapsible sub navs (alongside with original
widget's dropdowns).

### Additional widget attributes
- `toggle` 'collapse' or 'dropdown', defaults to 'dropdown'
- `collapseIdPrefix` sub nav's 'id' prefix, defaults to 'sub-'

### Additional items attributes
- `name` unique item name used for toggling collapses, **required**
- `description` link 'title'


### Usage example

```php
<?= chervand\bootstrap\Nav::widget([
    'toggle' => 'collapse',
    'items' => [
        [
            'label' => 'Item 1',
            'url' => '#',
            'name' => 'item1',
            'items' => [
                [
                    'label' => 'Item 1-1',
                    'url' => '#',
                    'name' => 'item1-1'
                ],
                [
                    'label' => 'Item 1-2',
                    'url' => '#',
                    'name' => 'item1-2'
                ]
            ]
        ],
        [
            'label' => 'Item 2',
            'url' => '#',
            'name' => 'item2'
        ],
    ],
    'options' => ['class' => 'nav nav-pills nav-stacked'],
]) ?>
```
