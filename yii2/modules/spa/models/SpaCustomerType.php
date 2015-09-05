<?php

namespace app\modules\spa\models;

use Yii;

/**
 * This is the model class for table "spa_customer_type".
 *
 * @property integer $id
 * @property string $type_name
 */
class SpaCustomerType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'spa_customer_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type_name'], 'required'],
            [['type_name'], 'string', 'max' => 32]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type_name' => 'Type Name',
        ];
    }
}
