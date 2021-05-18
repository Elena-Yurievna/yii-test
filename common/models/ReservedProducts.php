<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "reserved_products".
 *
 * @property int $id
 * @property int $user_id
 * @property int $product_id
 */
class ReservedProducts extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'reserved_products';
    }
}
