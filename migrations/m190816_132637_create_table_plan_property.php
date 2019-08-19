<?php

    use yii\db\Migration;

    /**
     * Class m190816_132637_create_table_plan_properties
     */
    class m190816_132637_create_table_plan_property extends Migration
    {
        /**
         * {@inheritdoc}
         */
        public function safeUp()
        {
            $this->createTable('plan_property', array(
                'id' => 'pk',
                'propertiy_type_id' => 'int',
                'active_from' => 'int',
                'active_to' => 'int',
                'plan_id' => 'int',
                'prop_value' => 'int'
            ));
        }

        /**
         * {@inheritdoc}
         */
        public function safeDown()
        {
            $this->dropTable('plan_property');

            return true;
        }

    }
