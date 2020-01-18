<?php
/**
 * Created by PhpStorm.
 * User: Dany Panggabean
 * Date: 26/03/2019
 * Time: 11:27
 */

namespace app\common\helpers;


use app\models\AbsKehadiranKaryawan;
use app\models\HrmPegawai;

class KehadiranKaryawanHelper
{
    public static function generateDaily()
    {
        $karyawanArray = HrmPegawai::find()->all();

        foreach ($karyawanArray as $karyawan) {
            $nip = $karyawan->NIP;

            $kehadiran = AbsKehadiranKaryawan::find()
                ->where(['NIP' => $nip])
                ->andWhere(['tanggal' => Timeanddate::getCurrentDate()])
                ->one();

            if ($kehadiran == null) {
//                echo $nip . 'null';
                $kehadiran = new AbsKehadiranKaryawan();

                $kehadiran->NIP = $nip;
                $kehadiran->tanggal = Timeanddate::getCurrentDate();
                $kehadiran->bulan = Timeanddate::getCurrentMonth();
                $kehadiran->tahun = Timeanddate::getCurrentYear();
                $kehadiran->status = 'aktif';
                $kehadiran->status_hadir = 0;
                $kehadiran->status_keluar = 0;
                $kehadiran->status_terlambat = 0;
                $kehadiran->status_pulang = 0;

//                $kehadiran->status_hadir = 1;
//                $kehadiran->status_pulang = 1;
//                $kehadiran->jam_masuk = '07:30:25';
//                $kehadiran->jam_pulang = '17:02:22';
            }

            $kehadiran->save();
        }
    }

    public static function cekKehadiranHarian()
    {

        $karyawanArray = HrmPegawai::find()->all();
        $kehadiranArray = AbsKehadiranKaryawan::find()
            ->where(['tanggal' => Timeanddate::getCurrentDate()])
            ->all();
//        echo sizeof($karyawanArray) . ' ' . sizeof($kehadiranArray);

        return ($kehadiranArray == $karyawanArray ? true : false);
    }

    public static function ajukanCuti($nip, $tanggal)
    {
        $karyawan = HrmPegawai::find()->where(['NIP' => $nip])->one();

        $kehadiran = AbsKehadiranKaryawan::find()
            ->where(['nip' => $karyawan->NIP])
            ->andWhere(['tanggal' => $tanggal])
            ->one();

        if ($kehadiran == null) {

            $kehadiran = new AbsKehadiranKaryawan();

            $kehadiran->NIP = $nip;
            $kehadiran->tanggal = $tanggal;
            $kehadiran->status = 'cuti';
            $kehadiran->status_hadir = 0;
            $kehadiran->status_keluar = 0;
            $kehadiran->status_terlambat = 0;
            $kehadiran->status_pulang = 0;
        }

        $kehadiran->save();
    }

    public static function absenMasuk($nip)
    {
        if (!self::cekKehadiranHarian()) {
            KehadiranKaryawanHelper::generateDaily();
        }

        $kehadiran = AbsKehadiranKaryawan::find()
            ->where(['NIP' => $nip])
            ->andWhere(['tanggal' => Timeanddate::getCurrentDate()])
            ->andWhere(['status_pulang' => 0])
            ->one();


        if ($kehadiran != null) {

            $kehadiran->status_hadir = 1;
            $kehadiran->jam_masuk = Timeanddate::getCurrentTime();

            if ($kehadiran->jam_masuk = '08:00:00') {
                $kehadiran->status_terlambat = 1;
            }

//            echo($kehadiran->jam_masuk - '08:00:00');

            if ($kehadiran->validate()) {
                $kehadiran->save();
            }
        }
    }

    public static function absenPulang($nip)
    {
        if (!self::cekKehadiranHarian()) {
            KehadiranKaryawanHelper::generateDaily();
        }

        $kehadiran = AbsKehadiranKaryawan::find()
            ->where(['NIP' => $nip])
            ->andWhere(['tanggal' => Timeanddate::getCurrentDate()])
            ->andWhere(['status_hadir' => 1])
            ->one();

        if ($kehadiran != null) {
            $kehadiran->status_pulang = 1;
            $kehadiran->jam_pulang = Timeanddate::getCurrentTime();

            if ($kehadiran->validate()) {
                $kehadiran->save();
            }
        }
    }

    public static function absenIjinKeluar($nip)
    {
        $kehadiran = AbsKehadiranKaryawan::find()
            ->where(['NIP' => $nip])
            ->andWhere(['tanggal' => Timeanddate::getCurrentDate()])
            ->andWhere(['status_hadir' => 1])
            ->andWhere(['status_pulang' => 0])
            ->one();

        if ($kehadiran != null) {
            $kehadiran->status_keluar = 1;

            if ($kehadiran->validate()) {
                $kehadiran->save();
            }
        }
    }

    public static function absenKembaliIjin($nip)
    {
        $kehadiran = AbsKehadiranKaryawan::find()
            ->where(['NIP' => $nip])
            ->andWhere(['tanggal' => Timeanddate::getCurrentDate()])
            ->andWhere(['status_keluar' => 1])
            ->one();
        if ($kehadiran != null) {
            $kehadiran->status_keluar = 0;

            if ($kehadiran->validate()) {
                $kehadiran->save();
            }
        }
    }

    public static function overwriteYear()
    {
        $data = AbsKehadiranKaryawan::find()->all();

        foreach ($data as $item) {
            $item->tahun = 2019;
            $item->save();
        }
    }

    public static function overwriteMonth()
    {
        $data = AbsKehadiranKaryawan::find()->all();

        foreach ($data as $item) {
            $tanggal = $item->tanggal;
            $bulan = explode('-', $tanggal)[1];
//            echo $bulan;
//            break;
            $item->bulan = $bulan;
            $item->save();
        }
    }
}