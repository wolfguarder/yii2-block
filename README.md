HTML blocks
===========
Yii2 module for HTML blocks editing

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist wolfguard/yii2-block "*"
```

or add

```
"wolfguard/yii2-block": "*"
```

to the require section of your `composer.json` file.

After running 

```
php composer.phar update
```

run

```
yii migrate --migrationPath=@vendor/wolfguard/yii2-block/migrations
```

After that change your main configuration file ```config/web.php```

```php
<?php return [
    ...
    'modules' => [
        ...
        'block' => [
            'class' => 'wolfguard\block\Module',
        ],
        ...
    ],
    ...
];
```


Usage
-----

Once the extension is installed, simply use it in your code by  :

```php
<?= \wolfguard\block\widgets\Block::widget(['code' => 'about']); ?>
```