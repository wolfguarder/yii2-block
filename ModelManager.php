<?php

namespace wolfguard\block;

use yii\base\Component;

/**
 * ModelManager is used in order to create models and find blocks.
 *
 * @method models\Block               createBlock
 * @method models\BlockSearch         createBlockSearch
 *
 * @author Ivan Fedyaev <ivan.fedyaev@gmail.com>
 */
class ModelManager extends Component
{
    /** @var string */
    public $blockClass = 'wolfguard\block\models\Block';

    /** @var string */
    public $blockSearchClass = 'wolfguard\block\models\BlockSearch';

    /**
     * Finds a block by the given id.
     *
     * @param  integer $id Block id to be used on search.
     * @return models\Block
     */
    public function findBlockById($id)
    {
        return $this->findBlock(['id' => $id])->one();
    }

    /**
     * Finds a block by the given code.
     *
     * @param  string $code Code to be used on search.
     * @return models\Block
     */
    public function findBlockByCode($code)
    {
        return $this->findBlock(['code' => $code])->one();
    }

    /**
     * Finds a block by the given condition.
     *
     * @param  mixed $condition Condition to be used on search.
     * @return \yii\db\ActiveQuery
     */
    public function findBlock($condition)
    {
        return $this->createBlockQuery()->where($condition);
    }

    /**
     * @param string $name
     * @param array $params
     * @return mixed|object
     */
    public function __call($name, $params)
    {
        $property = (false !== ($query = strpos($name, 'Query'))) ? mb_substr($name, 6, -5) : mb_substr($name, 6);
        $property = lcfirst($property) . 'Class';
        if ($query) {
            return forward_static_call([$this->$property, 'find']);
        }
        if (isset($this->$property)) {
            $config = [];
            if (isset($params[0]) && is_array($params[0])) {
                $config = $params[0];
            }
            $config['class'] = $this->$property;
            return \Yii::createObject($config);
        }

        return parent::__call($name, $params);
    }
}