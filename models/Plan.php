<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "plans".
 *
 * @property int $id
 * @property string $plan_name
 * @property int $plan_group_id
 * @property int $active_from
 * @property int $active_to
 * @property int $company_id
 *
 * @property PlanProperty[] $planProperties
 */
class Plan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'plan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['plan_group_id', 'active_from', 'active_to', 'company_id'], 'integer'],
            [['plan_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'plan_name' => 'Plan Name',
            'plan_group_id' => 'Plan Group ID',
            'active_from' => 'Active From',
            'active_to' => 'Active To',
            'company_id' => 'Company ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlanProperties()
    {
        return $this->hasMany(PlanProperty::className(), ['plan_id' => 'id']);
    }
}
