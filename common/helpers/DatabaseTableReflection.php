<?php
namespace app\common\helpers;

use app\models\AppFieldConfig;
use app\models\AppFieldConfigSearch;
use app\common\helpers\TypeFieldEnum;

class DatabaseTableReflection
{
	/*
	Fungsi Untuk mendapatkan list semua table yang ada di database
	*/
	public static function getListTableName()
    {
		/*
		$rows = (new \yii\db\Query())
			->select(['table_name'])
			->from('information_schema.tables')
			//->where(['last_name' => 'Smith'])
			->where(['table_schema' => 'your_database_name'])
			->limit(10)
			->all();
		*/
		$list_result = array();

		$db = \Yii::$app->db;
		$command = $db->createCommand('SHOW TABLES', [
			//':name' => 'Qiang',
		]);
		$results = $command->queryAll();
		foreach($results as $key=>$data){
			foreach($data as $key2=>$data2){
				//echo "==".$data2."<br>";
				$list_result[$data2] = $data2;
			}
		}
		
		return $list_result;
	}
	
	public static function getListColumnFromTable($tableName)
    {
		$list_result = array();

		$db = \Yii::$app->db;
		$command = $db->createCommand('SHOW COLUMNS FROM '.$tableName, [
			//':name' => 'Qiang',
		]);
		$results = $command->queryAll();
		//echo "<pre>".var_export($results, true)."</pre>";
		foreach($results as $key=>$data){
			if($data['Key'] != "PRI"){
				//echo "==".$data["Field"]."<br>";
				$list_result[$data["Field"]] = $data["Field"];
			}
		}
		
		return $list_result;
	}
	
	public static function saveListColumnFromTable($tableName, $varian="")
    {
		$db = \Yii::$app->db;
		$command = $db->createCommand('SHOW COLUMNS FROM '.$tableName, [
			//':name' => 'Qiang',
		]);
		$results = $command->queryAll();
		//echo "<pre>".var_export($results, true)."</pre>";
		$no=0;
		foreach($results as $key=>$data){
			if($data['Key'] != "PRI"){
				$fieldname = $data["Field"];
				if($varian == ""){
					$model = AppFieldConfig::find()
							->where(['classname' => $tableName, 'fieldname'=>$fieldname])
							->one();
				}else{
					$model = AppFieldConfig::find()
							->where(['classname' => $tableName, 'fieldname'=>$fieldname, 'varian_group'=>$varian])
							->one();
				}
				if($model == null){
					$model = new AppFieldConfig();
					$model->fieldname = $fieldname;
					$model->classname = $tableName;
					if($varian != ""){
						$model->varian_group = $varian;
					}
				}
				
				$model->label = str_replace("_"," ",$fieldname);
				if($data["Null"] == "NO"){
					$model->is_required = 1;
				}else{
					$model->is_required = 0;
				}
				$model->is_visible = 1;
				$no++;
				$model->no_order = $no;
				$model->type_field = DatabaseTableReflection::getTypeOfData($data["Type"]);
				$model->max_field = DatabaseTableReflection::getMaxField($data["Type"]);
				$model->save(false);
				//echo ($model);
			}
		}
	}
	
	public static function getTypeOfData($rawvalue){
		if (strpos(strtolower($rawvalue), 'varchar') !== false) {
			return TypeFieldEnum::TYPE_STRING;
		}
		if (strpos(strtolower($rawvalue), 'text') !== false) {
			return TypeFieldEnum::TYPE_STRING;
		}
		if (strpos(strtolower($rawvalue), 'int') !== false) {
			return TypeFieldEnum::TYPE_INTEGER;
		}
		if (strpos(strtolower($rawvalue), 'double') !== false) {
			return TypeFieldEnum::TYPE_DOUBLE;
		}
		
		return 0;
	}
	
	public static function getMaxField($rawvalue){
		$temp = explode("(",$rawvalue);
		if(count($temp) >= 2){
			$temp2 = explode(")",$temp[1]);
			if(count($temp2) >= 2){
				return intval($temp2[0])*1;
			}
		}
		
		return 0;
	}
	
}