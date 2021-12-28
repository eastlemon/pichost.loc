<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "picture".
 *
 * @property int $id
 * @property string $name Name
 * @property string $uniq_name Unique Name
 * @property string $target Target
 * @property string $ext Extension
 * @property string|null $created_at Creation Time
 */
class Picture extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'picture';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'uniq_name', 'target', 'ext'], 'required'],
            [['name', 'uniq_name', 'target', 'ext', 'created_at'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'uniq_name' => Yii::t('app', 'Uniq Name'),
            'target' => Yii::t('app', 'Target'),
            'ext' => Yii::t('app', 'Ext'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }
}
