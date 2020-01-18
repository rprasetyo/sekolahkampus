<?php

namespace app\models;
use app\common\helpers\Timeanddate;
use app\common\helpers\IPAddressFunction;
use Yii;

/**
 * This is the model class for table "log_activity".
 *
 * @property string $id_log_activity
 * @property string $log_date
 * @property string $log_datetime
 * @property string $tablename
 * @property string $related_id
 * @property int $id_mst_log_activity
 * @property int $userid
 * @property string $ip_address_user
 * @property string $additional_info1
 * @property string $additional_info2
 * @property string $additional_info3
 */
class LogActivity extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'log_activity';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['log_date', 'log_datetime', 'tablename', 'related_id', 'id_mst_log_activity', 'userid', 'ip_address_user'], 'required'],
            [['log_date', 'log_datetime'], 'safe'],
            [['related_id', 'id_mst_log_activity', 'userid'], 'integer'],
            [['additional_info1', 'additional_info2', 'additional_info3'], 'string'],
            [['tablename'], 'string', 'max' => 200],
            [['ip_address_user'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_log_activity' => 'Id Log Activity',
            'log_date' => 'Log Date',
            'log_datetime' => 'Log Datetime',
            'tablename' => 'Tablename',
            'related_id' => 'Related ID',
            'id_mst_log_activity' => 'Activity',
            'userid' => 'User Updated',
            'ip_address_user' => 'IP Address',
            'additional_info1' => 'Additional Info1',
            'additional_info2' => 'Additional Info2',
            'additional_info3' => 'Additional Info3',
        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'userid']);
    }
	
	public static function insertNewLogActivity($tableName, $id_mst_log_activity, $related_id, $_model, $add_info1="", $add_info2=""){
		$model = new LogActivity();
		
		$class = get_class($_model);
		
		$model->classname = $class;
		$model->log_date = Timeanddate::getCurrentDate();
		$model->log_datetime = Timeanddate::getCurrentDateTime();
        $model->ip_address_user = IPAddressFunction::getUserIPAddress();
        $model->userid = Yii::$app->user->identity->id;
		$model->tablename = $tableName;
		$model->id_mst_log_activity = $id_mst_log_activity;
		$model->related_id = $related_id;
		$model->additional_info1 = $add_info1;
		$model->additional_info2 = $add_info2;
		$model->save(false);
	}

    public function getMstActivity()
    {
        return $this->hasOne(MstLogActivity::className(), ['id_mst_log_activity' => 'id_mst_log_activity']);
    }

}
