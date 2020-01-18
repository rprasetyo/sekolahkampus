<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sensor_warning_parameter".
 *
 * @property int $id_sensor_warning_parameter
 * @property int $parameter_number
 * @property string $label
 * @property double $batas_bawah
 * @property double $batas_atas
 * @property int $need_warning
 * @property string $color_label
 * @property string $description
 */
class SensorWarningParameter extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sensor_warning_parameter';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['parameter_number', 'label', 'batas_bawah', 'batas_atas', 'need_warning'], 'required'],
            [['parameter_number', 'need_warning'], 'integer'],
            [['batas_bawah', 'batas_atas'], 'number'],
            [['label'], 'string', 'max' => 150],
            [['color_label'], 'string', 'max' => 50],
            [['description'], 'string', 'max' => 250],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_sensor_warning_parameter' => 'Id Sensor Warning Parameter',
            'parameter_number' => 'Parameter Number',
            'label' => 'Label',
            'batas_bawah' => 'Batas Bawah',
            'batas_atas' => 'Batas Atas',
            'need_warning' => 'Need Warning',
            'color_label' => 'Color Label',
            'description' => 'Description',
        ];
    }
}
