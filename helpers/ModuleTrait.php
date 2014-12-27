<?php

namespace wolfguard\block\helpers;

/**
 * @property \wolfguard\block\Module $module
 */
trait ModuleTrait
{
    /**
     * @var null|\wolfguard\block\Module
     */
    private $_module;

    /**
     * @return null|\wolfguard\block\Module
     */
    protected function getModule()
    {
        if ($this->_module == null) {
            $this->_module = \Yii::$app->getModule('block');
        }

        return $this->_module;
    }
}