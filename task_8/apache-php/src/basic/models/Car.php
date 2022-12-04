<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "car".
 *
 * @property int|null $id
 * @property string|null $name
 * @property string|null $year
 * @property int|null $price
 */
class Car extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'car';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'price'], 'integer'],
            [['name', 'year'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'year' => 'Year',
            'price' => 'Price',
        ];
    }
}
