<?php
namespace api\modules\v1\models;
use Yii;
use yii\helpers\ArrayHelper;
use api\modules\v1\models\Competition;
use api\modules\v1\models\Post;
use api\modules\v1\models\User;

class Notification extends \yii\db\ActiveRecord
{
    /*const TYPE_NEW_FOLLOWER=1;
    const TYPE_NEW_COMMENT=2;*/
    
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'notification';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
           
            [['id','type','user_id','created_at','reference_id','read_status','created_by'], 'integer'],
            [['title','message'], 'string', 'max' => 256]

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            
        ];
    }
   
    public function beforeSave($insert)
    {
        if ($insert) {
            $this->created_at = time();
            $this->created_by  =   Yii::$app->user->identity->id;
                  
        }
        
        return parent::beforeSave($insert);
    }


    public function fields()
    {
        $fields = parent::fields();

     //  $fields[] = 'userLocation';
        return $fields;
    }

    public function extraFields()
    {
         return ['createdByUser','refrenceDetails'];
    }
    

    public function createNotification($options)
    {
            
        $modelUser             =   new User();
        $referenceId           = @$options['referenceId'];
        $createdBy             = (int)@$options['createdBy'];
        
        
        $userIds               = $options['userIds'];
        $notificationData      = $options['notificationData'];
        $isFollowing            = (int)@$options['isFollowing'];
        $isSaveList            = (isset($options['isSaveList'])) ? $options['isSaveList'] : true;
        $title                 = $notificationData['title'];
        $body                  = $notificationData['body'];
        $type                  = @$notificationData['type'];
        
        
        

        

        if($userIds){
            $userIds= array_unique($userIds);
        }
        
        $userDeviceIds=[];
        
        $resultUsers = $modelUser->find()->select(['id','device_token','email','is_push_notification_allow','like_push_notification_status','comment_push_notification_status'])->where(['IN','id',$userIds])->all();
        foreach($resultUsers as $resultUser){
            
            if($resultUser->device_token &&  $resultUser->is_push_notification_allow){
                
               

                $isSend=false;
                if($type==2){ // comment
                    if($resultUser->comment_push_notification_status==User::NOTIFICATION_ALL){
                        $isSend=true;
                    }else if($resultUser->comment_push_notification_status==User::NOTIFICATION_FOLLOWING && $isFollowing){
                        $isSend=true;
                    }
                }else if($type==3){ //like

                    if($resultUser->like_push_notification_status==User::NOTIFICATION_ALL){
                        $isSend=true;
                    }else if($resultUser->like_push_notification_status==User::NOTIFICATION_FOLLOWING && $isFollowing){
                        $isSend=true;
                    }
                    
                }else{
                    $isSend=true;
                }
                
                if($isSend){
                    if($resultUser->device_token){
                        $userDeviceIds[] = $resultUser->device_token;
                    }
                }
                
                
                
            }
            
            if($isSaveList){
                
                $modelNotification                  =   new Notification();
                $modelNotification->user_id         =   $resultUser->id;
                $modelNotification->type            =   $type;
                $modelNotification->title           =   $title;
                $modelNotification->message         =   $body;
                $modelNotification->reference_id        =   $referenceId;
               /* if($createdBy>0){
                    $modelNotification->createdBy        =   $referenceId;
                }*/
               
               $modelNotification->save(false);
            }


        }

       
        $dataPush['title']	        	        	=	$title;
        $dataPush['body']		                	=	$body;
        $dataPush['data']['notification_type']		=	$type;
        $dataPush['data']['reference_id']		    =	$referenceId;

        //$dataPush['data']['seller_order_id']		=	$sellerOrderId;
        /*if($orderCustomizationRequestId){
            $dataPush['data']['orderCustomizationRequestId']		=	$orderCustomizationRequestId;
        }*/
        $deviceTokens    					        =    $userDeviceIds;
        
        
        if(count($userDeviceIds)>0){
            Yii::$app->pushNotification->sendPushNotification($deviceTokens, $dataPush);
        }
       
        

    }

    
    public function replaceContent($content,$replaceData)
    {
        foreach($replaceData as $key => $value){
            $content = str_replace('{{'.$key.'}}',$value,$content);
        }
        return $content;
    }

    public function getRefrenceDetails()
    {
        $type= $this->type;
        $referenceId  = $this->reference_id;
        
        
        if($type==1){
              return User::find()->where(['id'=>$referenceId])->select(['id','name','username','email','bio','description','image','country_code','phone','country','city','sex'])->one();;
        }
        elseif($type==2){
            return Post::find()->select('id,user_id ,type,title')->where(['id'=>$referenceId])->one();
        }
       elseif($type==3){
           return Post::find()->select('id,user_id ,type,title')->where(['id'=>$referenceId])->one();
       }    
        elseif($type==4){
            return Competition::find()->where(['id'=>$referenceId])->one();
        }
        elseif($type==5){
            return Competition::find()->where(['id'=>$referenceId])->one();
        }
        
        
    } 

    public function getUserDetails($userId)
    {
       
        return User::find()->where(['id'=>$userId])->select(['id','name','username','email','bio','description','image','country_code','phone','country','city','sex'])->one();
    } 

    public function getCreatedByUser()
    {
        
        return $this->hasOne(User::className(), ['id'=>'created_by']);
      
    } 
    

}
