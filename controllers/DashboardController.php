<?php

namespace app\controllers;

use app\models\RequestPickSearch;
use Yii;

class DashboardController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $searchModel = new RequestPickSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

}
