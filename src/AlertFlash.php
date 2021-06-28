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
                /** @var array $messages */
                foreach ($data as $messages) {
                    $icon = '';
                    $iconAttributes = [];
                    $message = '';
                    $attributes = [];

                    if (isset($messages['attributes']) && is_array($messages['attributes'])) {
                        $attributes = $messages['attributes'];
                    }

                    if (isset($messages['icon']) && is_string($messages['icon'])) {
                        $icon = $messages['icon'];
                    }

                    if (isset($messages['iconAttributes']) && is_array($messages['iconAttributes'])) {
                        $iconAttributes = $messages['iconAttributes'];
                    }

                    if (isset($messages['message']) && is_string($messages['message'])) {
                        $message = $messages['message'];
                    }

                    Html::addCssClass($attributes, $this->alertTypes[$type]);

                    $alertWidget = Alert::widget();

                    if (isset($messages['closeButton']) && $messages['closeButton'] === false) {
                        $alertWidget = $alertWidget->withoutCloseButton();
                    }

                    if ($message !== '') {
                        $html .= $alertWidget
                            ->attributes($attributes)
                            ->icon($icon)
                            ->iconAttributes($iconAttributes)
                            ->message($message);
                    }
                }
            }
        }

        return $html;
    }
}
