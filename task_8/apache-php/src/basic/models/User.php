<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "users".
 *
 * @property int $ID
 * @property string $name
 * @property string $surname
 * @property string $password
 */
class User extends ActiveRecord
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'surname', 'password'], 'required'],
            [['name'], 'string', 'max' => 20],
            [['surname'], 'string', 'max' => 40],
            [['password'], 'string', 'max' => 240],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'name' => 'Name',
            'surname' => 'Surname',
            'password' => 'Password',
        ];
    }
}
