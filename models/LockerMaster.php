<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "locker_master".
 *
 * @property int $id
 * @property string $locker_channel_api
 * @property string $locker_channel_id
 * @property string $locker_status
 * @property string $locker_created_at
 */
class LockerMaster extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'locker_master';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['locker_channel_api', 'locker_channel_id', 'locker_status', 'locker_created_at'], 'required'],
            [['locker_status'], 'string'],
            [['locker_created_at'], 'safe'],
            [['locker_channel_api', 'locker_channel_id'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'locker_channel_api' => 'Locker Channel Api',
            'locker_channel_id' => 'Locker Channel ID',
            'locker_status' => 'Locker Status',
            'locker_created_at' => 'Locker Created At',
        ];
    }
}
