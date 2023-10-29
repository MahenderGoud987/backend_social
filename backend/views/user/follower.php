<?php
//use yii\grid\GridView;
use kartik\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CountryySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users followers list';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-xs-12"><div class="box">
            <!-- <div class="box-header">
                <h3 class="box-title"><?= Html::encode($this->title) ?></h3>

            </div>-->
            <!-- /.box-header -->
            <div class="box-body">
                <!--<div class="pull-right"><?= Html::a('Create', ['create'], ['class' => 'btn btn-success pull-right']) ?></div>
                <div style="clear:both"></div>-->
               
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'kartik\grid\SerialColumn'],

                        [
                            'attribute'  => 'name',
                            'value'  => function ($data) {
                               $followername = $data->followerUserDetail->getAttribute('name');
                               $followerId = $data->followerUserDetail->getAttribute('id');
                                return Html::a($followername , ['/user/view', 'id' => $followerId]);
                            },
                        'format'=>'raw'
                        ],
                        
                        [
                            'attribute'  => 'username',
                            'value'  => function ($data) {
                               $followerUsername = $data->followerUserDetail->getAttribute('username');
                                return $followerUsername;
                            },
                        'format'=>'raw'
                        ],
                        [
                            'attribute'  => 'email',
                            'value'  => function ($data) {
                               $followerEmail = $data->followerUserDetail->getAttribute('email');
                               
                                return $followerEmail;
                            },
                        'format'=>'raw'
                        ],
                       
                    ],
                    'tableOptions' => [
                        'id' => 'theDatatable',
                        'class' => 'table table-striped table-bordered table-hover',
                    ],
                     'toolbar' => [
                    
                        [
                            
                        ],
                        //'{export}',
                        //'{toggleData}'
                    ],
                    'exportConfig' => [
                        GridView::CSV => ['label' => 'CSV'],
                        GridView::EXCEL => [],// html settings],
                       
                    ],
                   

                   
                    'pjax' => false,
                    'bordered' => true,
                    'striped' => false,
                    'condensed' => false,
                    'responsive' => true,
                    'hover' => true,
                    'floatHeader' => false,
                    //'floatHeaderOptions' => ['top' => $scrollingTop],
                    'showPageSummary' => false,
                    'panel' => [
                        // 'type' => GridView::TYPE_PRIMARY
                    ],
                   
                ]); ?>
            </div>


        </div>
        <!-- /.box -->



        <!-- /.col -->
    </div>
</div>