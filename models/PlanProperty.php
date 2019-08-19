<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "plan_properties".
 *
 * @property int $id
 * @property int $propertiy_type_id
 * @property int $active_from
 * @property int $active_to
 * @property int $plan_id
 * @property int $prop_value
 *
 * @property Plan $plan
 */
class PlanProperty extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'plan_property';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['propertiy_type_id', 'active_from', 'active_to', 'plan_id', 'prop_value'], 'integer'],
            [['plan_id'], 'exist', 'skipOnError' => true, 'targetClass' => Plan::className(), 'targetAttribute' => ['plan_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'propertiy_type_id' => 'Propertiy Type ID',
            'active_from' => 'Active From',
            'active_to' => 'Active To',
            'plan_id' => 'Plan ID',
            'prop_value' => 'Prop Value',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlan()
    {
        return $this->hasOne(Plan::className(), ['id' => 'plan_id']);
    }
}
