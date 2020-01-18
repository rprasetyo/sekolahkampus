<?php

namespace app\modules\api\models;

use app\common\dbcon\SessionActiveRecord;

/**
 * This is the model class for table "abs_absence".
 *
 * @property string $id_abs_absence
 * @property string $tgl_scan
 * @property string $waktu_scan
 * @property string $rfid_card
 * @property int $id_status_scan
 * @property string $id_pegawai
 * @property int $id_abs_type
 * @property int $id_device
 */
//class AbsAbsence extends LodgeActiveRecord
class AbsAbsence extends SessionActiveRecord
//class AbsAbsence extends \yii\db\ActiveRecord
//class AbsAbsence extends \app\common\dbcon\LodgeActiveRecord
{
    const SCENARIO_CREATE = 'create';

    public static $connection;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'abs_absence';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tgl_scan', 'rfid_card', 'id_status_scan', 'id_pegawai', 'id_abs_type', 'id_device'], 'required'],
            [['tgl_scan', 'waktu_scan'], 'safe'],
            [['id_status_scan', 'id_pegawai', 'id_abs_type', 'id_device'], 'integer'],
            [['rfid_card'], 'string', 'max' => 64],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_abs_absence' => 'Id Abs Absence',
            'tgl_scan' => 'Tgl Scan',
            'waktu_scan' => 'Waktu Scan',
            'rfid_card' => 'Rfid Card',
            'id_status_scan' => 'Id Status Scan',
            'id_pegawai' => 'Id Pegawai',
            'id_abs_type' => 'Id Abs Type',
            'id_device' => 'Id Device',
        ];
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['create'] = ['rfid_card', 'id_abs_type', 'id_device'];
        return $scenarios;
    }

}
