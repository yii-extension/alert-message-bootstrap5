<?php

declare(strict_types=1);

namespace Yii\Extension\Widget\Tests;

use PHPUnit\Framework\TestCase as BaseTestCase;
use Psr\Container\ContainerInterface;
use Yiisoft\Di\Container;
use Yiisoft\Session\Flash\Flash;
use Yiisoft\Session\Flash\FlashInterface;
use Yiisoft\Session\Session;
use Yiisoft\Session\SessionInterface;
use Yiisoft\Widget\WidgetFactory;

abstract class TestCase extends BaseTestCase
{
    protected FlashInterface $flash;
    private ContainerInterface $container;

    protected function setUp(): void
    {
        parent::setUp();

        $this->container = new Container($this->config());
        $this->flash = $this->container->get(FlashInterface::class);

        WidgetFactory::initialize($this->container);
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }

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

    private function config(): array
    {
        return [
            SessionInterface::class => [
                '__class' => Session::class,
                '__construct()' => [
                    ['cookie_secure' => 0],
                    null,
                ],
            ],

            FlashInterface::class => Flash::class,
        ];
    }
}
