<?php
namespace common\models;
use Yii;
use yii\helpers\ArrayHelper;
use common\models\FileUpload;


class CampaignExampleImage extends \yii\db\ActiveRecord
{
    const STATUS_DELETED=0;
    const STATUS_ACTIVE=10;
    const STATUS_INACTIVE=9;
    
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'campaign_images';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status', 'id'], 'integer'],
            [['image','media_type'], 'string', 'max' => 100]

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'image' => Yii::t('app', 'Image'),
        ];
    }


    
    public function addPhoto($id,$images){
    

        $values=[];

        
        
        foreach($images as $image){

            $str = $image;
            $imgtype= explode(".",$str);
            $dataInner=[]; 
            $dataInner['campaign_id']         =    $id;
            $dataInner['image']                  =    $image;
            $dataInner['created_at']                  =   time();
            $extention = $imgtype[1];
            $type ='';
             if($extention == "jpg" || $extention == "png" || $extention == "jpeg"){
                $type = 1;
             }elseif($extention == "mp4"){
                $type = 2;
             }
             $dataInner['media_type' ]  =  $type;
           
            $values[]=$dataInner;

        }   

        
        if(count($values)>0){

            Yii::$app->db
            ->createCommand()
            ->batchInsert('campaign_images', ['campaign_id','image','created_at','media_type'],$values)
            ->execute();
        }
    }

   
   
    public function getImageUrl(){

        $modelFileUpload = new FileUpload();
        return $modelFileUpload->getFileUrl($modelFileUpload::TYPE_CAMPAGIN,$this->image);
        
        //return Yii::$app->params['pathUploadCompetition'] ."/".$this->image;
    }
    

}
