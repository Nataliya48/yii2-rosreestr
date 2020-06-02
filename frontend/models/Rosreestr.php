<?php

namespace frontend\models;

use yii\db\ActiveRecord;

/**
 * Rosreestr model
 *
 * @property integer $id
 * @property string $cadastralNumber
 * @property string $address
 * @property string $price
 * @property string $area
 */
class Rosreestr extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%rosreestr}}';
    }
}
