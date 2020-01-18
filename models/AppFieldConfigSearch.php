<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AppFieldConfig;
use app\common\helpers\TypeFieldEnum;
use app\common\labeling\CommonActionLabelEnum;

/**
 * AppFieldConfigSearch represents the model behind the search form of `app\models\AppFieldConfig`.
 */
class AppFieldConfigSearch extends AppFieldConfig
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_app_field_config', 'no_order', 'is_visible', 'is_required', 'is_unique', 'is_safe', 'type_field', 'max_field'], 'integer'],
            [['classname', 'fieldname', 'label', 'default_value', 'pattern', 'image_extensions', 'image_max_size'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = AppFieldConfig::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_app_field_config' => $this->id_app_field_config,
            'no_order' => $this->no_order,
            'is_visible' => $this->is_visible,
            'is_required' => $this->is_required,
            'is_unique' => $this->is_unique,
            'is_safe' => $this->is_safe,
            'type_field' => $this->type_field,
            'max_field' => $this->max_field,
			//'varian_group' => $this->varian_group,
        ]);

        $query->andFilterWhere(['=', 'classname', $this->classname])
			->andFilterWhere(['=', 'varian_group', $this->varian_group])
            ->andFilterWhere(['like', 'fieldname', $this->fieldname])
            ->andFilterWhere(['like', 'label', $this->label])
            ->andFilterWhere(['like', 'default_value', $this->default_value])
            ->andFilterWhere(['like', 'pattern', $this->pattern])
            ->andFilterWhere(['like', 'image_extensions', $this->image_extensions])
            ->andFilterWhere(['like', 'image_max_size', $this->image_max_size]);

        return $dataProvider;
    }
	
	public static function getRules($tableNames){
		/*
        return [
            [['asset_name', 'asset_code'], 'required'],
            [['id_asset_code', 'id_type_asset1', 'id_type_asset2', 'id_type_asset3', 'id_type_asset4', 'id_type_asset5'], 'integer'],
            [['asset_name', 'attribute1', 'attribute2', 'attribute3', 'attribute4', 'attribute5'], 'string', 'max' => 250],
            [['asset_code'], 'string', 'max' => 150],
        ];
		*/
		$res = array();
		
		//A. Required
		$datas= AppFieldConfig::find()
                ->where(['classname' => $tableNames, 'is_required'=>1])
				->all();
		$fieldRequired = array();
		foreach($datas as $data){
			//echo $data->fieldname."<br>";
			$fieldRequired[] = $data->fieldname;
		}
		$rulesrequired = [$fieldRequired, 'required'];
		$res[] = $rulesrequired;
		
		//B. Integer
		$datas= AppFieldConfig::find()
                ->where(['classname' => $tableNames, 'type_field'=>TypeFieldEnum::TYPE_INTEGER])
				->all();
		$fieldInteger = array();
		foreach($datas as $data){
			//echo $data->fieldname."<br>";
			$fieldInteger[] = $data->fieldname;
		}
		$rulesinteger = [$fieldInteger, 'integer'];
		$res[] = $rulesinteger;
		
		//C. String with Max
		$datas= AppFieldConfig::find()
                ->where([
					'classname' => $tableNames, 
					//'type_field'=>TypeFieldEnum::TYPE_STRING
				])
				->all();
		$fieldInteger = array();
		foreach($datas as $data){
			if($data->max_field > 0){
				$max = $data->max_field;
			}else{
				$max = 250; //Default
			}
			
			if($data->type_field == TypeFieldEnum::TYPE_STRING){
				$rulestring = [[$data->fieldname], 'string', 'max'=>$max];
				$res[] = $rulestring;
			}
			/*
			if($data->type_field == TypeFieldEnum::TYPE_INTEGER){
				$rulestring = [[$data->fieldname], 'number', 'max'=>$max];
				$res[] = $rulestring;
			}
			*/
		}
		
		
		return $res;
	}
	
	public static function getLabels($tableNames, $varian_group=""){
		/*
		return [
            'id_asset_master' => 'Id Asset Master',
            'asset_name' => 'Nama Barang',
            'id_asset_code' => 'Id Asset Code',
            'asset_code' => 'Kode Barang',
            'id_type_asset1' => 'Jenis Aset',
        ];
		*/
		$label = array();
		
		//Label
		/*
		$datas= AppFieldConfig::find()
                ->where(['classname' => $tableNames])
				->all();
		*/
		if($varian_group == ""){
			$datas= AppFieldConfig::find()
                ->where(['classname' => $tableNames,  'varian_group'=>""])
				->orderBy(['no_order'=>SORT_ASC])
				->all();
		}else{
			$datas= AppFieldConfig::find()
                ->where(['classname' => $tableNames, 'varian_group'=>$varian_group])
				->orderBy(['no_order'=>SORT_ASC])
				->all();
		}
		foreach($datas as $data){
			//echo $data->fieldname."<br>";
			if($data->label != ""){
				$label[$data->fieldname] = $data->label;
			}else{
				$label[$data->fieldname] = $data->fieldname;
			}
		}
		//var_dump($label);

		return $label;
	}
	
	public static function getListGridView($tableNames, $varian_group=""){
		$list = array();
		$list[] = ['class' => 'yii\grid\SerialColumn'];
		if($varian_group == ""){
			$datas= AppFieldConfig::find()
                ->where(['classname' => $tableNames, 'is_visible'=>1, 'varian_group'=>""])
				->orderBy(['no_order'=>SORT_ASC])
				->all();
		}else{
			$datas= AppFieldConfig::find()
                ->where(['classname' => $tableNames, 'varian_group'=>$varian_group, 'is_visible'=>1])
				->orderBy(['no_order'=>SORT_ASC])
				->all();
		}
		foreach($datas as $data){
			$list[] = [
						'attribute' => $data->fieldname,
					  ];
		}
		$list[] = ['class' => 'yii\grid\ActionColumn', 'header' => CommonActionLabelEnum::ACTION,];

		return $list;
	}
	
	public static function getListGridViewWithHeader($tableNames, $varian_group=""){
		$list = array();
		$list[] = ['class' => 'yii\grid\SerialColumn'];
		if($varian_group == ""){
			$datas= AppFieldConfig::find()
                ->where(['classname' => $tableNames, 'is_visible'=>1, 'varian_group'=>""])
				->orderBy(['no_order'=>SORT_ASC])
				->all();
		}else{
			$datas= AppFieldConfig::find()
                ->where(['classname' => $tableNames, 'varian_group'=>$varian_group, 'is_visible'=>1])
				->orderBy(['no_order'=>SORT_ASC])
				->all();
		}
		foreach($datas as $data){
			$list[] = [
						'header' => $data->label,
						'attribute' => $data->fieldname,
					  ];
		}
		$list[] = ['class' => 'yii\grid\ActionColumn', 'header' => CommonActionLabelEnum::ACTION,];

		return $list;
	}
	
	public static function replaceListGridViewItem($listGridView, $fieldnameReplace, $columnReplaced){
		foreach($listGridView as $key=>$val){
			//echo $key."=>"."<br>";
			foreach($val as $key2=>$val2){
				//echo $key2."=>".$val2."<br>";
				if($val2 == $fieldnameReplace){
					$listGridView[$key] = $columnReplaced;
					break;
				}
			}
		}
		
		return $listGridView;
	}
	
	public static function getListFormElement($tableNames, $form, $model, $varian_group=""){
		$res = array();
		if($varian_group == ""){
			$datas= AppFieldConfig::find()
                ->where(['classname' => $tableNames, 'is_visible'=>1, 'varian_group'=>""])
				->orderBy(['no_order'=>SORT_ASC])
				->all();
		}else{
			$datas= AppFieldConfig::find()
                ->where(['classname' => $tableNames, 'varian_group'=>$varian_group, 'is_visible'=>1])
				->orderBy(['no_order'=>SORT_ASC])
				->all();
		}
		foreach($datas as $data){
			$fieldname = $data->fieldname;
			
			$res[$fieldname] = $form->field($model, $fieldname)->textInput(['maxlength' => true])->label($data->label);
		}
		
		return $res;
	}
	
	public static function replaceFormElement($listElements, $fieldnameReplace, $elementReplace){
		foreach($listElements as $key=>$val){
			if($key == $fieldnameReplace){
				$listElements[$key] = $elementReplace;
				break;
			}
		}
		
		return $listElements;
	}
	
	public static function getLabelName($tableName, $fieldname, $varian_group=""){
		$list = array();

		if($varian_group != ""){
			$data= AppFieldConfig::find()
                ->where(['classname' => $tableName, 'fieldname'=>$fieldname, 'varian_group'=>$varian_group])
				->one();
			if($data != null){
				return $data->label;
			}
		}
		
		return $fieldname;
	}

	public static function getListDetailView($tableNames, $varian_group=""){
		$list = array();

		if($varian_group == ""){
			$datas= AppFieldConfig::find()
                ->where(['classname' => $tableNames, 'is_visible'=>1, 'varian_group'=>""])
				->orderBy(['no_order'=>SORT_ASC])
				->all();
		}else{
			$datas= AppFieldConfig::find()
                ->where(['classname' => $tableNames, 'varian_group'=>$varian_group, 'is_visible'=>1])
				->orderBy(['no_order'=>SORT_ASC])
				->all();
		}
		foreach($datas as $data){
			$list[] = [
						'attribute' => $data->fieldname,
					  ];
		}

		return $list;
	}
}
