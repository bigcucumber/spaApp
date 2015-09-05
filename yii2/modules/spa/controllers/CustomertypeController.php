<?php
/**
 * Created by PhpStorm.
 * User: luowen
 * Date: 9/5/15
 * Time: 2:12 PM
 */

namespace app\modules\spa\controllers;


use app\modules\components\AuthorizedwebserviceController;
use app\modules\spa\models\SpaCustomerType;
use yii\filters\AccessControl;

class CustomertypeController extends AuthorizedwebserviceController
{


    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['index'],
                        'roles' => ['?']
                    ]
                ],
                'denyCallback' => function(){
                    $this -> sendResponse(['code' => self::REQUEST_ERROR, 'msg' => 'Unauthorized.']);
                },
            ],
        ];
    }

    public function actionIndex()
    {
        $spaCustomerType = SpaCustomerType::find()->orderBy(['created_at' => 'desc'])->all();

        $this->sendResponse(['data' => $spaCustomerType]);
    }
}
