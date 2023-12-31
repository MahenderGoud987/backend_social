<p align="center">
    <a href="http://getbootstrap.com/" target="_blank" rel="external">
        <img src="https://v4-alpha.getbootstrap.com/assets/brand/bootstrap-solid.svg" height="80px">
    </a>
    <h1 align="center">Twitter Bootstrap 4 Extension for Yii 2</h1>
    <br>
</p>

This is the Twitter Bootstrap extension for [Yii framework 2.0](http://www.yiiframework.com). It encapsulates [Bootstrap 4](http://getbootstrap.com/) components
and plugins in terms of Yii widgets, and thus makes using Bootstrap components/plugins
in Yii applications extremely easy.

For license information check the [LICENSE](LICENSE.md)-file.

Documentation is at [docs/guide/README.md](docs/guide/README.md).

[![Latest Stable Version](https://poser.pugx.org/yiisoft/yii2-bootstrap4/v/stable.png)](https://packagist.org/packages/yiisoft/yii2-bootstrap4)
[![Total Downloads](https://poser.pugx.org/yiisoft/yii2-bootstrap4/downloads.png)](https://packagist.org/packages/yiisoft/yii2-bootstrap4)
[![Build Status](https://github.com/yiisoft/yii2-bootstrap4/workflows/build/badge.svg)](https://github.com/yiisoft/yii2-bootstrap4/actions)


Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist yiisoft/yii2-bootstrap4
```

or add

```
"yiisoft/yii2-bootstrap4": "~2.0.6"
```

to the require section of your `composer.json` file.

Usage
----

For example, the following
single line of code in a view file would render a Bootstrap Progress plugin:

```php
<?= yii\bootstrap4\Progress::widget(['percent' => 60, 'label' => 'test']) ?>
```
