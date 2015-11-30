## Panel

```
<?php Panel::begin() ?>
<p>
    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto enim error illo ipsam repellat velit vero.
    Aliquid at culpa ea nihil non odio odit veritatis vero. A delectus labore provident!
</p>
<?php Panel::end() ?>
```

```
<?= Panel::widget([
    'options' => ['class' => 'panel-primary'],
    'heading' => 'Heading', // string
    'body' => [ // view
        'view' => '@app/views/site/about',
        'params' => ['model' => $model],
    ],
    'footer' => [ // string with options
        'options' => ['class' => 'clearfix'],
        'content' => \yii\bootstrap\Html::button('Button', ['class' => ' btn btn-primary pull-right'])
    ]
]) ?>
```