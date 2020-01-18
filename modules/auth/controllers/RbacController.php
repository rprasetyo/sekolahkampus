<?php

namespace app\modules\auth\controllers;

use Yii;
use app\modules\auth\models\AuthItem;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RbacController implements the CRUD actions for AuthItem model.
 */
class RbacController extends Controller
{
    /**
     * @inheritdoc
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

    // User assignment
    public function actionAssignment()
    {
        $auth = Yii::$app->authManager;

        $admin = $auth->createRole('admin');
        $owner = $auth->createRole('owner');

        $auth->assign($owner, 5);
        $auth->assign($admin, 1);
    }

    // Create role
    public function actionCreate_role()
    {
        $auth = Yii::$app->authManager;

        // Admin -> index/create/view
        // Owner -> {Admin} and update/delete -> index/create/view/update/delete
        $index = $auth->createPermission('kartu-rfid/index');
        $create = $auth->createPermission('kartu-rfid/create');
        $view = $auth->createPermission('kartu-rfid/view');

        $update = $auth->createPermission('kartu-rfid/update');
        $delete = $auth->createPermission('kartu-rfid/delete');

        // add "admin" role and give this role permission
        $admin = $auth->getRole('admin');
//        $admin = $auth->createRole('admin');
//        $auth->add($admin);
        $auth->addChild($admin, $index);
        $auth->addChild($admin, $create);
        $auth->addChild($admin, $view);

        // add "owner" role and give this role permission
        // as well as the permissions of the "author" role
        $owner = $auth->getRole('owner');
//        $owner = $auth->createRole('owner');
//        $auth->add($owner);
//        $auth->addChild($owner, $admin);
        $auth->addChild($owner, $update);
        $auth->addChild($owner, $delete);
    }


    // Create permission
    public function actionCreate_permission()
    {
        $auth = Yii::$app->authManager;

        // User index
        $index = $auth->createPermission('user/index');
        $index->description = 'Create a index';
        $auth->add($index);

        // User create
        $create = $auth->createPermission('user/create');
        $create->description = 'Create a user';
        $auth->add($create);

        // User view
        $view = $auth->createPermission('user/view');
        $view->description = 'View a user';
        $auth->add($view);

        // User update
        $update = $auth->createPermission('user/update');
        $update->description = 'Update a user';
        $auth->add($update);

        // User delete
        $delete = $auth->createPermission('user/delete');
        $delete->description = 'Delete a user';
        $auth->add($delete);


    }

    public function actionCreate_newperm()
    {
        $auth = Yii::$app->authManager;
//        $auth->removeAll();

        // Kartu RFID index
        $index = $auth->createPermission('kartu-rfid/index');
        $index->description = 'Index of Kartu RFID';
        $auth->add($index);

        // Log create
        $create = $auth->createPermission('kartu-rfid/create');
        $create->description = 'Create a Kartu RFID';
        $auth->add($create);

        // Log view
        $view = $auth->createPermission('kartu-rfid/view');
        $view->description = 'View a Kartu RFID';
        $auth->add($view);

        // CPanel update
        $index = $auth->createPermission('kartu-rfid/update');
        $index->description = 'Update a Kartu RFID';
        $auth->add($index);

        // CPanel delete
        $index = $auth->createPermission('kartu-rfid/delete');
        $index->description = 'delete a Kartu RFID';
        $auth->add($index);


    }

    /**
     * Lists all AuthItem models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => AuthItem::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AuthItem model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
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
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing AuthItem model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->name]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing AuthItem model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
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
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
