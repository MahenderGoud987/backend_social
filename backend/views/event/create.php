<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Countryy */

$this->title = 'Create Event';
$this->params['breadcrumbs'][] = ['label' => 'Competition', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-body">

                

                <?= $this->render('_form', [
                    'model' => $model,
                    'categoryData' =>$categoryData,
                    'eventOrganisorData'=>$eventOrganisorData
                    
                   
                ]) ?>

            </div>
        </div>
    </div>
</div>