<?php

namespace frontend\models;

use yii\base\Model;

class RosreestForm extends Model
{
    /**
     * @var string
     */
    public $cadastralNumbers;

    /**
     * @return array|array[]
     */
    public function rules()
    {
        return [
            [['cadastralNumbers'], 'required'],
        ];
    }
}
