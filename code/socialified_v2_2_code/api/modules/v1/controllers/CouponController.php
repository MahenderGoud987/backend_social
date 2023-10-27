<?php
namespace api\modules\v1\controllers;

use api\modules\v1\models\Business;
use Yii;
use yii\rest\ActiveController;
use yii\helpers\ArrayHelper;
use yii\data\ActiveDataProvider;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBearerAuth;
use api\modules\v1\models\Coupon;
use api\modules\v1\models\CouponSearch;
use api\modules\v1\models\Notification;
use api\modules\v1\models\Comment;
use api\modules\v1\models\CommentSearch;
use api\modules\v1\models\User;
use api\modules\v1\models\UserFavorite;

/**
 * Coupon Controller API
 *
 
 */
class CouponController extends ActiveController
{
    public $modelClass = 'api\modules\v1\models\Coupon';   
    public $serializer = [
        'class' => 'yii\rest\Serializer',
        'collectionEnvelope' => 'items',
    ];
    
    public function actions()
	{
		$actions = parent::actions();

		// disable default actions
		unset($actions['create'], $actions['update'], $actions['index'], $actions['delete'], $actions['view']);                    

		return $actions;
	}    
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => CompositeAuth::className(),
            'except'=>[],
            'authMethods' => [
                HttpBearerAuth::className()
            ],
        ];
        return $behaviors;
    }


    public function actionIndex(){


        $model = new CouponSearch();

        $result = $model->search(Yii::$app->request->queryParams);

        $response['message'] = Yii::$app->params['apiMessage']['common']['listFound'];
        
        $response['coupon']=$result;
        return $response;

        
    }

    public function actionLists(){

        $model =  new Coupon();     
        $result = $model->find()->where(['business.status'=>Coupon::STATUS_ACTIVE])->orderBy(['business.name'=>SORT_DESC])->all();        
        $response['businessLists']=$result;
        return $response;

        
    }

    public function actionShare($id=null){
        $model =  new Coupon();     
        $result = $model->find()->where(['id'=>$id])->andWhere(['status'=>Coupon::STATUS_ACTIVE])->all();        
        $response['couponShare']=$result;
        return $response;    
    }

        /**
     * add comment
     */

     public function actionAddComment()
     {
         $model = new Comment();
        //  $modelFollower = new Follower();
         $userId = Yii::$app->user->identity->id;
         $model->scenario = 'create';
         $model->load(Yii::$app->getRequest()->getBodyParams(), '');
         if (!$model->validate()) {
             $response['statusCode'] = 422;
             $response['errors'] = $model->errors;
             return $response;
         }
         $postId = @(int) $model->reference_id;
         $model->status = Comment::STATUS_ACTIVE;
         $model->type = Comment::TYPE_COUPON;
         
         
         
 
         if ($model->save(false)) {
             $modelPost = new Coupon();
             $totalLike = $modelPost->updateCommentCounter($postId);
 
             //// push notification
             /*
             $resultPost = Post::findOne($postId);
 
             $modelUser = new User();
             $userResult = $modelUser->findOne($resultPost->user_id);
 
             if ($userResult->device_token) {
                 $message = $model->comment;
                 $title = Yii::$app->user->identity->name . ' write new comment on your post';
                 $dataPush['title'] = $title;
                 $dataPush['body'] = $message;
                 $dataPush['data']['notification_type'] = 'newComment';
                 $dataPush['data']['post_id'] = $postId;
 
                 $deviceTokens[] = $userResult->device_token;
 
                 Yii::$app->pushNotification->sendPushNotification($deviceTokens, $dataPush);
 
             }
             //// end push notification
             /// add notification to list
 
             $modelNotification = new Notification();
             $modelNotification->user_id = $resultPost->user_id;
             $modelNotification->type = Notification::TYPE_NEW_COMMENT;
             $modelNotification->reference_id = $postId;
             $modelNotification->title = $title;
             $modelNotification->message = $message;
             $modelNotification->save(false);
             /// end add notification to list
 
             */
 
             
 
              // send notification 
 
              $resultPost = Coupon::findOne($postId);
              $toUserId=$resultPost->created_by;
            //  $isFollowing = $modelFollower->find()->where(['user_id'=>$userId,'follower_id'=>$toUserId])->count();
            
              $modelNotification = new Notification();
              $notificationInput = [];
              $notificationData =  Yii::$app->params['pushNotificationMessage']['newComment'];
              $replaceContent=[];   
              $replaceContent['USER'] = Yii::$app->user->identity->username;
              $notificationData['title'] = $modelNotification->replaceContent($notificationData['title'],$replaceContent);   
              // $notificationData['body'] = $modelNotification->replaceContent($notificationData['title'],$replaceContent);   
              $notificationData['body'] = $model->comment;
             
              $userIds=[];
              $userIds[]   =   $resultPost->created_by;
             
              $notificationInput['referenceId'] = $postId;
              $notificationInput['userIds'] = $userIds;
              $notificationInput['notificationData'] = $notificationData;
            //   $notificationInput['isFollowing'] = $isFollowing;
             
              
              $modelNotification->createNotification($notificationInput);
              // end send notification 
 
             $response['message'] = Yii::$app->params['apiMessage']['post']['commentSuccess'];
 
             return $response;
         } else {
             $response['statusCode'] = 422;
             $errors['message'][] = Yii::$app->params['apiMessage']['coomon']['actionFailed'];
             $response['errors'] = $errors;
             return $response;
         }
     }

     // Get all coupon comments
     public function actionCommentList(){
        $model =  new CommentSearch();
        $result = $model->search(Yii::$app->request->queryParams);

        $response['message'] = Yii::$app->params['apiMessage']['common']['listFound'];
        
        $response['commentLists']=$result;
        return $response;
     }

     // Add  Favrioute
    public function actionAddFavorite()
    {
      
        $userId                 = Yii::$app->user->identity->id; 
        $model                  =   new Coupon();
        $modelBusiness                  =   new Business();
        $modelUserFavorite  =   new UserFavorite();
        $modelUser   =   new User();
        $modelUserFavorite->scenario ='create';
        if (Yii::$app->request->isPost) {
           
            $modelUserFavorite->load(Yii::$app->getRequest()->getBodyParams(), '');
          
            if(!$modelUserFavorite->validate()) {
              
                $response['statusCode']=422;
                $response['errors']=$modelUserFavorite->errors;
                return $response;
            }
            
           $referenceId = @(int) $modelUserFavorite->reference_id;
           $type =  @(int) $modelUserFavorite->type;
           if($type ==UserFavorite::TYPE_COUPON){
            $result    = $model->findOne($referenceId);

           }elseif($type ==UserFavorite::TYPE_BUSINESS){
              $result     = $modelBusiness->findOne($referenceId);
           }    
          
           
            if(!$result){
                $response['statusCode']=422;
                $errors['message'][] = Yii::$app->params['apiMessage']['common']['noRecord'];
                $response['errors']=$errors;
                return $response;
            
            }

            $resultCount =$modelUserFavorite->find()->where(['user_id'=>$userId,'reference_id'=>$referenceId, 'type'=>$type])->count();

            if($resultCount>0){
                $response['statusCode']=422;
                $errors['message'][] = Yii::$app->params['apiMessage']['podcast']['alreadyFavorite'];
                $response['errors']=$errors;
                return $response;
            
            }

            //resultUser
            $modelUserFavorite->user_id       =   $userId;
            $modelUserFavorite->reference_id    =   $referenceId;
            
            if($modelUserFavorite->save()){
               
                
                $response['message']=Yii::$app->params['apiMessage']['podcast']['AddFavorite'];
                return $response; 
            }else{

                $response['statusCode']=422;
                $errors['message'][] = Yii::$app->params['apiMessage']['common']['actionFailed'];
                $response['errors']=$errors;
                return $response;
            
            }

            
        }
 
    }

    public function actionRemoveFavorite()
    {
        $userId                 = Yii::$app->user->identity->id;
        $model                  =   new Coupon();
        $modelBusiness                  =   new Business();
        $modelUserFavorite  =   new UserFavorite();
        $modelUser   =   new User();
        $modelUserFavorite->scenario ='removeFavorite';
        if (Yii::$app->request->isPost) {
            $modelUserFavorite->load(Yii::$app->getRequest()->getBodyParams(), '');
            if(!$modelUserFavorite->validate()) {
                $response['statusCode']=422;
                $response['errors']=$modelUserFavorite->errors;
                return $response;
            }
            $referenceId = @(int) $modelUserFavorite->reference_id;
            $type =  @(int) $modelUserFavorite->type;

            if($type ==UserFavorite::TYPE_COUPON){
                $result    = $model->findOne($referenceId);
            }elseif($type ==UserFavorite::TYPE_BUSINESS){
                $result     = $modelBusiness->findOne($referenceId);
            }
    

            if(!$result){
                
                $response['statusCode']=422;
                $errors['message'][] = Yii::$app->params['apiMessage']['common']['noRecord'];
                $response['errors']=$errors;
                return $response;
            
            }


            $resultFavorite =$modelUserFavorite->find()->where(['user_id'=>$userId,'reference_id'=>$referenceId,'type'=>$type])->one();

            if(!$resultFavorite){
                
                $response['statusCode']=422;
                $errors['message'][] = Yii::$app->params['apiMessage']['common']['noRecord'];
                $response['errors']=$errors;
                return $response;
            
            }


        
            if($resultFavorite->delete()){
               
                
                $response['message']=Yii::$app->params['apiMessage']['podcast']['removedFavorite'];
                return $response; 
            }else{

                $response['statusCode']=422;
                $errors['message'][] = Yii::$app->params['apiMessage']['common']['actionFailed'];
                $response['errors']=$errors;
                return $response;
            
            }

            
        }
        
    }

    public function actionMyFavoriteList()
    {

        $model = new CouponSearch();

        $result = $model->CouponMyFavorite(Yii::$app->request->queryParams);

        $response['message'] = Yii::$app->params['apiMessage']['common']['listFound'];
        
        $response['couponFavoriteList']=$result;
        return $response;

        
    }


}


