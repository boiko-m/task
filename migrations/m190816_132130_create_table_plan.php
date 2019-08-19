<?php

    use yii\db\Migration;

    /**
     * Class m190816_132130_create_table_plans
     */
    class m190816_132130_create_table_plan extends Migration
    {
        /**
         * {@inheritdoc}
         */
        public function safeUp()
        {
            $this->createTable('plan', array(
                'id' => 'pk',
                'plan_name' => 'string',
                'plan_group_id' => 'int',
                'active_from' => 'int',
                'active_to' => 'int',
                'company_id' => 'int'
            ));
        }

        /**
         * {@inheritdoc}
         */
        public function safeDown()
        {
            $this->dropTable('plan');

            return true;
        }

    }
