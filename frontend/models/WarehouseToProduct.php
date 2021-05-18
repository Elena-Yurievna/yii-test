<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "warehouse_to_product".
 *
 * @property int $id
 * @property int|null $product_id
 * @property int|null $warehouse_id
 */
class WarehouseToProduct extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'warehouse_to_product';
    }
}
