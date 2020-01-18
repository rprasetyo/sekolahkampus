<?php


namespace app\controllers;

use app\common\utils\EncryptionDB;
use app\models\Kabupaten;
use app\models\Kecamatan;
use app\models\Kelurahan;
use app\models\Sekolah;
use app\models\SekolahSearch;
use Yii;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;


class PublicController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['view'],
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $this->layout = 'publicmain';
        $searchModel = new SekolahSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $dataProviderDisplay = $searchModel->search(Yii::$app->request->queryParams);
        $dataProviderDisplay->pagination = false;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'dataProviderDisplay' => $dataProviderDisplay,
//            $dataProvider->pagination->pageSize = 100,
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

    public function actionViewDetail($c)
    {
        $this->layout = 'publicmain';
        $id = EncryptionDB::encryptor("decrypt", $c);
        $model = $this->findModel($id);
        return $this->render('view-detail',[
            'model' => $model,

        ]);

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
            echo "<option> Data yang dipilih tidak tersedia</option>";
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
            echo "<option> Data yang dipilih tidak tersedia</option>";
        }
    }

    protected function findModel($id)
    {
        if (($model = Sekolah::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
