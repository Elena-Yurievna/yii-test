<?php

use yii\db\Migration;

/**
 * Class m210517_093041_reserved_products
 */
class m210517_093041_reserved_products extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->reservedProducts();
    }

    public function down()
    {
        $this->dropTable('reserved_products');
    }

    private function reservedProducts()
    {
        $this->createTable('reserved_products', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'product_id' => $this->integer()->notNull(),
        ]);

        $this->insert('reserved_products', [
            'id' => 1,
            'user_id' => 1,
            'product_id' => 1,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210517_093041_reserved_products cannot be reverted.\n";

        return false;
    }
}
