<?php

    namespace app\commands;

    use yii\console\Controller;
    use yii\console\ExitCode;

    use app\models\Plan;
    use app\models\PlanProperty;

    class CmdController extends Controller
    {

        public $files = [
            '/plans.xml' => [
                'model' => 'Plan',
                'rels' => [
                    'id' => 'PLAN_ID',
                    'plan_name' => 'PLAN_NAME',
                    'plan_group_id' => 'PLAN_GROUP_ID',
                    'active_from' => 'ACTIVE_FROM',
                    'active_to' => 'ACTIVE_TO',
                    'company_id' => 'COMPANY_ID'
                ]
            ],
            '/plan_properties.xml' => [
                'model' => 'PlanProperty',
                'rels' => [
                    'id' => 'PROPERTY_ID',
                    'propertiy_type_id' => 'PROPERTY_TYPE_ID',
                    'active_from' => 'ACTIVE_FROM',
                    'active_to' => 'ACTIVE_TO',
                    'plan_id' => 'PLAN_ID',
                    'prop_value' => 'PROP_VALUE'
                ]
            ]
        ];

        private function actualCheck($time)
        {
            return (int)$time < date('U', time()) ? false : true;
        }

        public function actionImportPlans()
        {

//            foreach ($this->files as $key => $file) {
//
//                $arr = simplexml_load_file(\Yii::getAlias('@web') . $key);
//
//                foreach ($arr->result->ROWSET->ROW as $item) {
//                    $model_name = "app\models\\" . $file['model'];
//                    $model = new $model_name();
//                    foreach ($file['rels'] as $lab => $rel) {
//                        $model->$lab = (int)$item->$rel;
//                    }
//                    $model->save();
//                }
//
//            }

            $arr = simplexml_load_file(\Yii::getAlias('@web') . '/plans.xml');

            foreach ($arr->result->ROWSET->ROW as $item) {

//                if ($this->actualCheck(
//                    date('U', strtotime($item->ACTIVE_TO))) === false
//                ) {
//                    continue;
//                }

                $plan = new Plan();
                $plan->id = (int)$item->PLAN_ID;
                $plan->plan_name = (string)$item->PLAN_NAME;
                $plan->plan_group_id = (int)$item->PLAN_GROUP_ID;
                $plan->active_from = date('U', strtotime($item->ACTIVE_FROM));
                $plan->active_to = date('U', strtotime($item->ACTIVE_TO));
                $plan->company_id = (int)$item->COMPANY_ID;
                if ($plan->validate()) {
                    $plan->save();
                } else {
                    $errors = $plan->errors;
                }

            }

            $arr = simplexml_load_file(\Yii::getAlias('@web') . '/plan_properties.xml');

            foreach ($arr->result->ROWSET->ROW as $item) {

//                if ($this->actualCheck(
//                    date('U', strtotime($item->ACTIVE_TO))) === false
//                ) {
//                    continue;
//                }

                $plan_prop = new PlanProperty();
                $plan_prop->id = (int)$item->PROPERTY_ID;
                $plan_prop->propertiy_type_id = (string)$item->PROPERTY_TYPE_ID;
                $plan_prop->active_from = date('U', strtotime($item->ACTIVE_FROM));
                $plan_prop->active_to = date('U', strtotime($item->ACTIVE_TO));
                $plan_prop->plan_id = (int)$item->PLAN_ID;
                $plan_prop->prop_value = (int)$item->PROP_VALUE;
                $plan_prop->save();

            }

            return ExitCode::OK;
        }
    }
