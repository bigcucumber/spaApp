<?php
/**
 * FileName: UsersController.php
 * Description: 用户Controller
 * Author: Bigpao
 * Email: bigpao.luo@gmail.com
 * HomePage: 
 * Version: 0.0.1
 * LastChange: 2015-09-04 01:19:18
 * History:
 */

namespace app\modules\spa\controllers;


use yii;
use app\modules\components\AuthorizedwebserviceController;
use app\modules\spa\models\LoginForm;
use app\modules\spa\models\SpaUsers;
use yii\filters\AccessControl;

class UsersController extends AuthorizedwebserviceController
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
                        'actions' => ['login', 'autologin', 'register'],
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
        var_dump(Yii::$app -> user ->identity);
        $this -> sendResponse();
    }

    public function actionLogin()
    {
        $data = $this -> getRequestData();

        $loginForm = new LoginForm();
        if($loginForm -> load(['LoginForm' => $data]) && $loginForm -> login())
            $this -> sendResponse();

        $this -> sendResponse(['code' => self::REQUEST_ERROR, 'msg' => $loginForm -> getFirstError('password'),
            'data' => $loginForm -> getErrors()]);
    }

    public function actionRegister()
    {
        $data = $this -> getRequestData();

        $spaUsersModel = new SpaUsers();
        $spaUsersModel -> setAttributes($data);

        $salt = rand(0,255);
        $spaUsersModel -> setAttribute('salt', $salt);
        $spaUsersModel -> setAttribute('password', md5($salt . $spaUsersModel -> password));
        $spaUsersModel -> setAttribute('created_at', time());

        $spaUsersModel -> setAttribute('last_login_ip', Yii::$app -> request -> getUserIP());


        if(!$spaUsersModel -> save())
        {
            $responseData = [
                'code' => self::REQUEST_ERROR,
                'msg' => 'save into mysql error.',
                'data' => $spaUsersModel -> getErrors(),
            ];

        }
        else
            $responseData = ['data' => 'register ok.'];

        $this -> sendResponse($responseData);
    }

    public function actionAutologin()
    {
        $user = SpaUsers::findOne(['id' => 1]);
        $login = Yii::$app -> user -> login($user, 100);
        var_dump($login);exit;

    }
}

