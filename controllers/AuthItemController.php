<?php

namespace app\controllers;

use app\models\AuthItem;
use app\models\AuthItemMenu;
use app\models\AuthItemMenuSearch;
use app\models\AuthItemSearch;
use app\models\AuthMenu;
use dosamigos\editable\EditableAction;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * AuthItemController implements the CRUD actions for AuthItem model.
 */
class AuthItemController extends Controller
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
                'modelClass' => AuthItemMenu::className(),
                'forceCreate' => false
            ]
        ];
    }

    /**
     * Lists all AuthItem models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AuthItemSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionRole()
    {
        $searchModel = new AuthItemSearch();
        $searchModel->type = 1; //Hanya Role saja
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('role', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AuthItem model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionViewRole($id)
    {
        return $this->render('view-role', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionViewDetailRole($c)
    {
        $searchModel = new AuthItemMenuSearch();
        $searchModel->role = $c;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('view-detail-role', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionGenerateAuthMenu($c)
    {
        $listAuthMenu = AuthMenu::find()->all();
        $isResult = false;

        foreach ($listAuthMenu as $authmenu) {
            $existItemMenu = AuthItemMenu::find()->where(['role' => $c])->andWhere(['path' => $authmenu->path])->count();
            if ($existItemMenu == 0) {
                $model = new AuthItemMenu();
                $model->menu_utama = $authmenu->menu_utama;
                $model->child_menu = $authmenu->child_menu;
                $model->path = $authmenu->path;
                $model->is_enable = 1;
                $model->role = $c;
//                echo $model->role;
//                echo $existItemMenu;
                $model->save(true);
                $isResult = true;
            }
        }
        if ($isResult) {
            Yii::$app->session->setFlash('success', "Generate Auth Menu success !");
        } else {
            Yii::$app->session->setFlash('error', "Generate Auth Menu is done !");
        }

        return $this->redirect(['view-detail-role', 'c' => $c]);
    }

    /**
     * Creates a new AuthItem model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AuthItem();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->name]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionCreateRole()
    {
        $model = new AuthItem();
        $model->type = 1;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view-role', 'id' => $model->name]);
        }

        return $this->render('create-role', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing AuthItem model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->name]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing AuthItem model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['role']);
    }

    /**
     * Finds the AuthItem model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return AuthItem the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AuthItem::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
