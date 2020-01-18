<?php

use dosamigos\grid\columns\EditableColumn;
use yii\grid\GridView;
use app\common\helpers\TypeFieldEnum;
use app\common\helpers\DatabaseTableReflection;
use yii\helpers\Url;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AppFieldConfigSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'App Field Configs';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="box box-success">
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>
</div>
<?php
if(isset($_GET['AppFieldConfigSearch'])){
	$get = $_GET['AppFieldConfigSearch'];
	$models = $dataProvider->getModels();
	$totalrows = count($models);
	if($totalrows > 0){
?>
<div class="aapp-field-config-index box box-success">
    <div class="box-header with-border">
        <p>
            <?php
            //= Html::a('Create App Field Config', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    </div>
    <div class="box-body table-responsive">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                //'id_app_field_config',
                'classname',
                'fieldname',
                [
                    'class' => EditableColumn::className(),
                    'attribute' => 'label',
                    'url' => ['editable'], // the route to the editable action!
                    'type' => 'text',
                    'contentOptions' => function ($model, $key, $index, $column) {
                        return ['style' => 'text-color : white', 'class' => 'text-left text-blue'];
                    },
                    'editableOptions' => [
                        'mode' => 'popup',
                    ]
                ],
                [
                    'class' => EditableColumn::className(),
                    'attribute' => 'no_order',
                    'url' => ['editable'], // the route to the editable action!
                    'type' => 'number',
                    'contentOptions' => function ($model, $key, $index, $column) {
                        return ['style' => 'text-color : white', 'class' => 'text-center text-blue'];
                    },
                    'editableOptions' => [
                        'mode' => 'popup',
                    ]
                ],
                [
                    'class' => EditableColumn::className(),
                    'attribute' => 'is_visible',
                    'value' => function ($model) {
                        return $model->is_visible == 0 ? 'False' : 'True';
                    },
                    'url' => ['editable'], // the route to the editable action!
                    'type' => 'select',
                    'contentOptions' => function ($model, $key, $index, $column) {
                        return ['style' => 'text-color : white', 'class' => 'text-center text-blue'];
                    },
                    'editableOptions' => [
                        'mode' => 'popup',
                        'source' => [
                            ['value' => '1', 'text' => 'True'],
                            ['value' => '0', 'text' => 'False'],
                        ],
                    ]
                ],
                [
                    'class' => EditableColumn::className(),
                    'attribute' => 'is_required',
                    'value' => function ($model) {
                        return $model->is_required == 0 ? 'False' : 'True';
                    },
                    'url' => ['editable'], // the route to the editable action!
                    'type' => 'select',
                    'contentOptions' => function ($model, $key, $index, $column) {
                        return ['style' => 'text-color : white', 'class' => 'text-center text-blue'];
                    },
                    'editableOptions' => [
                        'mode' => 'popup',
                        'source' => [
                            ['value' => '1', 'text' => 'True'],
                            ['value' => '0', 'text' => 'False'],
                        ],
                    ]
                ],
                [
                    'class' => EditableColumn::className(),
                    'attribute' => 'is_unique',
                    'value' => function ($model) {
                        return $model->is_unique == 0 ? 'Tidak' : 'Ya';
                    },
                    'url' => ['editable'], // the route to the editable action!
                    'type' => 'select',
                    'contentOptions' => function ($model, $key, $index, $column) {
                        return ['style' => 'text-color : white', 'class' => 'text-center text-blue'];
                    },
                    'editableOptions' => [
                        'mode' => 'popup',
                        'source' => [
                            ['value' => '1', 'text' => 'True'],
                            ['value' => '0', 'text' => 'False'],
                        ],
                    ]
                ],
                [
                    'class' => EditableColumn::className(),
                    'attribute' => 'is_safe',
                    'value' => function ($model) {
                        return $model->is_safe == 0 ? 'Tidak' : 'Ya';
                    },
                    'url' => ['editable'], // the route to the editable action!
                    'type' => 'select',
                    'contentOptions' => function ($model, $key, $index, $column) {
                        return ['style' => 'text-color : white', 'class' => 'text-center text-blue'];
                    },
                    'editableOptions' => [
                        'mode' => 'popup',
                        'source' => [
                            ['value' => '1', 'text' => 'True'],
                            ['value' => '0', 'text' => 'False'],
                        ],
                    ]
                ],
                [
                    'class' => EditableColumn::className(),
                    'attribute' => 'type_field',
                    'value' => function ($model) {
                        return $model->typeFieldConfig;
                    },
                    'url' => ['editable'], // the route to the editable action!
                    'type' => 'select',
                    'contentOptions' => function ($model, $key, $index, $column) {
                        return ['style' => 'text-color : white', 'class' => 'text-center text-blue'];
                    },
                    'editableOptions' => [
                        'mode' => 'popup',
                        'source' => TypeFieldEnum::$list,
                    ]
                ],
                [
                    'class' => EditableColumn::className(),
                    'attribute' => 'max_field',
                    'url' => ['editable'], // the route to the editable action!
                    'type' => 'number',
                    'contentOptions' => function ($model, $key, $index, $column) {
                        return ['style' => 'text-color : white', 'class' => 'text-center text-blue'];
                    },
                    'editableOptions' => [
                        'mode' => 'popup',
                    ]
                ],
                [
                    'class' => EditableColumn::className(),
                    'attribute' => 'default_value',
                    'url' => ['editable'], // the route to the editable action!
                    'type' => 'text',
                    'contentOptions' => function ($model, $key, $index, $column) {
                        return ['style' => 'text-color : white', 'class' => 'text-left text-blue'];
                    },
                    'editableOptions' => [
                        'mode' => 'popup',
                    ]
                ],
                [
                    'class' => EditableColumn::className(),
                    'attribute' => 'pattern',
                    'url' => ['editable'], // the route to the editable action!
                    'type' => 'text',
                    'contentOptions' => function ($model, $key, $index, $column) {
                        return ['style' => 'text-color : white', 'class' => 'text-left text-blue'];
                    },
                    'editableOptions' => [
                        'mode' => 'popup',
                    ]
                ],
                [
                    'class' => EditableColumn::className(),
                    'attribute' => 'image_extensions',
                    'url' => ['editable'], // the route to the editable action!
                    'type' => 'text',
                    'contentOptions' => function ($model, $key, $index, $column) {
                        return ['style' => 'text-color : white', 'class' => 'text-left text-blue'];
                    },
                    'editableOptions' => [
                        'mode' => 'popup',
                    ]
                ],
                [
                    'class' => EditableColumn::className(),
                    'attribute' => 'image_max_size',
                    'url' => ['editable'], // the route to the editable action!
                    'type' => 'number',
                    'contentOptions' => function ($model, $key, $index, $column) {
                        return ['style' => 'text-color : white', 'class' => 'text-center text-blue'];
                    },
                    'editableOptions' => [
                        'mode' => 'popup',
                    ]
                ],

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
    </div>
</div>
<?php
	}else{
		echo '<div class="aapp-field-config-index box box-success">
		<div class="box-header with-border">
		';
		$tableName = $get['classname'];
		echo '
		<div class="callout callout-warning">
			<h4>Warning!</h4>
			Field-file untuk tabel '.$tableName.' belum ada. Apakah anda yakin mau generate terlebih dahulu?
			Berikut ini daftar nama-nama fieldnya:
		  </div>
		';
		$datalist = DatabaseTableReflection::getListColumnFromTable($tableName);
		echo '<ul>';
		foreach($datalist as $key=>$val){
			echo '<li>'.$val.'</li>';
		}
		echo '</ul>';
		$urlgenerate = Url::toRoute(['generate', 'c'=>$tableName]);
		echo '<a href="'.$urlgenerate.'" class="btn btn-sm btn-success btn-flat pull-left">GENERATE</a>';
		echo '</div>
		</div>
		';
	}
}
?>