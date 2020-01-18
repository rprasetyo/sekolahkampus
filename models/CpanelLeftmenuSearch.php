<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\CpanelLeftmenu;

/**
 * CpanelLeftmenuSearch represents the model behind the search form of `app\models\CpanelLeftmenu`.
 */
class CpanelLeftmenuSearch extends CpanelLeftmenu
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_leftmenu', 'id_parent_leftmenu', 'has_child', 'is_public', 'visible'], 'integer'],
            [['menu_name', 'menu_icon', 'value_indo', 'value_eng', 'url', 'auth', 'mobile_display'], 'safe'],
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
        $query = CpanelLeftmenu::find();

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
            'id_leftmenu' => $this->id_leftmenu,
            'id_parent_leftmenu' => $this->id_parent_leftmenu,
            'has_child' => $this->has_child,
            'is_public' => $this->is_public,
            'visible' => $this->visible,
        ]);

        $query->andFilterWhere(['like', 'menu_name', $this->menu_name])
            ->andFilterWhere(['like', 'menu_icon', $this->menu_icon])
            ->andFilterWhere(['like', 'value_indo', $this->value_indo])
            ->andFilterWhere(['like', 'value_eng', $this->value_eng])
            ->andFilterWhere(['like', 'url', $this->url])
            ->andFilterWhere(['like', 'auth', $this->auth])
            ->andFilterWhere(['like', 'mobile_display', $this->mobile_display]);

        return $dataProvider;
    }
}
