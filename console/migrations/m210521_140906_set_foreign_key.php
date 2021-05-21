<?php

use yii\db\Migration;

/**
 * Class m210521_140906_set_foreign_key
 */
class m210521_140906_set_foreign_key extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey('fk-prod-warehouse-product_id', '{{%warehouse_to_product}}', 'product_id', '{{%product}}', 'id', 'CASCADE', 'RESTRICT');
        $this->addForeignKey('fk-prod-warehouse-warehouse_id', '{{%warehouse_to_product}}', 'warehouse_id', '{{%warehouse}}', 'id', 'CASCADE', 'RESTRICT');

        $this->addForeignKey('fk-prod-reserved_products_product_id', '{{%reserved_products}}', 'product_id', '{{%product}}', 'id', 'CASCADE', 'RESTRICT');
        $this->addForeignKey('fk-prod-reserved_products_user_id', '{{%reserved_products}}', 'user_id', '{{%user}}', 'id', 'CASCADE', 'RESTRICT');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210521_140906_set_foreign_key cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }
 */
    public function down()
    {
        echo "m210521_140906_set_foreign_key cannot be reverted.\n";

        return false;
    }

}
