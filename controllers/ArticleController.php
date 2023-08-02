<?php
namespace app\controllers;

use app\models\Article;
use app\models\User;
use yii\filters\auth\HttpBasicAuth;

class ArticleController extends \yii\rest\ActiveController
{
    public $modelClass = Article::class;

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => HttpBasicAuth::class,
            'except' => ['index', 'view'],
            'auth' => function ($username, $password) {
                if ($username == \Yii::$app->params['username'] && $password == \Yii::$app->params['password']) {
                    return new User();
                }
                return null;
            }
        ];
        return $behaviors;
    }
}
