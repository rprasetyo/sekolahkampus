<?php
/**
 * Created by PhpStorm.
 * User: Dany Panggabean
 * Date: 04/03/2019
 * Time: 16:25
 */

namespace app\common\helpers;


use app\models\AbsAbsence;
use app\models\AbsKehadiranKaryawan;
use app\models\AbsRekapHarian;

class RekapHelper
{
    public static function getRekapToday()
    {


//$tglskrg = '2019-03-05';
        $tglskrg = Timeanddate::getCurrentDate();
        $queryRes = AbsAbsence::find()
            ->select(['COUNT(id_abs_type) AS cnt, id_abs_type'])
            ->where('tgl_scan = "' . $tglskrg . '"')
            ->groupBy('id_abs_type')
            ->createCommand()
            ->queryAll();

//echo $rekapCount[0];
        $listRekap = array();
        $listRekap["sudah_presensi"] = 0;
        $listRekap["ijin_keluar"] = 0;
        $listRekap["kembali_ijin"] = 0;
        $listRekap["pulang"] = 0;
        foreach ($queryRes as $results) {
//    echo $results['id_abs_type'] . "=";
//    echo $results['cnt'] . '<br>';
            switch ($results['id_abs_type']) {
                case 1:
                    $listRekap["sudah_presensi"] = $results['cnt'];
                    break;
                case 2:
                    $listRekap["ijin_keluar"] = $results['cnt'];
                    break;
                case 3:
                    $listRekap["kembali_ijin"] = $results['cnt'];
                    break;
                case 4:
                    $listRekap["pulang"] = $results['cnt'];
                    break;
            }
        }

        $rekap = \app\models\AbsRekapHarian::find()->where(['tgl_absensi' => $tglskrg])->one();
        if ($rekap == null) {
            $rekap = new \app\models\AbsRekapHarian();
        }
        $rekap->tgl_absensi = $tglskrg;
        $rekap->jml_sdh_presensi = $listRekap["sudah_presensi"];
        $rekap->jml_ijin_keluar = $listRekap["ijin_keluar"] - $listRekap["kembali_ijin"];
        $rekap->jml_pulang = $listRekap["pulang"];
        $rekap->jml_pegawai_total = \app\models\HrmPegawai::find()->where(['reg_status_pegawai' => 'AKTIF'])->count();
        $rekap->jml_pegawai_harus_hadir = $rekap->jml_pegawai_total;
        $rekap->jml_blm_presensi = $rekap->jml_pegawai_harus_hadir - $rekap->jml_sdh_presensi;
        $rekap->jml_ada_di_kantor = $rekap->jml_sdh_presensi - $rekap->jml_ijin_keluar - $rekap->jml_pulang;

        $rekap->save(false);

//*/
//echo 'disini';

    }

    public static function getRekapDaily()
    {

        $tglskrg = Timeanddate::getCurrentDate();

        $rekap = \app\models\AbsRekapHarian::find()->where(['tgl_absensi' => $tglskrg])->one();
        if ($rekap == null) {
            $rekap = new \app\models\AbsRekapHarian();
        }

        // tanggal absensi
        $rekap->tgl_absensi = $tglskrg;
        $rekap->bln_absensi = Timeanddate::getCurrentMonth();
        $rekap->thn_absensi = Timeanddate::getCurrentYear();

        // pegawai harus hadir
        $ijinTidakMasukList = AbsKehadiranKaryawan::find()
            ->where(['status' => ['cuti', 'sakit', 'izin']])
            ->andWhere(['tanggal' => $tglskrg])
            ->count();
        $rekap->jml_ijin_tidak_masuk = $ijinTidakMasukList;

        // pegawai harus hadir
        $kehadiranList = AbsKehadiranKaryawan::find()
            ->where(['status' => 'aktif'])
            ->andWhere(['tanggal' => $tglskrg])
            ->count();
        $rekap->jml_pegawai_harus_hadir = $kehadiranList;

        // sudah presensi
        $sdhPresensi = AbsKehadiranKaryawan::find()
            ->where(['tanggal' => $tglskrg])
            ->andWhere(['status_hadir' => 1])
            ->count();
        $rekap->jml_sdh_presensi = $sdhPresensi;

        // terlambat presensi
        $terlambat = AbsKehadiranKaryawan::find()
            ->where(['tanggal' => $tglskrg])
            ->andWhere(['status_terlambat' => 1])
            ->count();
        $rekap->jml_terlambat = $terlambat;

        // ijin keluar
        $ijinKeluar = AbsKehadiranKaryawan::find()
            ->where(['tanggal' => $tglskrg])
            ->andWhere(['status_keluar' => 1])
            ->count();
        $rekap->jml_ijin_keluar = $ijinKeluar;

        // sudah pulang
        $pulang = AbsKehadiranKaryawan::find()
            ->where(['tanggal' => $tglskrg])
            ->andWhere(['status_pulang' => 1])
            ->count();
        $rekap->jml_pulang = $pulang;

        // belum presensi
        $rekap->jml_blm_presensi = $kehadiranList - $sdhPresensi;

        // jumlah ada di kantor
        $rekap->jml_ada_di_kantor = $sdhPresensi - $ijinKeluar - $pulang;

        // jumlah pegawai total
        $rekap->jml_pegawai_total = \app\models\HrmPegawai::find()->where(['reg_status_pegawai' => 'AKTIF'])->count();


        $rekap->save(false);

    }

    public static function getRekapBulanan($bln, $thn)
    {
        $bulanan = AbsRekapHarian::find()
            ->where(['bln_absensi' => $bln])
            ->andWhere(['thn_absensi' => $thn])
            ->all();

        return $bulanan;
    }
}