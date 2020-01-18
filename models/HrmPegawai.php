<?php

namespace app\models;

/**
 * This is the model class for table "hrm_pegawai".
 *
 * @property string $id_pegawai
 * @property string $id_perusahaan
 * @property string $userid
 * @property string $cid
 * @property int $no_dossier
 * @property string $NIP
 * @property string $nama_lengkap
 * @property string $foto
 * @property string $tempat_lahir
 * @property string $tanggal_lahir
 * @property int $usia
 * @property int $usia_lebih_bulan
 * @property string $jenis_kelamin
 * @property string $golongan_darah
 * @property int $tinggi_badan
 * @property int $berat_badan
 * @property string $agama
 * @property string $status_pernikahan
 * @property string $no_identitas_pribadi
 * @property string $NPWP
 * @property string $no_kartu_kesehatan
 * @property string $no_kartu_tenagakerja
 * @property string $kartu_kesehatan
 * @property string $no_kartu_keluarga
 * @property string $scan_ktp
 * @property string $scan_bpjs
 * @property string $scan_npwp
 * @property string $scan_paraf
 * @property string $scan_kk
 * @property string $scan_tandatangan
 * @property int $id_hrm_status_pegawai
 * @property int $id_hrm_status_organik
 * @property string $status_tenaga_kerja
 * @property string $reg_tanggal_masuk
 * @property string $reg_tanggal_diangkat
 * @property string $reg_tanggal_training
 * @property string $reg_status_pegawai
 * @property string $tanggal_mpp
 * @property string $tanggal_pensiun
 * @property string $tanggal_terminasi
 * @property int $id_hrm_mst_jenis_terminasi_bi
 * @property string $gelar_akademik
 * @property string $gelar_profesi
 * @property int $pdk_id_tingkatpendidikan
 * @property string $pdk_sekolah_terakhir
 * @property string $pdk_jurusan_terakhir
 * @property string $pdk_ipk_terakhir
 * @property int $pdk_tahun_lulus
 * @property string $alamat_termutakhir
 * @property string $alamat_sesuai_identitas
 * @property string $mobilephone1
 * @property string $mobilephone2
 * @property string $telepon_rumah
 * @property string $fax_rumah
 * @property string $email1
 * @property string $email2
 * @property string $jbt_id_jabatan
 * @property string $jbt_jabatan
 * @property string $jbt_id_tingkat_jabatan
 * @property string $jbt_no_sk_jabatan
 * @property string $jbt_tgl_keputusan
 * @property string $jbt_tanggal_berlaku
 * @property string $jbt_keterangan_mutasi
 * @property int $pkt_id_pangkat
 * @property string $pkt_no_sk
 * @property string $pkt_tgl_keputusan
 * @property string $pkt_tgl_berlaku
 * @property double $pkt_gaji_pokok
 * @property int $pkt_id_jenis_kenaikan_pangkat
 * @property string $pkt_eselon
 * @property string $pkt_ruang
 * @property string $pos_id_hrm_kantor
 * @property string $pos_id_hrm_unit_kerja
 * @property string $pos_kantor
 * @property int $sta_total_hukuman_disiplin
 * @property int $sta_total_penghargaan
 * @property string $pst_masabakti_20
 * @property string $pst_masabakti_25
 * @property string $pst_masabakti_30
 * @property string $pst_masabakti_35
 * @property string $pst_masabakti_40
 * @property string $cuti_besar_terakhir_start
 * @property string $cuti_besar_terakhir_end
 * @property int $cuti_besar_terakhir_ke
 * @property string $cuti_besar_plan_1
 * @property string $cuti_besar_plan_2
 * @property string $cuti_besar_plan_3
 * @property string $cuti_besar_plan_4
 * @property string $cuti_besar_plan_5
 * @property string $cuti_besar_plan_6
 * @property string $cuti_besar_plan_7
 * @property int $cuti_besar_ambil_1
 * @property int $cuti_besar_ambil_2
 * @property int $cuti_besar_ambil_3
 * @property int $cuti_besar_ambil_4
 * @property int $cuti_besar_ambil_5
 * @property int $cuti_besar_ambil_6
 * @property int $cuti_besar_ambil_7
 * @property string $cuti_besar_aktual_1
 * @property string $cuti_besar_aktual_2
 * @property string $cuti_besar_aktual_3
 * @property string $cuti_besar_aktual_4
 * @property string $cuti_besar_aktual_5
 * @property string $cuti_besar_aktual_6
 * @property string $cuti_besar_aktual_7
 * @property string $cuti_besar_aktual_end_1
 * @property string $cuti_besar_aktual_end_2
 * @property string $cuti_besar_aktual_end_3
 * @property string $cuti_besar_aktual_end_4
 * @property string $cuti_besar_aktual_end_5
 * @property string $cuti_besar_aktual_end_6
 * @property string $cuti_besar_aktual_end_7
 * @property string $created_date
 * @property string $created_user
 * @property string $created_ip_address
 * @property string $modified_date
 * @property string $modified_user
 * @property string $modified_ip_address
 */
//class HrmPegawai extends \yii\db\ActiveRecord
class HrmPegawai extends \app\common\dbcon\LodgeActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'hrm_pegawai';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
//            [['id_perusahaan', 'userid', 'cid', 'no_dossier', 'NIP', 'nama_lengkap', 'tempat_lahir', 'tanggal_lahir', 'usia_lebih_bulan', 'jenis_kelamin', 'scan_kk', 'reg_tanggal_training', 'tanggal_terminasi', 'id_hrm_mst_jenis_terminasi_bi', 'email1', 'email2', 'pkt_eselon', 'pkt_ruang', 'pos_kantor', 'sta_total_hukuman_disiplin', 'sta_total_penghargaan', 'cuti_besar_terakhir_start', 'cuti_besar_terakhir_end', 'cuti_besar_terakhir_ke', 'created_date', 'created_user', 'created_ip_address', 'modified_date', 'modified_user', 'modified_ip_address'], 'required'],
            [['NIP', 'nama_lengkap', 'alamat_sesuai_identitas', 'mobilephone1', 'email1', 'jbt_jabatan'], 'required'],
            [['id_perusahaan', 'cid', 'no_dossier', 'usia', 'usia_lebih_bulan', 'tinggi_badan', 'berat_badan', 'id_hrm_status_pegawai', 'id_hrm_status_organik', 'id_hrm_mst_jenis_terminasi_bi', 'pdk_id_tingkatpendidikan', 'pdk_tahun_lulus', 'jbt_id_jabatan', 'jbt_id_tingkat_jabatan', 'pkt_id_pangkat', 'pkt_id_jenis_kenaikan_pangkat', 'pos_id_hrm_kantor', 'pos_id_hrm_unit_kerja', 'sta_total_hukuman_disiplin', 'sta_total_penghargaan', 'cuti_besar_terakhir_ke', 'cuti_besar_ambil_1', 'cuti_besar_ambil_2', 'cuti_besar_ambil_3', 'cuti_besar_ambil_4', 'cuti_besar_ambil_5', 'cuti_besar_ambil_6', 'cuti_besar_ambil_7'], 'integer'],
            [['tanggal_lahir', 'reg_tanggal_masuk', 'reg_tanggal_diangkat', 'reg_tanggal_training', 'tanggal_mpp', 'tanggal_pensiun', 'tanggal_terminasi', 'jbt_tgl_keputusan', 'jbt_tanggal_berlaku', 'pkt_tgl_keputusan', 'pkt_tgl_berlaku', 'pst_masabakti_20', 'pst_masabakti_25', 'pst_masabakti_30', 'pst_masabakti_35', 'pst_masabakti_40', 'cuti_besar_terakhir_start', 'cuti_besar_terakhir_end', 'cuti_besar_plan_1', 'cuti_besar_plan_2', 'cuti_besar_plan_3', 'cuti_besar_plan_4', 'cuti_besar_plan_5', 'cuti_besar_plan_6', 'cuti_besar_plan_7', 'cuti_besar_aktual_1', 'cuti_besar_aktual_2', 'cuti_besar_aktual_3', 'cuti_besar_aktual_4', 'cuti_besar_aktual_5', 'cuti_besar_aktual_6', 'cuti_besar_aktual_7', 'cuti_besar_aktual_end_1', 'cuti_besar_aktual_end_2', 'cuti_besar_aktual_end_3', 'cuti_besar_aktual_end_4', 'cuti_besar_aktual_end_5', 'cuti_besar_aktual_end_6', 'cuti_besar_aktual_end_7', 'created_date', 'modified_date'], 'safe'],
            [['jenis_kelamin', 'golongan_darah', 'agama', 'status_pernikahan', 'kartu_kesehatan', 'status_tenaga_kerja', 'reg_status_pegawai', 'alamat_termutakhir', 'alamat_sesuai_identitas'], 'string'],
            [['pkt_gaji_pokok', 'mobilephone1', 'NIP'], 'number'],
            [['userid'], 'string', 'max' => 45],
            [['NIP'], 'string', 'max' => 100],
            [['nama_lengkap', 'foto', 'tempat_lahir', 'no_identitas_pribadi', 'scan_kk', 'gelar_akademik', 'gelar_profesi', 'pdk_sekolah_terakhir', 'pdk_jurusan_terakhir', 'mobilephone1', 'mobilephone2', 'telepon_rumah', 'fax_rumah', 'jbt_jabatan', 'jbt_no_sk_jabatan', 'jbt_keterangan_mutasi', 'pkt_no_sk', 'pos_kantor'], 'string', 'max' => 250],
            [['NPWP', 'no_kartu_kesehatan', 'no_kartu_tenagakerja', 'no_kartu_keluarga', 'scan_ktp', 'scan_bpjs', 'scan_npwp', 'scan_paraf', 'scan_tandatangan'], 'string', 'max' => 150],
            [['pdk_ipk_terakhir'], 'string', 'max' => 30],
            [['email1', 'email2'], 'string', 'max' => 200],
            [['pkt_eselon', 'pkt_ruang', 'created_user', 'created_ip_address', 'modified_user', 'modified_ip_address'], 'string', 'max' => 64],
            [['email1', 'NIP', 'mobilephone1'], 'trim'],
            [['email1'], 'email'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_pegawai' => 'Id Pegawai',
            'id_perusahaan' => 'Id Perusahaan',
            'userid' => 'Userid',
            'cid' => 'Cid',
            'no_dossier' => 'No Dossier',
            'NIP' => 'NIP',
            'nama_lengkap' => 'Nama Lengkap',
            'foto' => 'Foto',
            'tempat_lahir' => 'Tempat Lahir',
            'tanggal_lahir' => 'Tanggal Lahir',
            'usia' => 'Usia',
            'usia_lebih_bulan' => 'Usia Lebih Bulan',
            'jenis_kelamin' => 'Jenis Kelamin',
            'golongan_darah' => 'Golongan Darah',
            'tinggi_badan' => 'Tinggi Badan',
            'berat_badan' => 'Berat Badan',
            'agama' => 'Agama',
            'status_pernikahan' => 'Status Pernikahan',
            'no_identitas_pribadi' => 'No Identitas Pribadi',
            'NPWP' => 'Npwp',
            'no_kartu_kesehatan' => 'No Kartu Kesehatan',
            'no_kartu_tenagakerja' => 'No Kartu Tenagakerja',
            'kartu_kesehatan' => 'Kartu Kesehatan',
            'no_kartu_keluarga' => 'No Kartu Keluarga',
            'scan_ktp' => 'Scan Ktp',
            'scan_bpjs' => 'Scan Bpjs',
            'scan_npwp' => 'Scan Npwp',
            'scan_paraf' => 'Scan Paraf',
            'scan_kk' => 'Scan Kk',
            'scan_tandatangan' => 'Scan Tandatangan',
            'id_hrm_status_pegawai' => 'Id Hrm Status Pegawai',
            'id_hrm_status_organik' => 'Id Hrm Status Organik',
            'status_tenaga_kerja' => 'Status Tenaga Kerja',
            'reg_tanggal_masuk' => 'Reg Tanggal Masuk',
            'reg_tanggal_diangkat' => 'Reg Tanggal Diangkat',
            'reg_tanggal_training' => 'Reg Tanggal Training',
            'reg_status_pegawai' => 'Reg Status Pegawai',
            'tanggal_mpp' => 'Tanggal Mpp',
            'tanggal_pensiun' => 'Tanggal Pensiun',
            'tanggal_terminasi' => 'Tanggal Terminasi',
            'id_hrm_mst_jenis_terminasi_bi' => 'Id Hrm Mst Jenis Terminasi Bi',
            'gelar_akademik' => 'Gelar Akademik',
            'gelar_profesi' => 'Gelar Profesi',
            'pdk_id_tingkatpendidikan' => 'Pdk Id Tingkatpendidikan',
            'pdk_sekolah_terakhir' => 'Pdk Sekolah Terakhir',
            'pdk_jurusan_terakhir' => 'Pdk Jurusan Terakhir',
            'pdk_ipk_terakhir' => 'Pdk Ipk Terakhir',
            'pdk_tahun_lulus' => 'Pdk Tahun Lulus',
            'alamat_termutakhir' => 'Alamat Termutakhir',
            'alamat_sesuai_identitas' => 'Alamat Sesuai Identitas',
            'mobilephone1' => 'Mobile Phone',
            'mobilephone2' => 'Mobilephone2',
            'telepon_rumah' => 'Telepon Rumah',
            'fax_rumah' => 'Fax Rumah',
            'email1' => 'Email',
            'email2' => 'Email2',
            'jbt_id_jabatan' => 'Jbt Id Jabatan',
            'jbt_jabatan' => 'Jabatan',
            'jbt_id_tingkat_jabatan' => 'Jbt Id Tingkat Jabatan',
            'jbt_no_sk_jabatan' => 'Jbt No Sk Jabatan',
            'jbt_tgl_keputusan' => 'Jbt Tgl Keputusan',
            'jbt_tanggal_berlaku' => 'Jbt Tanggal Berlaku',
            'jbt_keterangan_mutasi' => 'Jbt Keterangan Mutasi',
            'pkt_id_pangkat' => 'Pkt Id Pangkat',
            'pkt_no_sk' => 'Pkt No Sk',
            'pkt_tgl_keputusan' => 'Pkt Tgl Keputusan',
            'pkt_tgl_berlaku' => 'Pkt Tgl Berlaku',
            'pkt_gaji_pokok' => 'Pkt Gaji Pokok',
            'pkt_id_jenis_kenaikan_pangkat' => 'Pkt Id Jenis Kenaikan Pangkat',
            'pkt_eselon' => 'Pkt Eselon',
            'pkt_ruang' => 'Pkt Ruang',
            'pos_id_hrm_kantor' => 'Pos Id Hrm Kantor',
            'pos_id_hrm_unit_kerja' => 'Pos Id Hrm Unit Kerja',
            'pos_kantor' => 'Pos Kantor',
            'sta_total_hukuman_disiplin' => 'Sta Total Hukuman Disiplin',
            'sta_total_penghargaan' => 'Sta Total Penghargaan',
            'pst_masabakti_20' => 'Pst Masabakti 20',
            'pst_masabakti_25' => 'Pst Masabakti 25',
            'pst_masabakti_30' => 'Pst Masabakti 30',
            'pst_masabakti_35' => 'Pst Masabakti 35',
            'pst_masabakti_40' => 'Pst Masabakti 40',
            'cuti_besar_terakhir_start' => 'Cuti Besar Terakhir Start',
            'cuti_besar_terakhir_end' => 'Cuti Besar Terakhir End',
            'cuti_besar_terakhir_ke' => 'Cuti Besar Terakhir Ke',
            'cuti_besar_plan_1' => 'Cuti Besar Plan 1',
            'cuti_besar_plan_2' => 'Cuti Besar Plan 2',
            'cuti_besar_plan_3' => 'Cuti Besar Plan 3',
            'cuti_besar_plan_4' => 'Cuti Besar Plan 4',
            'cuti_besar_plan_5' => 'Cuti Besar Plan 5',
            'cuti_besar_plan_6' => 'Cuti Besar Plan 6',
            'cuti_besar_plan_7' => 'Cuti Besar Plan 7',
            'cuti_besar_ambil_1' => 'Cuti Besar Ambil 1',
            'cuti_besar_ambil_2' => 'Cuti Besar Ambil 2',
            'cuti_besar_ambil_3' => 'Cuti Besar Ambil 3',
            'cuti_besar_ambil_4' => 'Cuti Besar Ambil 4',
            'cuti_besar_ambil_5' => 'Cuti Besar Ambil 5',
            'cuti_besar_ambil_6' => 'Cuti Besar Ambil 6',
            'cuti_besar_ambil_7' => 'Cuti Besar Ambil 7',
            'cuti_besar_aktual_1' => 'Cuti Besar Aktual 1',
            'cuti_besar_aktual_2' => 'Cuti Besar Aktual 2',
            'cuti_besar_aktual_3' => 'Cuti Besar Aktual 3',
            'cuti_besar_aktual_4' => 'Cuti Besar Aktual 4',
            'cuti_besar_aktual_5' => 'Cuti Besar Aktual 5',
            'cuti_besar_aktual_6' => 'Cuti Besar Aktual 6',
            'cuti_besar_aktual_7' => 'Cuti Besar Aktual 7',
            'cuti_besar_aktual_end_1' => 'Cuti Besar Aktual End 1',
            'cuti_besar_aktual_end_2' => 'Cuti Besar Aktual End 2',
            'cuti_besar_aktual_end_3' => 'Cuti Besar Aktual End 3',
            'cuti_besar_aktual_end_4' => 'Cuti Besar Aktual End 4',
            'cuti_besar_aktual_end_5' => 'Cuti Besar Aktual End 5',
            'cuti_besar_aktual_end_6' => 'Cuti Besar Aktual End 6',
            'cuti_besar_aktual_end_7' => 'Cuti Besar Aktual End 7',
            'created_date' => 'Created Date',
            'created_user' => 'Created User',
            'created_ip_address' => 'Created Ip Address',
            'modified_date' => 'Modified Date',
            'modified_user' => 'Modified User',
            'modified_ip_address' => 'Modified Ip Address',
        ];
    }
}
