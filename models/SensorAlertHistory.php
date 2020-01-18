<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sensor_alert_history".
 *
 * @property string $id_sensor_alert_history
 * @property string $id_sensor
 * @property string $channel
 * @property int $channel_number
 * @property string $first_appereance_time
 * @property double $first_appereance_value
 * @property string $last_appreance_time
 * @property double $last_appreance_value
 * @property int $is_case_open
 * @property string $alert_message
 */
class SensorAlertHistory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sensor_alert_history';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_sensor', 'channel', 'channel_number', 'first_appereance_time', 'first_appereance_value', 'last_appreance_time', 'last_appreance_value', 'alert_message'], 'required'],
            [['id_sensor', 'channel_number', 'is_case_open'], 'integer'],
            [['first_appereance_time', 'last_appreance_time'], 'safe'],
            [['first_appereance_value', 'last_appreance_value'], 'number'],
            [['channel'], 'string', 'max' => 20],
            [['alert_message'], 'string', 'max' => 250],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_sensor_alert_history' => 'Id Sensor Alert History',
            'id_sensor' => 'Id Sensor',
            'channel' => 'Channel',
            'channel_number' => 'Channel Number',
            'first_appereance_time' => 'First Appereance Time',
            'first_appereance_value' => 'First Appereance Value',
            'last_appreance_time' => 'Last Appreance Time',
            'last_appreance_value' => 'Last Appreance Value',
            'is_case_open' => 'Is Case Open',
            'alert_message' => 'Alert Message',
        ];
    }
}
