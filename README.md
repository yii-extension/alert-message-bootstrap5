<p align="center">
    <a href="https://github.com/yii-extension" target="_blank">
        <img src="https://lh3.googleusercontent.com/ehSTPnXqrkk0M3U-UPCjC0fty9K6lgykK2WOUA2nUHp8gIkRjeTN8z8SABlkvcvR-9PIrboxIvPGujPgWebLQeHHgX7yLUoxFSduiZrTog6WoZLiAvqcTR1QTPVRmns2tYjACpp7EQ=w2400" height="100px">
    </a>
    <h1 align="center">Alert Flash Bootstrap5 Widget</h1>
    <br>
</p>

[![Total Downloads](https://poser.pugx.org/yii-extension/alert-flash-bootstrap5/downloads.png)](https://packagist.org/packages/yii-extension/alert-flash-bootstrap5)
[![Build Status](https://github.com/yii-extension/alert-flash-bootstrap5/workflows/build/badge.svg)](https://github.com/yii-extension/alert-flash-bootstrap5/actions?query=workflow%3Abuild)
[![codecov](https://codecov.io/gh/yii-extension/alert-flash-bootstrap5/branch/master/graph/badge.svg?token=s48h3hIC46)](https://codecov.io/gh/yii-extension/alert-flash-bootstrap5)
[![Mutation testing badge](https://img.shields.io/endpoint?style=flat&url=https://badge-api.stryker-mutator.io/github.com/yii-extension/alert-flash-bootstrap5/master)](https://dashboard.stryker-mutator.io/reports/github.com/yii-extension/alert-flash-bootstrap5/master)
[![static analysis](https://github.com/yii-extension/alert-flash-bootstrap5/workflows/static%20analysis/badge.svg)](https://github.com/yii-extension/alert-flash-bootstrap5/actions?query=workflow%3A%22static+analysis%22)
[![type-coverage](https://shepherd.dev/github/yii-extension/alert-flash-bootstrap5/coverage.svg)](https://shepherd.dev/github/yii-extension/alert-flash-bootstrap5)

## Installation

```shell
composer require yii-extension/alert-flash-bootstrap5
```

## Usage

In controller or action:

```php
<?php

declare(strict_types=1);

namespace App\Action;

use Psr\Http\Message\ResponseInterface;
use Yiisoft\Session\Flash\Flash;

final class Action
{
    public function index(Flash $flash): ResponseInterface
    {
        $flash->add(
            'success', // types: [danger, dark, info, primary, secundary, success, warning]
            [
                'attributes' => ['id' => 'testMe'], // Its optional.
                'closeButton' => true, //Its optional for value default true.
                'icon' => 'fas fa-home', // Its optional.
                'iconAttributes' => ['class' => 'me-1'], // Its optional.
                'message' => 'Message flash', // Its mandatory.
            ],
            true,
        );
    }
}
```

In layout:

```php
<?php

declare(strict_types=1);

use Yii\Extension\Bootstrap5\AlertFlash;
use Yiisoft\Session\Flash\FlashInterface;

/**
 * @var FlashInterface $flash
 */
?>

<?= AlertFlash::widget($flash) ?>
```

## Unit testing

The package is tested with [PHPUnit](https://phpunit.de/). To run tests:

```shell
./vendor/bin/phpunit
```

## Mutation testing

The package tests are checked with [Infection](https://infection.github.io/) mutation framework. To run it:

```shell
./vendor/bin/infection
```

## Static analysis

The code is statically analyzed with [Psalm](https://psalm.dev/docs). To run static analysis:

```shell
./vendor/bin/psalm
```

## Support the project

[![Open Collective](https://img.shields.io/badge/Open%20Collective-sponsor-7eadf1?logo=open%20collective&logoColor=7eadf1&labelColor=555555)](https://opencollective.com/yiisoft)

## License

The Alert Flash Bootstrap5 Widget is free software. It is released under the terms of the BSD License.
Please see [`LICENSE`](./LICENSE.md) for more information.

Maintained by [Yii Extension](https://github.com/yii-extension).
