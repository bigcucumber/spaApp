<?php
/**
 * FileName: AuthorizedwebserviceController.php
 * Description:if a controller need authorized service then must extends it
 * Author: Bigpao
 * Email: bigpao.luo@gmail.com
 * HomePage: 
 * Version: 0.0.1
 * LastChange: 2015-09-04 02:04:27
 * History:
 */

namespace app\modules\components;

use yii\filters\AccessControl;


class AuthorizedwebserviceController extends BasewebserviceController
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
                ],
                'denyCallback' => function(){
                    $this -> sendResponse(['code' => self::REQUEST_ERROR, 'msg' => 'Unauthorized.']);
                },
            ],
        ];
    }
}
