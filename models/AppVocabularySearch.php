<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AppVocabulary;

/**
 * AppVocabularySearch represents the model behind the search form of `app\models\AppVocabulary`.
 */
class AppVocabularySearch extends AppVocabulary
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_app_vocabulary'], 'integer'],
            [['master_vocab', 'vocab_lang1', 'vocab_lang2'], 'safe'],
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
        $query = AppVocabulary::find();

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
            'id_app_vocabulary' => $this->id_app_vocabulary,
        ]);

        $query->andFilterWhere(['like', 'master_vocab', $this->master_vocab])
            ->andFilterWhere(['like', 'vocab_lang1', $this->vocab_lang1])
            ->andFilterWhere(['like', 'vocab_lang2', $this->vocab_lang2]);

        return $dataProvider;
    }

    public static function getValueByKey($key, $defaultValue=""){
		$one = AppVocabulary::find()
                ->where(['master_vocab' => $key])
                ->one();
		if($one != null){
			return $one->vocab_lang1;
		}else{
			if($defaultValue != ""){
				return $defaultValue;
			}else{
				return $key;
			}
		}
		
		return "--";
	}
}
