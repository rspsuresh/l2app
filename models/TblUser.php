<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_user".
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $email_id
 * @property string $username
 * @property string $password
 * @property string $user_status
 * @property string $user_type
 * @property string $created_at
 * @property int $created_by
 */
class TblUser extends  \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['first_name', 'last_name', 'email_id', 'username', 'password', 'user_status', 'user_type', 'created_at', 'created_by'], 'required'],
            [['user_status', 'user_type'], 'string'],
            [['created_at','customer_id','locker_id','locker_subscription_date','profile_img'], 'safe'],
            [['created_by'], 'integer'],
            [['first_name', 'last_name', 'email_id', 'username', 'password'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'email_id' => 'Email ID',
            'username' => 'Username',
            'password' => 'Password',
            'user_status' => 'User Status',
            'user_type' => 'User Type',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
        ];
    }

    public static function loginCheck($data){
        $Usermodel=TblUser::find()->where('(username=:username or email_id=:username) 
        and password=:password and user_status="A"',
            [':username'=>$data['username'],
                ':password'=>$data['password']
            ])->asArray()->one();

        $statusarray=[];
        if(!empty($Usermodel)) {
            if (!isset($_SESSION)) {
                session_start();
            }

            $_SESSION['username']=$Usermodel['username'];
            $_SESSION['userid']=$Usermodel['id'];
            $_SESSION['usertype']=$Usermodel['user_type'];
            $_SESSION['customerid']=$Usermodel['customer_id'];
           // $_SESSION['channelapi']=$DeviceModel->channel_api;
          //  $_SESSION['channelid']=$DeviceModel->channel_id;
            $statusarray['flag']="S";
            $statusarray['msg']="login successfully";
        }else{
            $statusarray['flag']="E";
            $statusarray['msg']="Incorrect username and password";
        }
        return $statusarray;
        }

}
