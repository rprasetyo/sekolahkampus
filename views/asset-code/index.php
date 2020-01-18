<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AssetCodeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Asset Codes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="asset-code-index box box-success">

    <!--    <h1>--><?php //Html::encode($this->title) ?><!--</h1>-->
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <div class="box-header with-border">
        <p>
            <?= Html::a('Create Asset Code', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    </div>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'header' => 'No',
                'class' => 'yii\grid\SerialColumn'],

//            'id_asset_code',
            'id_parent_asset_code',
            'code',
            'description',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
<?php
$items = [
    [
        'text' => 'Node 1',                                 ///(needed!)
        'href' => ['site/index'],                  ///(optional) Note: `href` must be route array!
        'icon' => 'glyphicon glyphicon-stop',               ///(optional)
        'selectedIcon' => "glyphicon glyphicon-stop",       ///(optional)
        'selectable' => true,
        'color' => '#111315',///(optional)
        'state' => [                                        ///(optional)
            // 'checked' => true,
            // 'disabled' => true,
            // 'expanded' => true,
            // 'selected' => true,
        ],
        'tags' => ['available'],                            ///(optional)

        'visible' => true,                                  ///(optional) same as [yii\widgets\Menu::$visible]
        'encode' => true,                                   ///(optional) same as [yii\widgets\Menu::$encode]
        // ...
        'nodes' =>
            [
                [
                    'text' => 'Node 1.1',
                    'href' => ['site/index'],

                ],
                ['text' => 'Node 1.2', 'href' => ['site/index']],
            ]
    ],
    [
        'text' => 'Node 2',
        'href' => ['site/index'],
        'nodes' => [
            [
                'text' => 'Node 2.1',
                'href' => ['site/index'],
                'icon' => 'glyphicon glyphicon-folder-open',
                'nodes' =>[
                    [
                            'text' => 'Node 2.2', 'href' => ['site/index']
                        ]
                ],
            ],
            ['text' => 'Node 2.2', 'href' => ['site/index']
            ],
        ]
    ],
    [
        'text' => 'Node 3',
        'href' => ['site/index'],
        'nodes' => [
            [
                'text' => 'Node 2.1',
                'href' => ['site/index'],
                'icon' => 'glyphicon glyphicon-folder-open',
            ],
            ['text' => 'Node 2.2', 'href' => ['site/index']],
        ]
    ],
];
?>
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Tree View
        </h3>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-md-6">
                <?= \yongtiger\bootstraptree\widgets\BootstrapTree::widget([
                    'options' => [
                        'data' => $items,                                   ///(needed!)
                        'enableLinks' => true,                              ///(optional)
                        'showTags' => true,                                 ///(optional)
                        'levels' => 3,                                      ///(optional)
                        'multiSelect' => true,  ///(optional, but when `selectParents` is true, you must also set this to true!)

                    ],
                    'htmlOptions' => [                                      ///(optional)
                        'id' => 'treeview-tabs',
                    ],
                    'events' => [                                                ///(optional)
                        'onNodeSelected' => 'function(event, data) {
                            // Your logic goes here
                            alert(data.text);
                        }'
                    ],

                    ///(needed for using jonmiles bootstrap-treeview 2.0.0, must specify it as `<a href="{href}">{text}</a>`)
                    'textTemplate' => '<a href="{href}">{text}</a>',

                    ///(optional) Note: when it is true, you must also set `multiSelect` of the treeview widget options to true!
                    'selectParents' => true,
                ]); ?>
            </div>
        </div>
    </div>
</div>

