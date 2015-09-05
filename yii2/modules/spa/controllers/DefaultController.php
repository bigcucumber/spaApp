<?php

namespace app\modules\spa\controllers;

use yii;
use yii\web\Controller;

class DefaultController extends Controller
{
    public function actionIndex()
    {
        echo '<div class="container"><div class="page-header"><h1> Hello Single Page Application.</div></div>';
        Yii::$app -> end();
    }
}
