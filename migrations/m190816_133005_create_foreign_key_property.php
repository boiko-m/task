<?php

    use yii\db\Migration;

    /**
     * Class m190816_133005_create_foreign_key_properties
     */
    class m190816_133005_create_foreign_key_property extends Migration
    {
        /**
         * {@inheritdoc}
         */
        public function safeUp()
        {
            $this->createIndex('idx-plan_id', 'plan_property', 'plan_id');
            $this->addForeignKey('fk-prod-plan-plan_id', 'plan_property', 'plan_id', 'plan', 'id', 'CASCADE',
                'RESTRICT');
        }

        /**
         * {@inheritdoc}
         */
        public function safeDown()
        {
            $this->dropForeignKey('fk-prod-plan-plan_id', 'plan_property');
            $this->dropIndex('idx-plan_id', 'plan_property');

            return true;
        }

    }
