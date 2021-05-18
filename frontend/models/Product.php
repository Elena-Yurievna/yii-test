<?php


namespace frontend\models;

use common\models\ReservedProducts;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property string|null $name
 * @property int $warehouse_id
 * @property int $provider_id
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['reserved', 'safe'],
            [['warehouse_id', 'provider_id'], 'required'],
            [['warehouse_id', 'provider_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }


    public function getWarehouse()
    {
        $warehouse = Warehouse::find()->all();
        $items = ArrayHelper::map($warehouse,'id','name');
        $params = [
            'prompt' => 'Choose products',
        ];

        return $params + $items;
    }

    public function getReservedUserId()
    {
        return $this->hasMany(ReservedProducts::class, ['product_id' => 'id'])->all();
    }

    public function getReservedUserList()
    {
        $user_id = [];
        foreach ($this->getReservedUserId() as $reserved) {
            $user_id[$reserved->user_id] =
                empty($user_id[$reserved->user_id]) ?
                    1 :
                    $user_id[$reserved->user_id] + 1 ;
        }
        return $user_id;
    }
}

