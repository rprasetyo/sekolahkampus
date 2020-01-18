<?php

namespace app\modules\api\models;

use app\common\dbcon\SessionActiveRecord;
use app\models\HrmPegawai;

/**
 * This is the model class for table "kartu_rfid".
 *
 * @property string $id_kartu_rfid
 * @property string $rfid_number
 * @property string $status
 * @property string $is_map_to_member
 * @property string $id_pegawai
 * @property int $keterangan
 *
 * @property HrmPegawai $pegawai
 */
//class KartuRfid extends \yii\db\ActiveRecord
//class KartuRfid extends \app\common\dbcon\LodgeActiveRecord
class KartuRfid extends SessionActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public
    static function tableName()
    {
        return 'kartu_rfid';
    }

    /**
     * {@inheritdoc}
     */
    public
    function rules()
    {
        return [
            [['rfid_number', 'status'], 'required'],
            [['status', 'is_map_to_member'], 'string'],
            [['keterangan', 'id_pegawai'], 'integer'],
            [['rfid_number'], 'string', 'max' => 40],
            [['id_pegawai'], 'exist', 'skipOnError' => true, 'targetClass' => HrmPegawai::className(), 'targetAttribute' => ['id_pegawai' => 'id_pegawai']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public
    function attributeLabels()
    {
        return [
            'id_kartu_rfid' => 'Id Kartu Rfid',
            'rfid_number' => 'Rfid Number',
            'status' => 'Status',
            'is_map_to_member' => 'Terpakai ke Pegawai',
            'id_pegawai' => 'Nama Pegawai',
//            'nama_pegawai' => 'Nama Pegawai',
            'keterangan' => 'Keterangan',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public
    function getPegawai()
    {
        return $this->hasOne(HrmPegawai::className(), ['id_pegawai' => 'id_pegawai']);
    }


}
