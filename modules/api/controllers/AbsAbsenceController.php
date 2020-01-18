<?php

namespace app\modules\api\controllers;

use app\common\helpers\KehadiranKaryawanHelper;
use app\common\helpers\Timeanddate;
use app\models\AbsDevicePerusahaan;
use app\models\HrmPegawai;
use app\modules\api\models\AbsAbsence;
use app\modules\api\models\KartuRfid;
use Yii;

class AbsAbsenceController extends \yii\web\Controller
{

    public $enableCsrfValidation = false;

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionCreateEntryOri()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $absence = new AbsAbsence();
        $absence->scenario = AbsAbsence::SCENARIO_CREATE;
        $absence->attributes = \Yii::$app->request->post();

        $kartu = KartuRfid::findOne([
            'rfid_number' => $absence->rfid_card,
        ]);

        if (is_null($kartu)) {
            $absence->id_pegawai = 0;
        } else {
            $absence->id_pegawai = $kartu->id_pegawai;
        }


        if ($absence->validate()) {
            $absence->save();
//            return array('status' => true, 'data' => 'Log Absence created successfully.', 'value_id_pegawai' => $absence->id_pegawai);
            return array('status' => true, 'data' => 'Log Absence created successfully.');
        } else {
            return array('status' => false, 'data' => $absence->getErrors());
        }
    }

    public function actionCreateEntry()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $absence = new AbsAbsence();
        $absence->scenario = AbsAbsence::SCENARIO_CREATE;
        $absence->attributes = \Yii::$app->request->post();

        $device = AbsDevicePerusahaan::findOne([
            'id_device' => $absence->id_device,
        ]);

        // get id perusahaan dari data post
        $idperusahaan = $device->id_perusahaan;

        // membuat session dan memasukan idperusahaan pada session
        $session = Yii::$app->session;
        $session->set('id_perusahaan', $idperusahaan);

        $kartu = KartuRfid::findOne([
            'rfid_number' => $absence->rfid_card,
        ]);

        // cek kartu rfid
        if (is_null($kartu)) {
            $absence->id_pegawai = 0;
        } else {
            $absence->id_pegawai = $kartu->id_pegawai;
        }

        $absence->tgl_scan = Timeanddate::getCurrentDate();
        $absence->waktu_scan = Timeanddate::getCurrentTime();

        $karyawan = HrmPegawai::findOne(['id_pegawai' => $absence->id_pegawai,]);

        switch ($absence->id_abs_type) {
            case 'B4':
                KehadiranKaryawanHelper::absenMasuk($karyawan->NIP);
                $absence->id_abs_type = 1;
                break;
            case 'B3':
                KehadiranKaryawanHelper::absenIjinKeluar($karyawan->NIP);
                $absence->id_abs_type = 2;
                break;
            case 'B2':
                KehadiranKaryawanHelper::absenKembaliIjin($karyawan->NIP);
                $absence->id_abs_type = 3;
                break;
            case 'B1':
                KehadiranKaryawanHelper::absenPulang($karyawan->NIP);
                $absence->id_abs_type = 4;
                break;
            default:
                $absence->id_abs_type = 0;
                break;
        }

        if ($absence->validate()) {
            $absence->save();
            return array('status' => true, 'data' => 'Log Absence created successfully.');
        } else {
            return array('status' => false, 'data' => $absence->getErrors());
        }

    }

    public function actionListAbsence()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $absence = AbsAbsence::find()->all();

        if (count($absence) > 0) {
            return array('status' => true, 'data' => $absence);
        } else {
            return array('status' => false, 'data' => 'No logs found.');
        }
    }

}
