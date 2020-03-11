<?php

namespace app\controllers;

use app\models\Basket;
use app\modules\discounts\services\BlackFridayDiscount;
use app\modules\discounts\services\ComplectDiscount;
use app\modules\discounts\services\DbDiscountSpecification;
use app\modules\discounts\services\DiscountAggregator;
use app\modules\discounts\services\DiscountManager;
use app\modules\discounts\services\EarlyBirdDiscount;
use app\modules\discounts\services\PromoDiscountSpecification;
use app\modules\discounts\services\PromoCodeDiscount;
use app\modules\products\services\ConcreteCart;
use app\modules\products\services\ConcreteProduct;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        $blackFridayDiscount = new BlackFridayDiscount(new DbDiscountSpecification());
        $earlyBirdDiscount = new EarlyBirdDiscount(new DbDiscountSpecification());
        $complectDiscount = new ComplectDiscount(new DbDiscountSpecification());
        $promoCodeDiscount = new PromoCodeDiscount(new PromoDiscountSpecification());

        $product1 = new ConcreteProduct(1, 34.5);
        $product2 = new ConcreteProduct(2, 67.8);

        $cart = new ConcreteCart($product1, $product2);

        $discountManager = new DiscountManager(new DiscountAggregator());

        $discountManager->applyDiscounts($cart, $promoCodeDiscount, $blackFridayDiscount, $earlyBirdDiscount,
            $complectDiscount);

        $basket = new Basket($cart, $discountManager);

        return $this->render('index', [
            'products' => $cart->getProducts(),
            'discountManager' => $discountManager,
            'productsPrice' => $basket->getPriceWithoutDiscount(),
            'productsDiscountedPrice' => $basket->getPriceWithDiscount(),
        ]);
    }
}
