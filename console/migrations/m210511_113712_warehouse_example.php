<?php

use yii\db\Migration;

/**
 * Class m210511_113712_warehouse_example
 */
class m210511_113712_warehouse_example extends Migration
{
    public function up()
    {
        $this->createWarehouses();
        $this->createProducts();
        $this->createWarehousesToProducts();
    }

    public function down()
    {
        $this->dropTable('warehouse');
        $this->dropTable('product');
        $this->dropTable('warehouse_to_product');
    }

    private function createWarehouses()
    {
        $this->createTable('warehouse', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'products_quantity' => $this->integer()->notNull(),
            'provider_id' => $this->integer()->notNull(),
        ]);

        $this->insert('warehouse', [
            'id' => 1,
            'name' => 'warehouse 1',
            'products_quantity' => 3,
            'provider_id' => 3
        ]);
    }

    private function createProducts()
    {
        $this->createTable('product', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'warehouse_id' => $this->integer()->notNull(),
            'provider_id' => $this->integer()->notNull(),
        ]);

        $this->insert('product', [
            'id' => 1,
            'name' => 'product 1',
            'warehouse_id' => 1,
            'provider_id' => 3
        ]);

        $this->insert('product', [
            'id' => 2,
            'name' => 'product 2',
            'warehouse_id' => 1,
            'provider_id' => 3
        ]);

        $this->insert('product', [
            'id' => 3,
            'name' => 'product 3',
            'warehouse_id' => 1,
            'provider_id' => 3
        ]);
    }

    private function createWarehousesToProducts()
    {
        $this->createTable('warehouse_to_product', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer(),
            'warehouse_id' => $this->integer(),
        ]);

        $this->insert('warehouse_to_product', [
            'id' => 1,
            'product_id' => 1,
            'warehouse_id' => 1,
        ]);

        $this->insert('warehouse_to_product', [
            'id' => 2,
            'product_id' => 2,
            'warehouse_id' => 1,
        ]);

        $this->insert('warehouse_to_product', [
            'id' => 3,
            'product_id' => 3,
            'warehouse_id' => 1,
        ]);
    }
}
