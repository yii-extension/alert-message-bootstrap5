<?php

declare(strict_types=1);

namespace Yii\Extension\Bootstrap5\Tests;

use PHPUnit\Framework\TestCase as BaseTestCase;

use function str_replace;

abstract class TestCase extends BaseTestCase
{
    /**
     * Asserting two strings equality ignoring line endings.
     *
     * @param string $expected
     * @param string $actual
     * @param string $message
     */
    protected function assertEqualsWithoutLE(string $expected, string $actual, string $message = ''): void
    {
        $expected = str_replace("\r\n", "\n", $expected);
        $actual = str_replace("\r\n", "\n", $actual);

        self::assertEquals($expected, $actual, $message);
    }
}
