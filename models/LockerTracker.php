<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "locker_tracker".
 *
 * @property int $id
 * @property string $locker_status
 * @property int $locker_id
 * @property string $created_at
 * @property int $created_by
 */
class LockerTracker extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'locker_tracker';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['locker_status', 'locker_id', 'created_at', 'created_by'], 'required'],
            [['locker_status'], 'string'],
            [['locker_id', 'created_by'], 'integer'],
            [['created_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'locker_status' => 'Locker Status',
            'locker_id' => 'Locker ID',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
        ];
    }
}
