<?php
use app\models\AssetItemLocation;
use app\models\AssetItem;
use app\models\AssetReceived;
?>

<?php
/*
$TOTAL_LUASAN = AssetItem::find()
    ->select(['*'])
    ->join('RIGHT JOIN', AssetItemLocation::tableName(), 'asset_item.id_asset_item_location=asset_item_location.id_asset_item_location');
//    ->where(['id_type_of_supplier' => $t])
    //->orderBy('userid')
//    ->count();
$sum = $TOTAL_LUASAN->sum('luas');

$TOTAL_PENGGUNAAN = AssetReceived::find()
    ->select(['notes1'])
    ->join('LEFT JOIN', AssetItem::tableName(), 'asset_received.id_asset_received=asset_item.id_asset_received')
    ->count();

$TOTAL_RECORD = AssetItem::find()->count();
*/

	$TOTAL_RECORD = 0;
	$TOTAL_PENGGUNAAN = 0;
	$TOTAL_LUASAN = 0;
	$TOTAL_NILAI_PEROLEHAN = 0;

	//Perhitungannya menggunakan berdasarkan hasil recordset yang sudah berhasil difilter
	$record = 0;
    foreach($models as $model){
		$record++;
		if(isset($model->assetReceived)){
			//echo "==>".$model->assetReceived->notes1."<br>";
			$TOTAL_PENGGUNAAN +=floatval($model->assetReceived->notes1)*1;
		}
		if(isset($model->assetItemLocation)){
			//echo $model->assetItemLocation->luas."<br>";
			$TOTAL_LUASAN +=floatval($model->assetItemLocation->luas)*1;
		}
		if(isset($model->assetReceived)){
			//echo $model->assetItemLocation->luas."<br>";
			$TOTAL_NILAI_PEROLEHAN +=floatval($model->assetReceived->price_received)*1;
		}
    }
	//echo $record;
	
	$TOTAL_RECORD = $record;
?>

<div class="row">
	
    <div class="col-md-4">
        <div class="info-box bg-green">
            <span class="info-box-icon"><i class="fa fa-database"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Total Record Data</span>
                <span class="info-box-number"><?php echo $TOTAL_RECORD; ?></span>

                <div class="progress">
                    <div class="progress-bar" style="width: 100%"></div>
                </div>
                <!--                <span class="progress-description">-->
                <!--                    100% Increase in 30 Days-->
                <!--                  </span>-->
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
	
    <!-- /.col -->
	<?php /*
    <div class="col-md-4">
        <div class="info-box bg-green">
            <span class="info-box-icon"><i class="fa fa-tags"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Total Penggunaan</span>
                <span class="info-box-number"><?php echo number_format($TOTAL_PENGGUNAAN,0); ?></span>

                <div class="progress">
                    <div class="progress-bar" style="width: 100%"></div>
                </div>
                <!--                <span class="progress-description">-->
                <!--                    100% Increase in 30 Days-->
                <!--                  </span>-->
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
	*/ ?>
    <!-- /.col -->
	<?php /*
    <div class="col-md-4">
        <div class="info-box bg-yellow">
            <span class="info-box-icon"><i class="fa fa-object-group"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Total Luasan</span>
                <span class="info-box-number"><?php echo number_format($TOTAL_LUASAN,0); ?></span>

                <div class="progress">
                    <div class="progress-bar" style="width: 100%"></div>
                </div>
                <!--                <span class="progress-description">-->
                <!--                    100% Increase in 30 Days-->
                <!--                  </span>-->
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
	*/ ?>
    <div class="col-md-4">
        <div class="info-box bg-aqua">
            <span class="info-box-icon"><i class="fa fa-money"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Total Nilai Perolehan</span>
                <span class="info-box-number"><?php echo number_format($TOTAL_NILAI_PEROLEHAN,0); ?></span>

                <div class="progress">
                    <div class="progress-bar" style="width: 100%"></div>
                </div>
                <!--                <span class="progress-description">-->
                <!--                    100% Increase in 30 Days-->
                <!--                  </span>-->
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->
