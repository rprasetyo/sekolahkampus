<?php

use yii\helpers\Html;

/* @var $this  yii\web\View */
/* @var $model mdm\admin\models\BizRule */

$this->title = Yii::t('rbac-admin', 'Create Rule');
$this->params['breadcrumbs'][] = ['label' => Yii::t('rbac-admin', 'Rules'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-item-create">
    <div class="box">
        <div class="box-primary">
            <div class="row">
                <div class="box-body">
                    <div class="col-md-12">

                        <?=
                        $this->render('_form', [
                            'model' => $model,
                        ]);
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
