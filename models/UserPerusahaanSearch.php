<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\UserPerusahaan;

/**
 * UserPerusahaanSearch represents the model behind the search form of `app\models\UserPerusahaan`.
 */
class UserPerusahaanSearch extends UserPerusahaan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_user_perusahaan', 'id_user', 'id_perusahaan', 'created_date', 'created_user'], 'integer'],
            [['created_ip_address'], 'safe'],
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
        $query = UserPerusahaan::find();

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
            'id_user_perusahaan' => $this->id_user_perusahaan,
            'id_user' => $this->id_user,
            'id_perusahaan' => $this->id_perusahaan,
            'created_date' => $this->created_date,
            'created_user' => $this->created_user,
        ]);

        $query->andFilterWhere(['like', 'created_ip_address', $this->created_ip_address]);

        return $dataProvider;
    }
}
