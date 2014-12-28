<?php

namespace wolfguard\block\models;

use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\log\Logger;
use Yii;

/**
 * Block ActiveRecord model.
 *
 * Database fields:
 * @property integer $id
 * @property string  $name
 * @property string  $code
 * @property string  $value
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @author Ivan Fedyaev <ivan.fedyaev@gmail.com>
 */
class Block extends ActiveRecord
{
    /** @inheritdoc */
    public function attributeLabels()
    {
        return [
            'name'          => \Yii::t('block', 'Name'),
            'code'          => \Yii::t('block', 'Code'),
            'value'         => \Yii::t('block', 'Value'),
            'created_at'    => \Yii::t('block', 'Created at'),
            'updated_at'    => \Yii::t('block', 'Updated at'),
        ];
    }

    /** @inheritdoc */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /** @inheritdoc */
    public function scenarios()
    {
        return [
            'create'   => ['name', 'code', 'value'],
            'update'   => ['name', 'code', 'value'],
        ];
    }

    /** @inheritdoc */
    public function rules()
    {
        return [
            // code rules
            ['code', 'required', 'on' => ['create', 'update']],
            ['code', 'match', 'pattern' => '/^[0-9a-zA-Z\_\.\-]+$/'],
            ['code', 'string', 'min' => 3, 'max' => 255],
            ['code', 'unique'],
            ['code', 'trim'],

            // name rules
            ['name', 'string', 'max' => 255],
            ['name', 'trim'],
        ];
    }

    public function create()
    {
        if ($this->getIsNewRecord() == false) {
            throw new \RuntimeException('Calling "' . __CLASS__ . '::' . __METHOD__ . '" on existing object');
        }

        if ($this->save()) {
            \Yii::getLogger()->log('Block has been created', Logger::LEVEL_INFO);
            return true;
        }

        \Yii::getLogger()->log('An error occurred while creating block', Logger::LEVEL_ERROR);

        return false;
    }

    /** @inheritdoc */
    public static function tableName()
    {
        return '{{%block}}';
    }
}
