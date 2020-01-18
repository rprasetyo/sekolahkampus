<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AuthMenu;

/**
 * AuthMenuSearch represents the model behind the search form of `app\models\AuthMenu`.
 */
class AuthMenuSearch extends AuthMenu
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_auth_menu'], 'integer'],
            [['menu_utama', 'child_menu', 'path'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = AuthMenu::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_auth_menu' => $this->id_auth_menu,
        ]);

        $query->andFilterWhere(['like', 'menu_utama', $this->menu_utama])
            ->andFilterWhere(['like', 'child_menu', $this->child_menu])
            ->andFilterWhere(['like', 'path', $this->path]);

        return $dataProvider;
    }
}
