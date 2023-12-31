<?php
namespace api\modules\v1\models;
use Yii;
use yii\helpers\ArrayHelper;
use api\modules\v1\models\Post;

class PostComment extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE=10;
    const STATUS_DELETED=0;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'post_comment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id','type','user_id','post_id','status','created_at'], 'integer'],
            [['comment','filename'], 'string','max'=>255],
            [['post_id','type'], 'required', 'on'=>'create'],
            [['post_id'], 'required', 'on'=>'list']
            

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
            'post_id' => Yii::t('app', 'Ad'),
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
    
    public function fields()
    {
        $fields = parent::fields();
        $fields[] = "filenameUrl";
        return $fields;
    }

    public function extraFields()
    {
        return ['user'];
    }
    
    /**
     * RELEATION START
     */
    public function getUser()
    {
       
        return $this->hasOne(User::className(), ['id'=>'user_id']);
        
    }

    
    public function getFilenameUrl(){

        if($this->filename && $this->type !=1 ){ /// not text
            if($this->type==4){ /// if gif
                return $this->filename;
            }else{
                $modelFileUpload = new FileUpload();
                return $modelFileUpload->getFileUrl($modelFileUpload::TYPE_POST,$this->filename);
            }
        }
     }


    


    
    

}
