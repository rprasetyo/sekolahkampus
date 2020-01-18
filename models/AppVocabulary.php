<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "app_vocabulary".
 *
 * @property int $id_app_vocabulary
 * @property string $master_vocab
 * @property string $vocab_lang1
 * @property string $vocab_lang2
 */
class AppVocabulary extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'app_vocabulary';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['master_vocab', 'vocab_lang1'], 'required'],
            [['master_vocab'], 'string', 'max' => 150],
            [['vocab_lang1', 'vocab_lang2'], 'string', 'max' => 250],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_app_vocabulary' => 'Id App Vocabulary',
            'master_vocab' => 'Master Vocabulary',
            'vocab_lang1' => 'Vocabulary [Indonesia]',
            'vocab_lang2' => 'Vocabulary [English]',
        ];
    }
}
