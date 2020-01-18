<?php

namespace app\controllers;

use dosamigos\editable\EditableAction;
use Yii;
use app\models\AppFieldConfig;
use app\models\AppFieldConfigSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\common\helpers\DatabaseTableReflection;

/**
 * AppFieldConfigController implements the CRUD actions for AppFieldConfig model.
 */
class AppFieldConfigController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'editable' => [
                'class' => EditableAction::className(),
                'modelClass' => AppFieldConfig::className(),
                'forceCreate' => false
            ]
        ];
    }

    /**
     * Lists all AppFieldConfig models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AppFieldConfigSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
	
    public function actionIndexVarian()
    {
        $searchModel = new AppFieldConfigSearch();
        
		$varian = "";
		if(isset($_GET['AppFieldConfigSearch'])){
			$get = $_GET['AppFieldConfigSearch'];
			//echo $get['varian_group'];
			$searchModel->varian_group = $get['varian_group'];
			$varian = $get['varian_group'];
			/*
			$models = $dataProvider->getModels();
			foreach($models as $model){
				echo $model->classname." ";
				echo $model->varian_group."==<br>"; 
			} */
		}
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		
        return $this->render('index-varian', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
			'varian' => $varian,
        ]);
    }

    /**
     * Displays a single AppFieldConfig model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
	
    public function actionGenerate($c)
    {
        $datalist = DatabaseTableReflection::saveListColumnFromTable($c);
		
		Yii::$app->session->setFlash('success', "Generate field success!");
        return $this->redirect(yii::$app->request->referrer);

        return $this->render('create', [
            'model' => $model,
        ]);
    }
	
	public function actionGenerateVarian($c, $v)
    {
        $datalist = DatabaseTableReflection::saveListColumnFromTable($c, $v);
		Yii::$app->session->setFlash('success', "Generate field success!");
		return $this->redirect(yii::$app->request->referrer);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_app_field_config]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new AppFieldConfig model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AppFieldConfig();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_app_field_config]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing AppFieldConfig model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_app_field_config]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing AppFieldConfig model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the AppFieldConfig model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AppFieldConfig the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AppFieldConfig::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
