<?php

namespace wolfguard\block;

use yii\base\BootstrapInterface;
use yii\web\GroupUrlRule;

/**
 * Bootstrap class registers module and block application component. It also creates some url rules which will be applied
 * when UrlManager.enablePrettyUrl is enabled.
 *
 * @author Ivan Fedyaev <ivan.fedyaev@gmail.com>
 */
class Bootstrap implements BootstrapInterface
{
    /**
     * @inheritdoc
     */
    public function bootstrap($app)
    {
        if (!$app->hasModule('block')) {
            $app->setModule('block', [
                'class' => 'wolfguard\block\Module'
            ]);
        }

        /** @var $module Module */
        $module = $app->getModule('block');

        if ($app instanceof \yii\console\Application) {
            $module->controllerNamespace = 'wolfguard\block\commands';
        } else {
            $configUrlRule = [
                'prefix' => $module->urlPrefix,
                'rules'  => $module->urlRules
            ];

            if ($module->urlPrefix != 'block') {
                $configUrlRule['routePrefix'] = 'block';
            }

            $app->get('urlManager')->rules[] = new GroupUrlRule($configUrlRule);
        }

        $app->get('i18n')->translations['block*'] = [
            'class'    => 'yii\i18n\PhpMessageSource',
            'basePath' => __DIR__ . '/messages',
        ];
    }
}