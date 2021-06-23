<?php

declare(strict_types=1);

namespace Yii\Extension\Bootstrap5;

use Yii\Extension\Simple\Widget\AbstractWidget;
use Yiisoft\Html\Html;
use Yiisoft\Session\Flash\FlashInterface;

final class AlertFlash extends AbstractWidget
{
    private FlashInterface $flash;

    private array $alertTypes = [
        'danger' => 'alert-danger',
        'dark' => 'alert-dark',
        'info' => 'alert-info',
        'light' => 'alert-light',
        'primary' => 'alert-primary',
        'secondary' => 'alert-secondary',
        'success' => 'alert-success',
        'warning' => 'alert-warning',
    ];

    public function __construct(FlashInterface $flash)
    {
        $this->flash = $flash;
    }

    protected function run(): string
    {
        $flashes = $this->flash->getAll();
        $html = '';

        /** @var array $data */
        foreach ($flashes as $type => $data) {
            if (isset($this->alertTypes[$type]) && is_string($this->alertTypes[$type])) {
                /** @var array $message */
                foreach ($data as $message) {
                    $body = '';
                    $attributes = [];

                    if (isset($message['body']) && is_string($message['body'])) {
                        $body = $message['body'];
                    }

                    if (isset($message['attributes']) && is_array($message['attributes'])) {
                        $attributes = $message['attributes'];
                    }

                    Html::addCssClass($attributes, $this->alertTypes[$type]);

                    $alertWidget = Alert::widget();

                    if (isset($message['closeButton']) && $message['closeButton'] === false) {
                        $alertWidget = $alertWidget->withoutCloseButton();
                    }

                    if ($body !== '') {
                        $html .= $alertWidget->attributes($attributes)->body($body);
                    }
                }
            }
        }

        return $html;
    }
}
