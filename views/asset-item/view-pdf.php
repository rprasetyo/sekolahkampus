<?php

use app\common\utils\EncryptionDB;
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use Da\QrCode\QrCode;


$this->title = $model->assetItemLocation->address;
\yii\web\YiiAsset::register($this);
?>
<div class="asset-item-view box box-primary">
	<div class="box-header with-border">
	  <h3 class="box-title">Detail Informasi Aset</h3>

	  <div class="box-tools pull-right">
		<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
		</button>
		<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
	  </div>
	</div>
<!--    <div class="card">-->
<!--        --><?php
//        if (!empty($model)) {
//            foreach ($model as $row) {
//                $qrCode = (new QrCode($row['nis']))
//                    ->setSize(55)
//                    ->setMargin(3)
//                    ->useForegroundColor(51, 153, 255);
//                $url = 'upload/' . $row['foto'];
//                echo "<p style='text-align:center; border:1px solid black'>";
//                echo "<img src=$url height='133px' width='133px;'>";
//                echo "<p>$row[nama]<br></p>";
//                echo "<p align='center'>$row[nis]</p><br>";
//                echo '<img src="' . $qrCode->writeDataUri() . '"><br>';
//                echo "</p>";
//            }
//        }
//        ?><!-- </div>-->
    <div class="card">
        <?php
		/*
        $qrCode = (new QrCode($model['assetMaster']['asset_code']))
            ->setSize(100)
            ->setMargin(5)
            ->setLabel('Scan')
            ->useForegroundColor(51, 153, 255);

        // now we can display the qrcode in many ways
        // saving the result to a file:

        $qrCode->writeFile(Yii::getAlias('@webroot') . '/images/asset_file/qrcode.png'); // writer defaults to PNG when none is specified

        // display directly to the browser
        header('Content-Type: '.$qrCode->getContentType());
        //        echo $qrCode->writeString();
		*/
        ?>
        <?php
        // or even as data:uri url
        //echo '<img src="' . $qrCode->writeDataUri() . '">';
        ?>
    </div>
    <br>
	<div class="box-body" style="">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id_asset_item',
			'number1',
//            'id_asset_item',
            //'id_asset_master',
			[
                //'label' => 'Supplier Name',
                'attribute'=>'assetMaster.asset_name',
                //'filter'=>Html::activeDropDownList($searchModel, 'id_supplier', $datalist, ['class' => 'form-control']),
            ],
            // [
            //     //'label' => 'Supplier Name',
            //     'attribute'=>'sensor.sensor_name',
            //     //'filter'=>Html::activeDropDownList($searchModel, 'id_supplier', $datalist, ['class' => 'form-control']),
            // ],
			[
                //'label' => 'Supplier Name',
                'attribute'=>'assetMaster.asset_code',
                //'filter'=>Html::activeDropDownList($searchModel, 'id_supplier', $datalist, ['class' => 'form-control']),
            ],
			/*
			[
                'attribute'=>'assetItemLocation.address',
				
            ],
			*/
			[
				'label' => 'Type',
				'attribute' => 'assetItemType1.type_asset_item',
			],
			[
				'label' => 'Status',
				'attribute' => 'assetItemType2.type_asset_item',
			],
			[
                //'label' => 'Supplier Name',
                'attribute'=>'assetMaster.typeAsset1.type_asset',
				
                //'filter'=>Html::activeDropDownList($searchModel, 'id_supplier', $datalist, ['class' => 'form-control']),
            ],
			[
                'attribute'=>'assetReceived.notes1',
            ],
			[
                'attribute'=>'assetItemLocation.keterangan1',
            ],
			[
                'attribute'=>'assetItemLocation.latitude',
            ],
			[
                'attribute'=>'assetItemLocation.longitude',
            ],
			[
                'attribute'=>'assetItemLocation.batas_utara',
            ],
			[
                'attribute'=>'assetItemLocation.batas_selatan',
            ],
			[
                'attribute'=>'assetItemLocation.batas_barat',
            ],
			[
                'attribute'=>'assetItemLocation.batas_timur',
            ],
			[
                'attribute'=>'assetItemLocation.luas',
            ],
			[
                'attribute'=>'assetReceived.received_year',
            ],
			[
                'attribute'=>'assetReceived.price_received',
				
            ],
			[
                //'label' => 'Supplier Name',
                'attribute'=>'assetReceived.statusReceived.status_received',
				
                //'filter'=>Html::activeDropDownList($searchModel, 'id_supplier', $datalist, ['class' => 'form-control']),
            ],
        ],
    ]) ?>
	</div>
</div>

<?php /*
<div class="map-view box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Peta Geografi</h3>

        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>
    </div>

    <div class="box-body" style="">
        <?= $this->render('/asset-item-location/map/_map_single', [
            'model' => $modelItemLocation,
        ]) ?>
    </div>
</div>
*/ ?>
