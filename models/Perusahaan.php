<?php

namespace app\models;

/**
 * This is the model class for table "perusahaan".
 *
 * @property int $id_perusahaan
 * @property string $security_code
 * @property string $qrcode_perusahaan
 * @property string $nama_perusahaan
 * @property string $alamat
 * @property string $email1
 * @property string $email2
 * @property int $phone1
 * @property int $phone2
 * @property string $media_sosial1
 * @property string $media_sosial2
 * @property string $media_sosial3
 * @property int $status
 */
class Perusahaan extends \yii\db\ActiveRecord
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 1;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'perusahaan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama_perusahaan', 'alamat', 'email1', 'phone1', 'status'], 'required'],
            [['security_code', 'phone1', 'phone2', 'status'], 'integer'],
            [['qrcode_perusahaan', 'nama_perusahaan', 'alamat', 'email1', 'email2', 'media_sosial1', 'media_sosial2', 'media_sosial3'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_perusahaan' => 'Id Perusahaan',
            'security_code' => 'Security Code',
            'qrcode_perusahaan' => 'Qrcode Perusahaan',
            'nama_perusahaan' => 'Nama Perusahaan',
            'alamat' => 'Alamat',
            'email1' => 'Email1',
            'email2' => 'Email2',
            'phone1' => 'Phone1',
            'phone2' => 'Phone2',
            'media_sosial1' => 'Media Sosial1',
            'media_sosial2' => 'Media Sosial2',
            'media_sosial3' => 'Media Sosial3',
            'status' => 'Status',
        ];
    }

    public function getNameOfStatus()
    {
        return ($this->status == self::STATUS_ACTIVE) ? 'ACTIVE' : 'INACTIVE';
    }
}
