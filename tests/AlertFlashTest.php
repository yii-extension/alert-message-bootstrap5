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

    public function testEmpty(): void
    {
        $this->flash->add(
            'success',
            [
                'message' =>  '',
            ],
            true,
        );

        $html = AlertFlash::widget([$this->flash])->render();
        $this->assertEquals('', $html);
    }

    public function testMessageAttributes(): void
    {
        $this->flash->add(
            'success',
            [
                'attributes' => ['id' => 'testMe'],
                'message' =>  'message message',
            ],
            true,
        );

        $html = AlertFlash::widget([$this->flash])->render();
        $expected = <<<'HTML'
        <div id="testMe" class="alert-success alert alert-dismissible" role="alert">
        message message
        <button type="button" class="btn-close" aria-label="Close" data-bs-dismiss="alert"></button>
        </div>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testMessageCheckType(): void
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
                'message' =>  'message message',
            ],
            true,
        );

        $html = AlertFlash::widget([$this->flash])->render();
        $expected = <<<'HTML'
        <div id="w0-alert" class="alert-success alert alert-dismissible" role="alert">
        message message
        <button type="button" class="btn-close" aria-label="Close" data-bs-dismiss="alert"></button>
        </div>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testMessageDanger(): void
    {
        $this->flash->add(
            'danger',
            [
                'message' =>  'message 1',
            ],
            true,
        );

        $html = AlertFlash::widget([$this->flash])->render();
        $expected = <<<'HTML'
        <div id="w0-alert" class="alert-danger alert alert-dismissible" role="alert">
        message 1
        <button type="button" class="btn-close" aria-label="Close" data-bs-dismiss="alert"></button>
        </div>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testMessageDark(): void
    {
        $this->flash->add(
            'dark',
            [
                'message' =>  'message 1',
            ],
            true,
        );

        $html = AlertFlash::widget([$this->flash])->render();
        $expected = <<<'HTML'
        <div id="w0-alert" class="alert-dark alert alert-dismissible" role="alert">
        message 1
        <button type="button" class="btn-close" aria-label="Close" data-bs-dismiss="alert"></button>
        </div>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testMessageInfo(): void
    {
        $this->flash->add(
            'info',
            [
                'message' =>  'message 1',
            ],
            true,
        );

        $html = AlertFlash::widget([$this->flash])->render();
        $expected = <<<'HTML'
        <div id="w0-alert" class="alert-info alert alert-dismissible" role="alert">
        message 1
        <button type="button" class="btn-close" aria-label="Close" data-bs-dismiss="alert"></button>
        </div>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testMessageIcon(): void
    {
        $this->flash->add(
            'info',
            [
                'icon' => 'fas fa-home',
                'iconAttributes' => ['class' => 'me-1'],
                'message' =>  'message 1',
            ],
            true,
        );

        $html = AlertFlash::widget([$this->flash])->render();
        $expected = <<<'HTML'
        <div id="w0-alert" class="alert-info alert alert-dismissible" role="alert">
        <span class="me-1"><i class="fas fa-home"></i></span>
        message 1
        <button type="button" class="btn-close" aria-label="Close" data-bs-dismiss="alert"></button>
        </div>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testMessagePrimary(): void
    {
        $this->flash->add(
            'primary',
            [
                'message' =>  'message 1',
            ],
            true,
        );

        $html = AlertFlash::widget([$this->flash])->render();
        $expected = <<<'HTML'
        <div id="w0-alert" class="alert-primary alert alert-dismissible" role="alert">
        message 1
        <button type="button" class="btn-close" aria-label="Close" data-bs-dismiss="alert"></button>
        </div>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testMessageSuccess(): void
    {
        $this->flash->add(
            'success',
            [
                'message' =>  'message 1',
            ],
            true,
        );

        $html = AlertFlash::widget([$this->flash])->render();
        $expected = <<<'HTML'
        <div id="w0-alert" class="alert-success alert alert-dismissible" role="alert">
        message 1
        <button type="button" class="btn-close" aria-label="Close" data-bs-dismiss="alert"></button>
        </div>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testMessageWarning(): void
    {
        $this->flash->add(
            'warning',
            [
                'message' =>  'message 1',
            ],
            true,
        );

        $html = AlertFlash::widget([$this->flash])->render();
        $expected = <<<'HTML'
        <div id="w0-alert" class="alert-warning alert alert-dismissible" role="alert">
        message 1
        <button type="button" class="btn-close" aria-label="Close" data-bs-dismiss="alert"></button>
        </div>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testMessageMultiple(): void
    {
        $this->flash->add(
            'success',
            [
                'message' =>  'message 1'
            ],
            true
        );

        $this->flash->add(
            'danger',
            [
                'message' =>  'message 2'
            ],
            true
        );


        $html = AlertFlash::widget([$this->flash])->render();
        $expected = <<<'HTML'
        <div id="w0-alert" class="alert-success alert alert-dismissible" role="alert">
        message 1
        <button type="button" class="btn-close" aria-label="Close" data-bs-dismiss="alert"></button>
        </div><div id="w1-alert" class="alert-danger alert alert-dismissible" role="alert">
        message 2
        <button type="button" class="btn-close" aria-label="Close" data-bs-dismiss="alert"></button>
        </div>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testMessageWithoutCloseButton(): void
    {
        $this->flash->add(
            'success',
            [
                'message' =>  'message message',
                'closeButton' => false,
            ],
            true,
        );

        $html = AlertFlash::widget([$this->flash])->render();
        $expected = <<<'HTML'
        <div id="w0-alert" class="alert-success alert" role="alert">
        message message
        </div>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }
}
