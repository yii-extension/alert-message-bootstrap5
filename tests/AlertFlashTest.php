<?php

declare(strict_types=1);

namespace Yii\Extension\Bootstrap5\Tests;

use Yii\Extension\Bootstrap5\AlertFlash;
use Yiisoft\Session\Flash\Flash;
use Yiisoft\Session\Flash\FlashInterface;
use Yiisoft\Session\Session;

/**
 * @runTestsInSeparateProcesses
 */
final class AlertMessageTest extends TestCase
{
    private FlashInterface $flash;

    protected function setUp(): void
    {
        parent::setUp();

        $this->flash = new Flash(new Session([0], null));
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->flash);
    }

    public function testAlertMessageEmpty(): void
    {
        $this->flash->add(
            'success',
            [
                'body' =>  '',
            ],
            true,
        );

        $html = AlertFlash::widget([$this->flash])->render();
        $this->assertEquals('', $html);
    }

    public function testAlertMessageCheckType(): void
    {
        $this->flash->add(
            'testMe',
            [
                'message' => 'Error testMe message',
            ],
            true,
        );

        $this->flash->add(
            'success',
            [
                'body' =>  'Body message',
            ],
            true,
        );

        $html = AlertFlash::widget([$this->flash])->render();
        $expected = <<<'HTML'
        <div id="w0-alert" class="alert-success alert alert-dismissible" role="alert">
        Body message
        <button type="button" class="btn-close" aria-label="Close" data-bs-dismiss="alert"></button>
        </div>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testAlertMessageWithoutCloseButton(): void
    {
        $this->flash->add(
            'success',
            [
                'body' =>  'Body message',
                'closeButton' => false,
            ],
            true,
        );

        $html = AlertFlash::widget([$this->flash])->render();
        $expected = <<<'HTML'
        <div id="w0-alert" class="alert-success alert" role="alert">
        Body message
        </div>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testAlertMessageOptions(): void
    {
        $this->flash->add(
            'success',
            [
                'attributes' => ['id' => 'testMe'],
                'body' =>  'Body message',
            ],
            true,
        );

        $html = AlertFlash::widget([$this->flash])->render();
        $expected = <<<'HTML'
        <div id="testMe" class="alert-success alert alert-dismissible" role="alert">
        Body message
        <button type="button" class="btn-close" aria-label="Close" data-bs-dismiss="alert"></button>
        </div>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testAlertMessageMultiple(): void
    {
        $this->flash->add(
            'success',
            [
                'body' =>  'Body 1'
            ],
            true
        );

        $this->flash->add(
            'danger',
            [
                'body' =>  'Body 2'
            ],
            true
        );


        $html = AlertFlash::widget([$this->flash])->render();
        $expected = <<<'HTML'
        <div id="w0-alert" class="alert-success alert alert-dismissible" role="alert">
        Body 1
        <button type="button" class="btn-close" aria-label="Close" data-bs-dismiss="alert"></button>
        </div><div id="w1-alert" class="alert-danger alert alert-dismissible" role="alert">
        Body 2
        <button type="button" class="btn-close" aria-label="Close" data-bs-dismiss="alert"></button>
        </div>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testAlertMessageDanger(): void
    {
        $this->flash->add(
            'danger',
            [
                'body' =>  'Body 1',
            ],
            true,
        );

        $html = AlertFlash::widget([$this->flash])->render();
        $expected = <<<'HTML'
        <div id="w0-alert" class="alert-danger alert alert-dismissible" role="alert">
        Body 1
        <button type="button" class="btn-close" aria-label="Close" data-bs-dismiss="alert"></button>
        </div>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testAlertMessageDark(): void
    {
        $this->flash->add(
            'dark',
            [
                'header' => 'Header 1',
                'body' =>  'Body 1',
            ],
            true,
        );

        $html = AlertFlash::widget([$this->flash])->render();
        $expected = <<<'HTML'
        <div id="w0-alert" class="alert-dark alert alert-dismissible" role="alert">
        Body 1
        <button type="button" class="btn-close" aria-label="Close" data-bs-dismiss="alert"></button>
        </div>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testAlertMessageInfo(): void
    {
        $this->flash->add(
            'info',
            [
                'header' => 'Header 1',
                'body' =>  'Body 1',
            ],
            true,
        );

        $html = AlertFlash::widget([$this->flash])->render();
        $expected = <<<'HTML'
        <div id="w0-alert" class="alert-info alert alert-dismissible" role="alert">
        Body 1
        <button type="button" class="btn-close" aria-label="Close" data-bs-dismiss="alert"></button>
        </div>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testAlertMessagePrimary(): void
    {
        $this->flash->add(
            'primary',
            [
                'header' => 'Header 1',
                'body' =>  'Body 1',
            ],
            true,
        );

        $html = AlertFlash::widget([$this->flash])->render();
        $expected = <<<'HTML'
        <div id="w0-alert" class="alert-primary alert alert-dismissible" role="alert">
        Body 1
        <button type="button" class="btn-close" aria-label="Close" data-bs-dismiss="alert"></button>
        </div>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testAlertMessageSuccess(): void
    {
        $this->flash->add(
            'success',
            [
                'header' => 'Header 1',
                'body' =>  'Body 1',
            ],
            true,
        );

        $html = AlertFlash::widget([$this->flash])->render();
        $expected = <<<'HTML'
        <div id="w0-alert" class="alert-success alert alert-dismissible" role="alert">
        Body 1
        <button type="button" class="btn-close" aria-label="Close" data-bs-dismiss="alert"></button>
        </div>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testAlertMessageWarning(): void
    {
        $this->flash->add(
            'warning',
            [
                'header' => 'Header 1',
                'body' =>  'Body 1',
            ],
            true,
        );

        $html = AlertFlash::widget([$this->flash])->render();
        $expected = <<<'HTML'
        <div id="w0-alert" class="alert-warning alert alert-dismissible" role="alert">
        Body 1
        <button type="button" class="btn-close" aria-label="Close" data-bs-dismiss="alert"></button>
        </div>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }
}
