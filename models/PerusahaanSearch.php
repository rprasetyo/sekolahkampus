<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * PerusahaanSearch represents the model behind the search form of `app\models\Perusahaan`.
 */
class PerusahaanSearch extends Perusahaan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_perusahaan', 'security_code', 'phone1', 'phone2', 'status'], 'integer'],
            [['qrcode_perusahaan', 'nama_perusahaan', 'alamat', 'email1', 'email2', 'media_sosial1', 'media_sosial2', 'media_sosial3', 'status'], 'safe'],
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
        $query = Perusahaan::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_perusahaan' => $this->id_perusahaan,
            'security_code' => $this->security_code,
            'phone1' => $this->phone1,
            'phone2' => $this->phone2,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'qrcode_perusahaan', $this->qrcode_perusahaan])
            ->andFilterWhere(['like', 'nama_perusahaan', $this->nama_perusahaan])
            ->andFilterWhere(['like', 'alamat', $this->alamat])
            ->andFilterWhere(['like', 'email1', $this->email1])
            ->andFilterWhere(['like', 'email2', $this->email2])
            ->andFilterWhere(['like', 'media_sosial1', $this->media_sosial1])
            ->andFilterWhere(['like', 'media_sosial2', $this->media_sosial2])
            ->andFilterWhere(['like', 'media_sosial3', $this->media_sosial3])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
