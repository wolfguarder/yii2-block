<?php

namespace wolfguard\block\models;

use wolfguard\block\helpers\ModuleTrait;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * BlockSearch represents the model behind the search form about Block.
 */
class BlockSearch extends Model
{
    use ModuleTrait;

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $code;

    /**
     * @var integer
     */
    public $created_at;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at'], 'integer'],
            [['name', 'code'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name' => \Yii::t('block', 'Name'),
            'code' => \Yii::t('block', 'Code'),
            'created_at' => \Yii::t('block', 'Created at'),
        ];
    }

    /**
     * @param $params
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = $this->module->manager->createBlockQuery();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $this->addCondition($query, 'name', true);
        $this->addCondition($query, 'code', true);
        $this->addCondition($query, 'created_at');

        return $dataProvider;
    }

    /**
     * @param $query
     * @param $attribute
     * @param bool $partialMatch
     */
    protected function addCondition($query, $attribute, $partialMatch = false)
    {
        $value = $this->$attribute;
        if (trim($value) === '') {
            return;
        }

        if ($partialMatch) {
            $query->andWhere(['like', $attribute, $value]);
        } else {
            $query->andWhere([$attribute => $value]);
        }
    }
}
