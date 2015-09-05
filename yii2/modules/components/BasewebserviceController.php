<?php
/**
 * FileName: BasewebserviceController.php
 * Description: webservice base controller
 * Author: Bigpao
 * Email: bigpao.luo@gmail.com
 * HomePage: 
 * Version: 0.0.1
 * LastChange: 2015-09-04 01:39:52
 * History:
 */

namespace app\modules\components;

use yii;
use yii\web\Controller;
use yii\helpers\Json;

class BasewebserviceController extends Controller
{
    protected $request = null; // define request object
    protected $response = null; // same as above

    const REQUEST_SUCCESS = 0;
    const REQUEST_ERROR = 1;
    const REQUEST_MSG = "operate success.";

    public function init()
    {
        parent::init();
        $this -> response = new WebserviceResponse();
        $this -> request = new WebserviceRequest();
    }


    protected function getRequestData()
    {
        $requestQueryData = [];

        switch($this -> getResponseMethod())
        {
            case 'get':
                $requestQueryData = $_GET;
                break;
            case 'post':
                $requestQueryData = Json::decode(file_get_contents('php://input'));
                break;
            case 'put':
                $requestQueryData = Json::decode(file_get_contents('php://input'));
                break;
            default:
                break;
        }

        return $requestQueryData;
    }

    protected function handleGet()
    {
        $this -> response -> setStatusCode(400);
        $this -> sendResponse('Get not Support.');
    }

    protected function handlePost()
    {
        $this -> response -> setStatusCode(400);
        $this -> sendResponse('Post not Support.');
    }

    protected function handlePut()
    {
        $this -> response -> setStatusCode(400);
        $this -> sendResponse('Put not Support.');
    }

    protected function handleDelete()
    {
        $this -> response -> setStatusCode(400);
        $this -> sendResponse('Delete not Support.');
    }

    protected function getResponseMethod()
    {
        return strtolower($this -> request -> getMethod());
    }


    protected function sendResponse( $data = [])
    {
        $responseData = [
            'code' => self::REQUEST_SUCCESS,
            'msg' => self::REQUEST_MSG,
            'data' => []
        ];

        if(is_array($data))
            $responseData = array_merge($responseData, $data);
        else
            $responseData['msg'] = $data;

        $jsonResponseData = Json::encode($responseData);

        $requestData = $this -> getRequestData();

        // make it supoort jsonp service
        if(isset($requestData['callback']) && $requestData['callback'] != '')
            $jsonResponseData = $requestData['callback'] . '(' . $jsonResponseData . ')';

        $this -> response -> content = $jsonResponseData;
        $this -> response -> send();

        Yii::$app -> end();
    }
}
