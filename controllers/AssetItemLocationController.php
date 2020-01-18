<?php

namespace app\controllers;

use app\models\Kabupaten;
use app\models\Kecamatan;
use app\models\Kelurahan;
use Yii;
use app\models\AssetItemLocation;
use app\models\AssetItemLocationSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\common\utils\EncryptionDB;
/**
 * AssetItemLocationController implements the CRUD actions for AssetItemLocation model.
 */
class AssetItemLocationController extends Controller
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

    /**
     * Lists all AssetItemLocation models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AssetItemLocationSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AssetItemLocation model.
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

    public function actionViewMap($c)
    {
		$id = EncryptionDB::encryptor("decrypt",$c);
        return $this->render('view-map', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new AssetItemLocation model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AssetItemLocation();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_asset_item_location]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionLists($id)
    {
        $branches = Kabupaten::find()
            ->where(['id_propinsi' => $id])
            ->all();

        if (isset($branches) && count($branches) > 0) {
            foreach ($branches as $branch) {
                echo "<option value='", $branch->id_kabupaten . "'>" . $branch->nama_kabupaten . "</option>";
            }
        } else {
            echo "<option> Data Tidak Ke Load </option>";
        }
    }

    public function actionKecamatan($id)
    {
        $branches = Kecamatan::find()
            ->where(['id_kabupaten' => $id])
            ->all();

        if (isset($branches) && count($branches) > 0) {
            foreach ($branches as $branch) {
                echo "<option value='", $branch->id_kecamatan . "'>" . $branch->nama_kecamatan . "</option>";
            }
        } else {
            echo "<option> Data Tidak Ke Load </option>";
        }
    }

    public function actionKelurahan($id)
    {
        $branches = Kelurahan::find()
            ->where(['id_kecamatan' => $id])
            ->all();

        if (isset($branches) && count($branches) > 0) {
            foreach ($branches as $branch) {
                echo "<option value='", $branch->id_kelurahan . "'>" . $branch->nama_kelurahan . "</option>";
            }
        } else {
            echo "<option> Data Tidak Ke Load </option>";
        }
    }

    /**
     * Updates an existing AssetItemLocation model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_asset_item_location]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing AssetItemLocation model.
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
     * Finds the AssetItemLocation model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AssetItemLocation the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AssetItemLocation::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
