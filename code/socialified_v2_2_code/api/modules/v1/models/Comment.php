<?php
namespace api\modules\v1\models;
use Yii;
use yii\helpers\ArrayHelper;
use api\modules\v1\models\Post;

class Comment extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE=10;
    const STATUS_DELETED=0;
    const TYPE_COUPON   =1;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'comment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id','user_id','reference_id','status','created_at','type'], 'integer'],
            [['comment'], 'string','max'=>200],
            [['reference_id','comment'], 'required', 'on'=>'create'],
            [['reference_id'], 'required', 'on'=>'list']
            

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => Yii::t('app', 'User'),
            'reference_id' => Yii::t('app', 'Comment  Reference Id'),
            'created_at'=> Yii::t('app', 'created At'),
            
        ];
    }
   
    public function beforeSave($insert)
    {
        if ($insert) {
            $this->created_at = time();
            $this->user_id =   Yii::$app->user->identity->id;
          
        }
    
        return parent::beforeSave($insert);
    }

    public function extraFields()
    {
        return ['user','coupon'];
    }
    
    /**
     * RELEATION START
     */
    public function getUser()
    {
       
        return $this->hasOne(User::className(), ['id'=>'user_id']);
        
    }

    public function getCoupon()
    {
       
        return $this->hasOne(Coupon::className(), ['id'=>'reference_id']);
        
    }
    


    
    

}
