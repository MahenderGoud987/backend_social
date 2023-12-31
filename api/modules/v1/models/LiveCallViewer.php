<?php
namespace api\modules\v1\models;
use Yii;
use yii\helpers\ArrayHelper;

use api\modules\v1\models\User;
//use api\modules\v1\models\LiveTv;


class LiveCallViewer extends \yii\db\ActiveRecord
{
   
    
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'live_call_viewer';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        
        return [
            [['id','live_call_id','user_id','created_at'], 'integer']
            
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
        }

        
        return parent::beforeSave($insert);
    }
    
    public function extraFields()
    {
       // return ['user'];
    }


   
    

    public function getUser()
    {
       return $this->hasOne(User::className(), ['id'=>'user_id']);
        
    }
    
    
    

    

}
