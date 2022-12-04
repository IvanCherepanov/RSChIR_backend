<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "products".
 *
 * @property int $ID
 * @property string $description
 * @property int $price
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'products';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description', 'price'], 'required'],
            [['price'], 'integer'],
            [['description'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'description' => 'Description',
            'price' => 'Price',
        ];
    }
}
