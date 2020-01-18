<?php

namespace app\models;

use Yii;

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
 * @property int $id_asset_received
 * @property int $id_asset_item_location
 * @property int $id_type_asset_item1
 * @property int $id_type_asset_item2
 * @property int $id_type_asset_item3
 * @property int $id_type_asset_item4
 * @property int $id_type_asset_item5
 * @property string $file1
 * @property string $file2
 * @property string $file3
 * @property string $label1
 * @property string $label2
 * @property string $label3
 * @property string $label4
 * @property string $label5
 */
class AssetTracking extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
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
            [['id_asset_master', 'id_asset_received', 'id_asset_item_location', 'id_type_asset_item1', 'id_type_asset_item2', 'id_type_asset_item3', 'id_type_asset_item4', 'id_type_asset_item5'], 'integer'],
            [['number1', 'number2', 'number3', 'picture1', 'picture2', 'picture3', 'picture4', 'picture5', 'caption_picture1', 'caption_picture2', 'caption_picture3', 'caption_picture4', 'caption_picture5', 'file1', 'file2', 'file3', 'label1', 'label2', 'label3', 'label4', 'label5'], 'string', 'max' => 250],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_asset_item' => 'Id Asset Item',
            'id_asset_master' => 'Id Asset Master',
            'number1' => 'Number1',
            'number2' => 'Number2',
            'number3' => 'Number3',
            'picture1' => 'Picture1',
            'picture2' => 'Picture2',
            'picture3' => 'Picture3',
            'picture4' => 'Picture4',
            'picture5' => 'Picture5',
            'caption_picture1' => 'Caption Picture1',
            'caption_picture2' => 'Caption Picture2',
            'caption_picture3' => 'Caption Picture3',
            'caption_picture4' => 'Caption Picture4',
            'caption_picture5' => 'Caption Picture5',
            'id_asset_received' => 'Id Asset Received',
            'id_asset_item_location' => 'Id Asset Item Location',
            'id_type_asset_item1' => 'Id Type Asset Item1',
            'id_type_asset_item2' => 'Id Type Asset Item2',
            'id_type_asset_item3' => 'Id Type Asset Item3',
            'id_type_asset_item4' => 'Id Type Asset Item4',
            'id_type_asset_item5' => 'Id Type Asset Item5',
            'file1' => 'File1',
            'file2' => 'File2',
            'file3' => 'File3',
            'label1' => 'Label1',
            'label2' => 'Label2',
            'label3' => 'Label3',
            'label4' => 'Label4',
            'label5' => 'Label5',
        ];
    }
}
