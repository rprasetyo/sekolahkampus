<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "mst_log_activity".
 *
 * @property int $id_mst_log_activity
 * @property string $activity
 * @property string $notes
 */
class MstLogActivity extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mst_log_activity';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['activity'], 'required'],
            [['activity'], 'string', 'max' => 200],
            [['notes'], 'string', 'max' => 250],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_mst_log_activity' => 'Id Mst Log Activity',
            'activity' => 'Activity',
            'notes' => 'Notes',
        ];
    }
	

}
