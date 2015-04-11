<?php

namespace app\controllers;

use app\models\Category;
use app\models\Product;
use Yii;
use yii\web\Controller;

class CategoryController extends Controller
{
	public function actions()
	{
		return [
			'error' => [
				'class' => 'yii\web\ErrorAction',
			],
		];
	}

	public function actionIndex($id)
	{
        if(Category::find()
            ->select('id')
            ->where([
                'parent_id' => $id
            ])->count() > 0)
        {
            $a = Category::find()
                ->select('id')
                ->where([
                    'parent_id' => $id
                ])->asArray()->all();

            $as = [];
            foreach($a as $aa)
            {
                $as[] = $aa['id'];
            }

            $products = Product::find()
                ->where(['category_id' => $as])
                ->all();
        }
        else
        {
            $products = Product::find()
                ->where(['category_id' => $id])
                ->all();
        }


		return $this->render('index', [
			'products' => $products
		]);
	}
}
