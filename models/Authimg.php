<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "authimg".
 *
 * @property int $id
 * @property string $auth_img
 * @property string $created_at
 * @property int $created_by
 * @property string $asset_id
 * @property string $public_id
 * @property string $img_url
 */
class Authimg extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'authimg';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['auth_img', 'created_at', 'created_by', 'asset_id', 'public_id', 'img_url'], 'required'],
            [['created_at'], 'safe'],
            [['created_by'], 'integer'],
            [['auth_img', 'asset_id', 'public_id', 'img_url'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'auth_img' => 'Auth Img',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'asset_id' => 'Asset ID',
            'public_id' => 'Public ID',
            'img_url' => 'Img Url',
        ];
    }
}
