<?php

namespace app\config;

class Bootstrap implements \yii\base\BootstrapInterface
{
    public function bootstrap($app)
	{
        $container = \Yii::$container;

        $container->set('yii\grid\SerialColumn', [
            'contentOptions' => ['style' => ['width' => '1px']],
        ]);
        
        $container->set('yii\grid\CheckboxColumn', [
            'contentOptions' => ['style' => ['width' => '1px']],
        ]);
        
        $container->set('yii\grid\ActionColumn', [
            'contentOptions' => ['style' => ['width' => '1px', 'white-space' => 'nowrap']],
        ]);

        $container->setDefinitions([
            \yii\widgets\LinkPager::class => \yii\bootstrap4\LinkPager::class,
        ]);
	}
}