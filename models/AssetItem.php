<?php

namespace app\models;

use yii\web\UploadedFile;

/**
 * This is the model class for table "asset_item".
 *
 * @property int $id_asset_item
 * @property int $id_asset_master
 * @property string $number1
 * @property string $number2
 * @property string $number3
 * @property string $picture1
 * @property string $picture2
 * @property string $picture3
 * @property string $picture4
 * @property string $picture5
 * @property string $caption_picture1
 * @property string $caption_picture2
 * @property string $caption_picture3
 * @property string $caption_picture4
 * @property string $caption_picture5
 * @property string $label1
 * @property string $label2
 * @property string $label3
 * @property string $label4
 * @property string $label5
 * @property int $id_asset_received
 * @property int $id_asset_item_location
 * @property int $id_type_asset_item1
 * @property int $id_type_asset_item2
 * @property int $id_type_asset_item3
 * @property int $id_type_asset_item4
 * @property int $id_type_asset_item5
 */
class AssetItem extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
	 
	//Untuk Backup gambar yang sudah pernah diupload
	public $temp_picture1; 
	public $temp_picture2; 
	public $temp_picture3; 
	public $temp_picture4; 
	public $temp_picture5; 
	
    public static function tableName()
    {
        return 'asset_item';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_asset_master', 'id_asset_received', 'id_asset_item_location'], 'required'],
            [['id_asset_master', 'id_asset_received', 'id_asset_item_location',
                'id_type_asset_item1', 'id_type_asset_item2', 'id_type_asset_item3',
                'id_type_asset_item4', 'id_type_asset_item5','number2'], 'integer'],
            [['number1', 'number3', 'picture2', 'picture3', 'picture4', 'picture5', 'label1', 'label2', 'label3', 'label4', 'label5'], 'string', 'max' => 250],
			[['caption_picture1', 'caption_picture2', 'caption_picture3', 'caption_picture4', 'caption_picture5'], 'string', 'max' => 250],
            [['picture1', 'picture2', 'picture3', 'picture4', 'picture5'], 'file', 'skipOnEmpty' => true, 'extensions' => 'jpg, jpeg, png, gif'],
            [['file1'], 'file', 'skipOnEmpty' => true, 'extensions' => 'pdf'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_asset_item' => 'Id Asset Item',
            'id_asset_master' => 'Nama Barang',
            'number1' => 'NUP',
            'number2' => 'No Urut',
            'number3' => 'Number 3',
            'picture1' => 'Picture 1',
            'picture2' => 'Picture 2',
            'picture3' => 'Picture 3',
            'file1' => 'File 1',
            'file2' => 'File 2',
            'label1' => 'Pengamanan',
            'label2' => 'Keterangan',
            'label3' => 'Label 3',
            'label4' => 'Label 4',
            'label5' => 'Label 5',
            'id_asset_received' => 'Asset Received',
            'id_asset_item_location' => 'Asset Item Location',
            'id_type_asset_item1' => 'Type',
            'id_type_asset_item2' => 'Status',
            'id_type_asset_item3' => 'Id Type Asset Item3',
            'id_type_asset_item4' => 'Id Type Asset Item4',
            'id_type_asset_item5' => 'Id Type Asset Item5',
            // 'id_sensor' => 'Nama Sensor',
        ];
    }

    public function getAssetMaster()
    {
        return $this->hasOne(AssetMaster::className(), ['id_asset_master' => 'id_asset_master']);
    }

    public function getAssetReceived()
    {
        return $this->hasOne(AssetReceived::className(), ['id_asset_received' => 'id_asset_received']);
    }

    public function getAssetItemLocation()
    {
        return $this->hasOne(AssetItemLocation::className(), ['id_asset_item_location' => 'id_asset_item_location']);
    }

    public function getAssetItemType1()
    {
        return $this->hasOne(TypeAssetItem1::className(), ['id_type_asset_item' => 'id_type_asset_item1']);
    }

    public function getAssetItemType2()
    {
        return $this->hasOne(TypeAssetItem2::className(), ['id_type_asset_item' => 'id_type_asset_item2']);
    }
    // public function getSensor()
    // {
    //     return $this->hasOne(Sensor::className(), ['id_sensor' => 'id_sensor']);
    // }
	
	public function backupNameOldPicture(){
		$this->temp_picture1 = $this->picture1;
		$this->temp_picture2 = $this->picture2;
		$this->temp_picture3 = $this->picture3;
		$this->temp_picture4 = $this->picture4;
		$this->temp_picture5 = $this->picture5;
	}
	
	public function reloadOldPictureName(){
		$this->picture1 = $this->temp_picture1;
		$this->picture2 = $this->temp_picture2;
		$this->picture3 = $this->temp_picture3;
		$this->picture4 = $this->temp_picture4;
		$this->picture5 = $this->temp_picture5;
		$this->save(false);
	}

    public function upload()
    {
        if ($this->validate()) {
//            *Disimpan dengan nama berbeda */
			/*
            $uploadedFile = UploadedFile::getInstance($this, 'picture1');
            if (!empty($uploadedFile)) {
                //Model Penamaan dengan tanggal
                //$this->filename = strtotime(Timeanddate::getCurrentDateTime()) . '-' .$uploadedFile;
                //Model Penamaan dengan mempertahankan nama aslinya
//                $this->filename = $this->id_sa_offline."_". $uploadedFile->baseName . '.' . $uploadedFile->extension;
//                Model Penamaan dengan default name dan id saja (agar kalau ada file baru langsung timpa di ID yang sama)
                $this->picture1 = "asset_item" . $this->id_asset_item . '.' . $uploadedFile->extension;
                $uploadedFile->saveAs('../web/images/asset_item/' . $this->picture1);
                $this->save(false);
            }
			*/
			
			//Direload dulu nama yang lama
			$this->reloadOldPictureName();
			
			//Dilakukan looping untuk pengecekan lagi
			for($i=1;$i<=5;$i++){
				$fieldname = "picture".$i;
				$uploadedFile = UploadedFile::getInstance($this, $fieldname);
				
				if (!empty($uploadedFile)) {
					/*Model Penamaan dengan tanggal*/
					//$this->filename = strtotime(Timeanddate::getCurrentDateTime()) . '-' .$uploadedFile;
					/*Model Penamaan dengan mempertahankan nama aslinya*/
	//                $this->filename = $this->id_sa_offline."_". $uploadedFile->baseName . '.' . $uploadedFile->extension;
	//                Model Penamaan dengan default name dan id saja (agar kalau ada file baru langsung timpa di ID yang sama)
					$this->$fieldname = "asset_item_".$fieldname.'_'. $this->id_asset_item . '.' . $uploadedFile->extension;
					$uploadedFile->saveAs('../web/images/asset_item/' . $this->$fieldname);
					$this->save(false);
				}
			}
			
            return true;
        } else {
            return false;
        }
    }
	
	

    public function uploadFile()
    {
        if ($this->validate()) {
//            *Disimpan dengan nama berbeda */
            $uploadedFile = UploadedFile::getInstance($this, 'file1');
            if (!empty($uploadedFile)) {
                /*Model Penamaan dengan tanggal*/
                //$this->filename = strtotime(Timeanddate::getCurrentDateTime()) . '-' .$uploadedFile;
                /*Model Penamaan dengan mempertahankan nama aslinya*/
//                $this->filename = $this->id_sa_offline."_". $uploadedFile->baseName . '.' . $uploadedFile->extension;
//                Model Penamaan dengan default name dan id saja (agar kalau ada file baru langsung timpa di ID yang sama)
                $this->file1 = "asset_item" . $this->id_asset_item . '.' . $uploadedFile->extension;
                $uploadedFile->saveAs('../web/images/asset_item/' . $this->file1);
                $this->save(false);
            }
            return true;
        } else {
            return false;
        }
    }
    public function uploadManualFile()
    {
        if ($this->validate()) {
            $uploadedFile = UploadedFile::getInstance($this, 'file1');
            if (!empty($uploadedFile)) {
                $this->file1 = "file_asset_".$this->id_asset_item.'.' . $uploadedFile->extension;
                $uploadedFile->saveAs('../web/images/asset_file/' . $this->file1);
                $this->save(false);
            }
            return true;
        } else {
            return false;
        }
    }
	
	
	private $statusRecordingIsNew = false; 
	private $modelBeforeSave = null;
	public function beforeSave($insert){
		if($this->isNewRecord){
			$this->statusRecordingIsNew = true;
			//echo "baru"; exit();
		}else{
			$related_id = $this->id_asset_item;
			$this->statusRecordingIsNew = false;
			if($this->id_asset_item > 0){
				//echo "update"; exit();
				$this->modelBeforeSave = AssetItem::findOne($this->id_asset_item);
			}
			//echo "Update". $related_id; exit();
		}
		return true;
	}
	
	public function afterSave($isNew, $old) {
		//if ($isNew){  
		if($this->statusRecordingIsNew){
			//$this->isNewRecord
			$tableName = $this::tableName();
			$id_activity = 1; //1 = CREATE
			$related_id = $this->id_asset_item;
			$add_info = "";
			//echo "create"; exit();
		    LogActivity::insertNewLogActivity($tableName, $id_activity, $related_id, $this, $add_info);
            return true;   
		}
		else{
			//Update
			//echo "update"; exit();
			$tableName = $this::tableName();
			$id_activity = 3; //1 = CREATE
			$related_id = $this->id_asset_item;
			if($this->modelBeforeSave != null){
				$add_info1 = serialize($this->modelBeforeSave);
			}else{
				//$add_info1 = "";
			}
			$add_info2 = serialize($this);
			LogActivity::insertNewLogActivity($tableName, $id_activity, $related_id, $this, $add_info1, $add_info2);
			return true;
		}
    }
   
    public function beforeDelete(){
	   $tableName = $this::tableName();
	   $id_activity = 4; //4 = DELETE
	   $related_id = $this->id_asset_item;
	   $add_info = serialize($this);
	   
	   //Untuk mengecek obyeknya kembali
	   //$modeldelete = unserialize($add_info);
	   //echo $modeldelete->id_asset_item." "; exit();
	   
	   LogActivity::insertNewLogActivity($tableName, $id_activity, $related_id, $this, $add_info);
	   
	   return true;
    }
}
