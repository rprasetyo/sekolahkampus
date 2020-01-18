<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\HrmPegawai;

/**
 * HrmPegawaiSearch represents the model behind the search form of `app\models\HrmPegawai`.
 */
class HrmPegawaiSearch extends HrmPegawai
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_pegawai', 'id_perusahaan', 'cid', 'no_dossier', 'usia', 'usia_lebih_bulan', 'tinggi_badan', 'berat_badan', 'id_hrm_status_pegawai', 'id_hrm_status_organik', 'id_hrm_mst_jenis_terminasi_bi', 'pdk_id_tingkatpendidikan', 'pdk_tahun_lulus', 'jbt_id_jabatan', 'jbt_id_tingkat_jabatan', 'pkt_id_pangkat', 'pkt_id_jenis_kenaikan_pangkat', 'pos_id_hrm_kantor', 'pos_id_hrm_unit_kerja', 'sta_total_hukuman_disiplin', 'sta_total_penghargaan', 'cuti_besar_terakhir_ke', 'cuti_besar_ambil_1', 'cuti_besar_ambil_2', 'cuti_besar_ambil_3', 'cuti_besar_ambil_4', 'cuti_besar_ambil_5', 'cuti_besar_ambil_6', 'cuti_besar_ambil_7'], 'integer'],
            [['userid', 'NIP', 'nama_lengkap', 'foto', 'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin', 'golongan_darah', 'agama', 'status_pernikahan', 'no_identitas_pribadi', 'NPWP', 'no_kartu_kesehatan', 'no_kartu_tenagakerja', 'kartu_kesehatan', 'no_kartu_keluarga', 'scan_ktp', 'scan_bpjs', 'scan_npwp', 'scan_paraf', 'scan_kk', 'scan_tandatangan', 'status_tenaga_kerja', 'reg_tanggal_masuk', 'reg_tanggal_diangkat', 'reg_tanggal_training', 'reg_status_pegawai', 'tanggal_mpp', 'tanggal_pensiun', 'tanggal_terminasi', 'gelar_akademik', 'gelar_profesi', 'pdk_sekolah_terakhir', 'pdk_jurusan_terakhir', 'pdk_ipk_terakhir', 'alamat_termutakhir', 'alamat_sesuai_identitas', 'mobilephone1', 'mobilephone2', 'telepon_rumah', 'fax_rumah', 'email1', 'email2', 'jbt_jabatan', 'jbt_no_sk_jabatan', 'jbt_tgl_keputusan', 'jbt_tanggal_berlaku', 'jbt_keterangan_mutasi', 'pkt_no_sk', 'pkt_tgl_keputusan', 'pkt_tgl_berlaku', 'pkt_eselon', 'pkt_ruang', 'pos_kantor', 'pst_masabakti_20', 'pst_masabakti_25', 'pst_masabakti_30', 'pst_masabakti_35', 'pst_masabakti_40', 'cuti_besar_terakhir_start', 'cuti_besar_terakhir_end', 'cuti_besar_plan_1', 'cuti_besar_plan_2', 'cuti_besar_plan_3', 'cuti_besar_plan_4', 'cuti_besar_plan_5', 'cuti_besar_plan_6', 'cuti_besar_plan_7', 'cuti_besar_aktual_1', 'cuti_besar_aktual_2', 'cuti_besar_aktual_3', 'cuti_besar_aktual_4', 'cuti_besar_aktual_5', 'cuti_besar_aktual_6', 'cuti_besar_aktual_7', 'cuti_besar_aktual_end_1', 'cuti_besar_aktual_end_2', 'cuti_besar_aktual_end_3', 'cuti_besar_aktual_end_4', 'cuti_besar_aktual_end_5', 'cuti_besar_aktual_end_6', 'cuti_besar_aktual_end_7', 'created_date', 'created_user', 'created_ip_address', 'modified_date', 'modified_user', 'modified_ip_address'], 'safe'],
            [['pkt_gaji_pokok'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = HrmPegawai::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_pegawai' => $this->id_pegawai,
            'id_perusahaan' => $this->id_perusahaan,
            'cid' => $this->cid,
            'no_dossier' => $this->no_dossier,
            'tanggal_lahir' => $this->tanggal_lahir,
            'usia' => $this->usia,
            'usia_lebih_bulan' => $this->usia_lebih_bulan,
            'tinggi_badan' => $this->tinggi_badan,
            'berat_badan' => $this->berat_badan,
            'id_hrm_status_pegawai' => $this->id_hrm_status_pegawai,
            'id_hrm_status_organik' => $this->id_hrm_status_organik,
            'reg_tanggal_masuk' => $this->reg_tanggal_masuk,
            'reg_tanggal_diangkat' => $this->reg_tanggal_diangkat,
            'reg_tanggal_training' => $this->reg_tanggal_training,
            'tanggal_mpp' => $this->tanggal_mpp,
            'tanggal_pensiun' => $this->tanggal_pensiun,
            'tanggal_terminasi' => $this->tanggal_terminasi,
            'id_hrm_mst_jenis_terminasi_bi' => $this->id_hrm_mst_jenis_terminasi_bi,
            'pdk_id_tingkatpendidikan' => $this->pdk_id_tingkatpendidikan,
            'pdk_tahun_lulus' => $this->pdk_tahun_lulus,
            'jbt_id_jabatan' => $this->jbt_id_jabatan,
            'jbt_id_tingkat_jabatan' => $this->jbt_id_tingkat_jabatan,
            'jbt_tgl_keputusan' => $this->jbt_tgl_keputusan,
            'jbt_tanggal_berlaku' => $this->jbt_tanggal_berlaku,
            'pkt_id_pangkat' => $this->pkt_id_pangkat,
            'pkt_tgl_keputusan' => $this->pkt_tgl_keputusan,
            'pkt_tgl_berlaku' => $this->pkt_tgl_berlaku,
            'pkt_gaji_pokok' => $this->pkt_gaji_pokok,
            'pkt_id_jenis_kenaikan_pangkat' => $this->pkt_id_jenis_kenaikan_pangkat,
            'pos_id_hrm_kantor' => $this->pos_id_hrm_kantor,
            'pos_id_hrm_unit_kerja' => $this->pos_id_hrm_unit_kerja,
            'sta_total_hukuman_disiplin' => $this->sta_total_hukuman_disiplin,
            'sta_total_penghargaan' => $this->sta_total_penghargaan,
            'pst_masabakti_20' => $this->pst_masabakti_20,
            'pst_masabakti_25' => $this->pst_masabakti_25,
            'pst_masabakti_30' => $this->pst_masabakti_30,
            'pst_masabakti_35' => $this->pst_masabakti_35,
            'pst_masabakti_40' => $this->pst_masabakti_40,
            'cuti_besar_terakhir_start' => $this->cuti_besar_terakhir_start,
            'cuti_besar_terakhir_end' => $this->cuti_besar_terakhir_end,
            'cuti_besar_terakhir_ke' => $this->cuti_besar_terakhir_ke,
            'cuti_besar_plan_1' => $this->cuti_besar_plan_1,
            'cuti_besar_plan_2' => $this->cuti_besar_plan_2,
            'cuti_besar_plan_3' => $this->cuti_besar_plan_3,
            'cuti_besar_plan_4' => $this->cuti_besar_plan_4,
            'cuti_besar_plan_5' => $this->cuti_besar_plan_5,
            'cuti_besar_plan_6' => $this->cuti_besar_plan_6,
            'cuti_besar_plan_7' => $this->cuti_besar_plan_7,
            'cuti_besar_ambil_1' => $this->cuti_besar_ambil_1,
            'cuti_besar_ambil_2' => $this->cuti_besar_ambil_2,
            'cuti_besar_ambil_3' => $this->cuti_besar_ambil_3,
            'cuti_besar_ambil_4' => $this->cuti_besar_ambil_4,
            'cuti_besar_ambil_5' => $this->cuti_besar_ambil_5,
            'cuti_besar_ambil_6' => $this->cuti_besar_ambil_6,
            'cuti_besar_ambil_7' => $this->cuti_besar_ambil_7,
            'cuti_besar_aktual_1' => $this->cuti_besar_aktual_1,
            'cuti_besar_aktual_2' => $this->cuti_besar_aktual_2,
            'cuti_besar_aktual_3' => $this->cuti_besar_aktual_3,
            'cuti_besar_aktual_4' => $this->cuti_besar_aktual_4,
            'cuti_besar_aktual_5' => $this->cuti_besar_aktual_5,
            'cuti_besar_aktual_6' => $this->cuti_besar_aktual_6,
            'cuti_besar_aktual_7' => $this->cuti_besar_aktual_7,
            'cuti_besar_aktual_end_1' => $this->cuti_besar_aktual_end_1,
            'cuti_besar_aktual_end_2' => $this->cuti_besar_aktual_end_2,
            'cuti_besar_aktual_end_3' => $this->cuti_besar_aktual_end_3,
            'cuti_besar_aktual_end_4' => $this->cuti_besar_aktual_end_4,
            'cuti_besar_aktual_end_5' => $this->cuti_besar_aktual_end_5,
            'cuti_besar_aktual_end_6' => $this->cuti_besar_aktual_end_6,
            'cuti_besar_aktual_end_7' => $this->cuti_besar_aktual_end_7,
            'created_date' => $this->created_date,
            'modified_date' => $this->modified_date,
        ]);

        $query->andFilterWhere(['like', 'userid', $this->userid])
            ->andFilterWhere(['like', 'NIP', $this->NIP])
            ->andFilterWhere(['like', 'nama_lengkap', $this->nama_lengkap])
            ->andFilterWhere(['like', 'foto', $this->foto])
            ->andFilterWhere(['like', 'tempat_lahir', $this->tempat_lahir])
            ->andFilterWhere(['like', 'jenis_kelamin', $this->jenis_kelamin])
            ->andFilterWhere(['like', 'golongan_darah', $this->golongan_darah])
            ->andFilterWhere(['like', 'agama', $this->agama])
            ->andFilterWhere(['like', 'status_pernikahan', $this->status_pernikahan])
            ->andFilterWhere(['like', 'no_identitas_pribadi', $this->no_identitas_pribadi])
            ->andFilterWhere(['like', 'NPWP', $this->NPWP])
            ->andFilterWhere(['like', 'no_kartu_kesehatan', $this->no_kartu_kesehatan])
            ->andFilterWhere(['like', 'no_kartu_tenagakerja', $this->no_kartu_tenagakerja])
            ->andFilterWhere(['like', 'kartu_kesehatan', $this->kartu_kesehatan])
            ->andFilterWhere(['like', 'no_kartu_keluarga', $this->no_kartu_keluarga])
            ->andFilterWhere(['like', 'scan_ktp', $this->scan_ktp])
            ->andFilterWhere(['like', 'scan_bpjs', $this->scan_bpjs])
            ->andFilterWhere(['like', 'scan_npwp', $this->scan_npwp])
            ->andFilterWhere(['like', 'scan_paraf', $this->scan_paraf])
            ->andFilterWhere(['like', 'scan_kk', $this->scan_kk])
            ->andFilterWhere(['like', 'scan_tandatangan', $this->scan_tandatangan])
            ->andFilterWhere(['like', 'status_tenaga_kerja', $this->status_tenaga_kerja])
            ->andFilterWhere(['like', 'reg_status_pegawai', $this->reg_status_pegawai])
            ->andFilterWhere(['like', 'gelar_akademik', $this->gelar_akademik])
            ->andFilterWhere(['like', 'gelar_profesi', $this->gelar_profesi])
            ->andFilterWhere(['like', 'pdk_sekolah_terakhir', $this->pdk_sekolah_terakhir])
            ->andFilterWhere(['like', 'pdk_jurusan_terakhir', $this->pdk_jurusan_terakhir])
            ->andFilterWhere(['like', 'pdk_ipk_terakhir', $this->pdk_ipk_terakhir])
            ->andFilterWhere(['like', 'alamat_termutakhir', $this->alamat_termutakhir])
            ->andFilterWhere(['like', 'alamat_sesuai_identitas', $this->alamat_sesuai_identitas])
            ->andFilterWhere(['like', 'mobilephone1', $this->mobilephone1])
            ->andFilterWhere(['like', 'mobilephone2', $this->mobilephone2])
            ->andFilterWhere(['like', 'telepon_rumah', $this->telepon_rumah])
            ->andFilterWhere(['like', 'fax_rumah', $this->fax_rumah])
            ->andFilterWhere(['like', 'email1', $this->email1])
            ->andFilterWhere(['like', 'email2', $this->email2])
            ->andFilterWhere(['like', 'jbt_jabatan', $this->jbt_jabatan])
            ->andFilterWhere(['like', 'jbt_no_sk_jabatan', $this->jbt_no_sk_jabatan])
            ->andFilterWhere(['like', 'jbt_keterangan_mutasi', $this->jbt_keterangan_mutasi])
            ->andFilterWhere(['like', 'pkt_no_sk', $this->pkt_no_sk])
            ->andFilterWhere(['like', 'pkt_eselon', $this->pkt_eselon])
            ->andFilterWhere(['like', 'pkt_ruang', $this->pkt_ruang])
            ->andFilterWhere(['like', 'pos_kantor', $this->pos_kantor])
            ->andFilterWhere(['like', 'created_user', $this->created_user])
            ->andFilterWhere(['like', 'created_ip_address', $this->created_ip_address])
            ->andFilterWhere(['like', 'modified_user', $this->modified_user])
            ->andFilterWhere(['like', 'modified_ip_address', $this->modified_ip_address]);

        return $dataProvider;
    }
}
