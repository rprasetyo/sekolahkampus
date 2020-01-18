<?php

namespace app\modules\api\models;

use Yii;

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
class AbsAbsence2 extends \yii\db\ActiveRecord
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
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
//            'timestamp' => [
//                'class' => 'yii\behaviors\TimestampBehavior',
//                'attributes' => [
//                    ActiveRecord::EVENT_BEFORE_INSERT => ['waktu_scan'],
////                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
//                ],
//                'value' => function () {
//                    return date('U');
//                }
//            ],
//            'class' => TimestampBehavior::className(),
//            'createdAtAttribute' => 'create_time',
//            'updatedAtAttribute' => 'update_time',
//            'value' => new Expression('NOW()'),
        ];
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

    public static function getDb()
    {
        $session = Yii::$app->session;

        $companyid = $session->get('id_perusahaan');

        $lodgedb = 'company' . $companyid;

        $connection = new \yii\db\Connection([
            'dsn' => 'mysql:host=localhost;dbname=' . $lodgedb,
            'username' => Yii::$app->params['dbuser'],
            'password' => Yii::$app->params['dbpasswd'],
            'charset' => 'utf8',
        ]);
        $connection->open(); // not sure if this is necessary at this point
        Yii::$app->params['dbs'][$lodgedb] = $connection;
        return $connection;
    }

}
