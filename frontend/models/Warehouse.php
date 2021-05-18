<?php

namespace frontend\models;

use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

class Warehouse extends ActiveRecord
{
    public static function tableName()
    {
        return '{{warehouse}}';
    }

    public function rules()
    {
        return [
            [['name'], 'required'],
            [['products_quantity', 'provider_id'], 'safe']
        ];
    }

    public function getProductsQuantity()
    {
        return $this->hasMany(Product::class, ['warehouse_id' => 'id'])->count();
    }

    public function getAllProducts()
    {
        $products = Product::find()->where(['warehouse_id' => $this->id])->all();
        $items = ArrayHelper::map($products,'id','name');
        return $items;
    }

    public function getProductsId()
    {
        $products = Product::find()->all();
        $items = ArrayHelper::map($products,'id','name');
        $params = [
            'prompt' => 'Choose products',
        ];

        return $params + $items;
    }

    public function getWarehouseToProductRelations()
    {
        return $this->hasMany(WarehouseToProduct::class, ['warehouse_id' => 'id']);
    }

    public function getWarehouseList()
    {
        return $this->hasMany(WarehouseToProduct::class, ['product_id' => 'id']);
    }

    public function getProducts()
    {
        // чтобы получить связть между двумя таблицами, и данные
        return $this->hasMany(Product::class, ['id' => 'product_id'])->via('warehouseList')->all();
    }
}
