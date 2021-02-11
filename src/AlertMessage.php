<?php

declare(strict_types=1);

namespace Yii\Extension\Widget;

use Yiisoft\Html\Html;
use Yiisoft\Session\Flash\Flash;
use Yiisoft\Widget\Widget;
use Yiisoft\Yii\Bootstrap5\Alert;

final class AlertMessage extends Widget
{
    private Flash $flash;

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

    public function __construct(Flash $flash)
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
                    $options = [];

                    if (isset($message['body']) && is_string($message['body'])) {
                        $body = $message['body'];
                    }

                    if (isset($message['options']) && is_array($message['options'])) {
                        $options = $message['options'];
                    }

                    Html::addCssClass($options, $this->alertTypes[$type]);

                    $alertWidget = Alert::widget();

                    if (isset($message['closeButton']) && $message['closeButton'] === false) {
                        $alertWidget = $alertWidget->withoutCloseButton();
                    }

                    if ($body !== '') {
                        $html .= $alertWidget->body($body)->options($options);
                    }
                }
            }
        }

        return $html;
    }
}
