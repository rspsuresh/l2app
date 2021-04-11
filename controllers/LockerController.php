<?php

namespace app\controllers;

use app\models\Authimg;
use app\models\AuthorizeImg;
use app\models\LockerTracker;
use app\models\TblUser;
use app\models\User;
use yii\web\UploadedFile;

class LockerController extends \yii\web\Controller
{
    public function beforeAction($action)
    {
       // echo "<pre>";print_r(\Yii::$app->controller->action->id);die;
        $adminAction=['lockerusers','create','changestatus','changestatus','lockertracker'];
        $UserAction=['uploadcld','clres','upload','clouddelete','lockertracker'];
        if (!isset($_SESSION['username']) && !\Yii::$app->request->isAjax) {
            \Yii::$app->getResponse()->redirect(\Yii::$app->getUser()->loginUrl);
        }else{
//            $listArr=$_SESSION['usertype']=="A"?$adminAction:$UserAction;
//            if(in_array(\Yii::$app->controller->action->id,$listArr)){
                return parent::beforeAction($action);
//            }else{
//                \Yii::$app->getResponse()->redirect(\Yii::$app->getUser()->loginUrl);
//            }
        }
    }
    public function actionIndex()
    {
        return $this->render('index');
    }
    public function actionUploadcld()
    {
        \Cloudinary::config(array(
            'cloud_name' => 'project301220',
            'api_key' => '138435171694115',
            'api_secret' => 'ZUpVJ3PPWazj4hO3NDm7pyKXM4o',
        ));
        if(isset(\Yii::$app->request->isPost) && $_FILES){
            $file=basename($_FILES["file"]["name"]);
            $publicId=$_SESSION['userid']."_".md5($file);
            $result=\Cloudinary\Uploader::upload($_FILES["file"]["tmp_name"], array("folder" => "l2app/",
                "public_id" =>$publicId ));
            if(!empty($result)){
                $AuthModel=new  Authimg();
                $AuthModel->auth_img=$publicId;
                $AuthModel->created_by=$_SESSION['userid'];
                $AuthModel->created_at=date('Y-m-d H:i:s');
                $AuthModel->asset_id=$result['asset_id'];
                $AuthModel->public_id=$result['public_id'];
                $AuthModel->img_url=$result['secure_url'];
                $AuthModel->save();
            }
        }
    }
    public function init()
    {
        parent::init();
//        Cloudinary::config([
//            'cloud_name' => $this->cloud_name,
//            'api_key' => $this->api_key,
//            'api_secret' => $this->api_secret,
//            'cdn_subdomain' => $this->cdn_subdomain,
//        ]);
                \Cloudinary::config(array(
            'cloud_name' => 'project301220',
            'api_key' => '138435171694115',
            'api_secret' => 'ZUpVJ3PPWazj4hO3NDm7pyKXM4o',
        ));
    }

    public function actionClres(){
        $AuthImgModel=Authimg::find()->where('created_by =:user',[':user'=>$_SESSION['userid']])->all();
        return $this->render('loglist',['AuthImgModel'=>$AuthImgModel]);
    }
    public function actionUpload(){
        return $this->render('cloudinary');
    }
    public function actionClouddelete(){
        \Cloudinary::config(array(
            'cloud_name' => 'project301220',
            'api_key' => '138435171694115',
            'api_secret' => 'ZUpVJ3PPWazj4hO3NDm7pyKXM4o',
        ));
        if(isset($_GET['id'])){
            $api = new \Cloudinary\Api();
            $api->delete_resources([$_GET['id']], $options = array());
            Authimg::deleteAll('public_id=:id',[':id'=>$_GET['id']]);
            $reTEngineArr=['flag'=>'S','Code'=>200,'msg'=>"Deleted Successfully" ];
        }
        return  json_encode($reTEngineArr);
    }
    public function actionLockerusers(){

        $userModel=TblUser::find()->select(['A.locker_channel_api','A.locker_channel_id','tbl_user.*'])->
            leftJoin('locker_master as A','locker_id=A.id')
            ->where('user_type="U"')
            ->asArray()->all();
//echo "<pre>";print_r($userModel);die;
        return $this->render('listlockers',['usermodel'=>$userModel]);
    }

    public function actionCreate(){

        if(\Yii::$app->request->isAjax && !empty($_POST)){
            $user=$this->saveandupdate($_POST);
            return json_encode($user);
        }else{
            $User=new TblUser();
            if(isset($_GET['id'])){
                $userid=intval(base64_decode($_GET['id']));
                $User=TblUser::findOne($userid);
            }
            return $this->render('create',['user'=>$User]);
        }
       // return $this->render('create');
    }
   public function saveandupdate($data){
       if(!empty($data)){
           $userid=$data['userid'];

           if(!empty($userid)){
               $UserModel=TblUser::findOne($userid);
               $msg='Updated Successfully';
           }else {
               $lastInsertId=TblUser::find()->orderBy('id desc')->one()->id;
               $UserModel = new TblUser();
               $UserModel->customer_id="POLZ-".$lastInsertId;
               $UserModel->user_status="I";
               $msg='Created Successfully';
               $UsernameCheck=TblUser::find()->where('username=:usrname',
                   [':usrname'=>$_POST['username']])->one();
               if(!empty($UsernameCheck)){
                   $returnArr=['flag'=>'E','code'=>500,'msg'=>'Username already exists'];
                   return  $returnArr;
               }
               $UsernameMail=TblUser::find()->where('email_id=:email',[':email'=>$_POST['email']])->one();
               if(!empty($UsernameMail)){
                   $returnArr=['flag'=>'E','code'=>500,'msg'=>'Email already exists'];
                   return  $returnArr;
               }
           }

           $UserModel->email_id=$data['email'];
           $UserModel->first_name=$data['firstname'];
           $UserModel->last_name=$data['lastname'];
           $UserModel->password=$data['password'];
           $UserModel->username=$data['username'];
           $UserModel->locker_id=$data['locker'];
           if($UserModel->isNewRecord){
               $UserModel->user_type="U";
               $UserModel->created_at=date('Y-m-d H:i:s');
               $UserModel->created_by=$_SESSION['userid'];
           }
           if(isset($_FILES)){
               $target_dir = "assets/uploads/";
               $newfilename=round(microtime(true)) . '.' . basename($_FILES["profile"]["name"]);
               $target_file = $target_dir . $newfilename;
               move_uploaded_file($_FILES["profile"]["tmp_name"], $target_file);
               $UserModel->profile_img=$newfilename;
           }
           if($UserModel->save(false)){
               $returnArr=['flag'=>'S','code'=>'200','msg'=>$msg];
           }else{
               $returnArr=['flag'=>'E','code'=>500,'msg'=>$msg];
           }
           return  $returnArr;
       }
   }
   public function actionChangestatus(){
       $filterId=base64_decode($_GET['id']);
       $UserModel=TblUser::findOne($filterId);
       $UserModel->user_status=$UserModel->user_status=='A'?'I':'A';
       if($UserModel->save(false)){
           $reTEngineArr=['flag'=>'S','Code'=>200,'msg'=>"Status Changed Successfully" ];
       }else{
           $reTEngineArr=['flag'=>'E','Code'=>500,'msg'=>"Something Went Wrong" ];
       }
       return  json_encode($reTEngineArr);
   }
   public function actionLockertracker(){
        $user=base64_decode($_GET['user']);
        $locker=base64_decode($_GET['locker']);

        $Ltracker=LockerTracker::find()->where('created_by=:by and locker_id=:locker',
            [':by'=>$user,':locker'=>$locker])->one();
        if(empty($Ltracker)){
            $Ltracker=new LockerTracker();
            $Ltracker->locker_status="ON";
        }else{
            $Ltracker->locker_status=$Ltracker->locker_status=="ON"?'OFF':'ON';
        }
       $Ltracker->created_at=date('Y-m-d H:i:s');
       $Ltracker->created_by=$user;
       $Ltracker->locker_id=$locker;
       if($Ltracker->save(false)){
           $reTEngineArr=['flag'=>'S','Code'=>200,'msg'=>"Status Changed Successfully" ];
       }else{
           $reTEngineArr=['flag'=>'E','Code'=>500,'msg'=>"Something Went Wrong" ];
       }
       return  json_encode($reTEngineArr);
   }
}
