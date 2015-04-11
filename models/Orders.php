<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "orders".
 *
 * @property integer $id
 * @property integer $product_id
 * @property integer $count
 */
class Orders extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'orders';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id'], 'required'],
            [['product_id', 'count'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'Product ID',
            'count' => 'Count',
        ];
    }

    public function addProduct(Product $product)
    {
        $existedBasketProduct = Orders::find()->where(['product_id' => $product->id])->one();

        if ($existedBasketProduct) {
            $existedBasketProduct->count = $existedBasketProduct->count + 1;

            return $existedBasketProduct->save();
        }

        $newBasketProduct = new Orders();
        $newBasketProduct->product_id = $product->id;

        return $newBasketProduct->save();
    }

    public function getProduct()
    {
        return Product::findOne($this->product_id);
    }

    public function removeProduct(Product $product)
    {
        $existedBasketProduct = Orders::find()->where(['product_id' => $product->id])->one();

        if ($existedBasketProduct && $existedBasketProduct->count > 1) {
            $existedBasketProduct->count = $existedBasketProduct->count - 1;

            return $existedBasketProduct->save();
        }
        else if ($existedBasketProduct)
        {
            return $existedBasketProduct->delete();
        }
    }
}
