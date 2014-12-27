<?php

namespace wolfguard\block\widgets;

use wolfguard\block\helpers\ModuleTrait;
use yii\base\Widget;

/**
 * @author Ivan Fedyaev <ivan.fedyaev@gmail.com>
 */
class Block extends Widget
{
    use ModuleTrait;

    /**
     * @var string
     */
    public $code = '';

    /**
     * @var bool
     */
    public $visible = true;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        if (empty($this->code)) {
            $this->visible = false;
        }
    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        if (!$this->visible) return false;

        $model = $this->module->manager->findBlockByCode($this->code);

        if (!$model) {
            $model = $this->module->manager->createBlock(['scenario' => 'create']);
            $model->code = $this->code;
            $model->value = '<span style="color: #fff; background-color: #000;">' . \Yii::t('block', 'Add text here.') . '</span>';
            if (!$model->save()) {
                return false;
            }
        }

        return $this->render('block/block', [
            'model' => $model
        ]);
    }
}