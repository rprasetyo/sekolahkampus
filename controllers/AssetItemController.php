<?php

namespace app\controllers;

use app\common\utils\EncryptionDB;
use app\models\AssetItem;
use app\models\AssetItemLocation;
use app\models\AssetItemSearch;
use app\models\AssetReceived;
use app\models\Kecamatan;
use app\models\Kelurahan;
use app\models\Sensor;
use kartik\mpdf\Pdf;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\Exception;
use Yii;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

/**
 * AssetItemController implements the CRUD actions for AssetItem model.
 */
class AssetItemController extends Controller
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
     * Lists all AssetItem models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AssetItemSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
//            $dataProvider->pagination->pageSize = 100,

        ]);
    }

    public function actionList()
    {
        $searchModel = new AssetItemSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('list', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionListSearch()
    {
        $searchModel = new AssetItemSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $dataProviderDisplay = $searchModel->search(Yii::$app->request->queryParams);
        $dataProviderDisplay->pagination = false;

        return $this->render('list-search', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'dataProviderDisplay' => $dataProviderDisplay,
//            $dataProvider->pagination->pageSize = 100,
        ]);
    }

    /**
     * Displays a single AssetItem model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $c = EncryptionDB::encryptor("encrypt", $id);
        return $this->redirect(['view-detail', 'c' => $c]);

        return $this->render('view_all', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionViewDetail($c)
    {
        $id = EncryptionDB::encryptor("decrypt", $c);
        $model = $this->findModel($id);
        return $this->render('view_all_detail', [
            'model' => $model,
            'modelItemLocation' => $this->findModelItemLocation($model->id_asset_item_location),
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

    /**
     * Creates a new AssetItem model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AssetItem();
        $modelLocation = new AssetItemLocation();
        $modelReceived = new AssetReceived();
        $modelLocation->id_asset_master = $model->id_asset_master;
        $model->id_asset_item_location = 1;
        $model->id_asset_received = 1;
        /*
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_asset_item]);
        }
        */
        $postData = Yii::$app->request->post();
        $model->load($postData);
        if ($modelLocation->load($postData)) {
            $modelLocation->id_asset_master = $model->id_asset_master;
            $modelLocation->save();
            $model->id_asset_item_location = $modelLocation->id_asset_item_location;

            if ($modelReceived->load($postData)) {
                $modelReceived->id_asset_master = $model->id_asset_master;
                $modelReceived->save();
                $model->id_asset_received = $modelReceived->id_asset_received;
            }

            if ($model->load($postData)) {
                $model->save();
                return $this->redirect(['view', 'id' => $model->id_asset_item]);
            }
        }

        /*
        if ($model->load($postData) && $modelLocation->load($postData) && Model::validateMultiple([$model, $modelLocation])) {
            //$model->save();
            //$modelLocation->save();

        }
        */

        return $this->render('create_all', [
            'model' => $model,
            'modelLocation' => $modelLocation,
            'modelReceived' => $modelReceived,
        ]);
    }

    /**
     * Updates an existing AssetItem model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $c = EncryptionDB::encryptor("encrypt", $id);
        return $this->redirect(['update-asset', 'c' => $c]);
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_asset_item]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionUpdateAsset($c)
    {
        $id = EncryptionDB::encryptor("decrypt", $c);
        $model = $this->findModel($id);
        $modelLocation = $this->findModelItemLocation($model->id_asset_item_location);
        $modelReceived = $this->findModelAssetReceived($model->id_asset_received);

        $postData = Yii::$app->request->post();
        $model->load($postData);
        if ($modelLocation->load($postData)) {
            $modelLocation->id_asset_master = $model->id_asset_master;
            $modelLocation->save();
            $model->id_asset_item_location = $modelLocation->id_asset_item_location;

            if ($modelReceived->load($postData)) {
                $modelReceived->id_asset_master = $model->id_asset_master;
                $modelReceived->save();
                $model->id_asset_received = $modelReceived->id_asset_received;
            }

            if ($model->load($postData)) {
                $model->save();
                return $this->redirect(['view', 'id' => $model->id_asset_item]);
            }
        }

        return $this->render('update_all', [
            'model' => $model,
            'modelLocation' => $modelLocation,
            'modelReceived' => $modelReceived,
        ]);
    }

    public function actionUploadImage($id)
    {
        $model = $this->findModel($id);

        $model->backupNameOldPicture(); //Dibackup dulu nama-nama file yang lama sblm diupload yang baru
        if ($model->load(Yii::$app->request->post())) {
            $model->picture1 = UploadedFile::getInstance($model, 'picture1');
            if ($model->save(false)) {
                $model->upload();
                Yii::$app->session->setFlash('success', "Upload image success!");
                return $this->redirect(['index']);
            }
        }

        return $this->render('upload-image', [
            'model' => $model,
        ]);
    }

    public function actionUploadFile1($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->file1 = UploadedFile::getInstance($model, 'file1');
            if ($model->save(false)) {
                $model->uploadFile();
                Yii::$app->session->setFlash('success', "Upload File success!");
                return $this->redirect(['index']);
            }
        }

        return $this->render('upload-file', [
            'model' => $model,
        ]);
    }

    public function actionUploadFile($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->file1 = UploadedFile::getInstance($model, 'file1');
            if ($model->save()) {
                $model->uploadManualFile();
                Yii::$app->session->setFlash('success', "Upload File success!");
                return $this->redirect(['index']);
            }
        }

        return $this->render('upload-file', [
            'model' => $model,
        ]);
    }

    public function actionDownloadFile($c, $i)
    {
        $id = EncryptionDB::encryptor("decrypt", $c);
        $model = $this->findModel($id);

        $field = "file" . $i;
        if (isset($model->$field)) {
            if ($model->$field != "") {
                //Gunakan File dari yang sudah diupdate
                $path = Yii::getAlias('@webroot') . '/images/asset_file/' . $model->$field;
                if (file_exists($path)) {
                    return Yii::$app->response->sendFile($path);
                    exit;
                } else {
                    throw new NotFoundHttpException("can't find {$model->$field} file");
                }
            } else {
                throw new NotFoundHttpException("File belum pernah diupload");
            }
        } else {
            throw new NotFoundHttpException("Wrong File Numbering");
        }

    }

    public function actionGenPdf($c)
    {
        $id = EncryptionDB::encryptor("decrypt", $c);
        $pdf_content = $this->renderPartial('view-pdf', [
            $model = $this->findModel($id),
            'model' => $model,
            'modelItemLocation' => $this->findModelItemLocation($model->id_asset_item_location),
        ]);
        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8,
            'format' => Pdf::FORMAT_A4,
            'filename' => 'Laporan Asset' . date('d-m-Y_his') . '.pdf',
            'orientation' => Pdf::ORIENT_PORTRAIT,
            'destination' => Pdf::DEST_BROWSER,
            'content' => $pdf_content,
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/src/assets/kv-mpdf-bootstrap.min.css',
            'options' => [
                'title' => 'Data Informasi Assets',
            ],
            'methods' => [
                'SetTitle' => 'Data Informasi Assets',
                'SetHeader' => ['Data Informasi Assets||Date: ' . date("r")],
                'SetFooter' => ['|Page {PAGENO}|'],
                'SetAuthor' => 'Asset Management',
                'SetCreator' => 'Admin',
            ]

        ]);
        // http response
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_RAW;
        $headers = Yii::$app->response->headers;
        $headers->add('Content-Type', 'application/pdf');
        return $pdf->render();

    }

    public function actionResetImageIndex($c)
    {
        $id_asset_item = EncryptionDB::encryptor('decrypt',$c);
        $model = $this->findModel($id_asset_item);
        $model->picture1 = ""; //Ini bagian untuk reset gambar
        $model->save(false);
        Yii::$app->session->setFlash('success', "Succesfully reset image to default!");
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return ['success' => true];
        }
        return $this->redirect(['index']);
    }

    public function actionResetImage($c)
    {
        $id_asset_item = EncryptionDB::encryptor('decrypt',$c);
        $model = $this->findModel($id_asset_item);
        $model->picture1 = ""; //Ini bagian untuk reset gambar
        $model->save(false);
        Yii::$app->session->setFlash('success', "Succesfully reset image to default!");
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return ['success' => true];
        }
        return $this->redirect(['list-search?AssetItemSearch%5Bid_type_asset_item1%5D=&AssetItemSearch%5Bid_type_asset_item2%5D=&AssetItemSearch%5Bnumber1%5D=&AssetItemSearch%5Bid_kabupaten%5D=&AssetItemSearch%5Bid_kecamatan%5D=&AssetItemSearch%5Bid_kelurahan%5D=']);
    }

    public function actionUploadFileSearch($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->file1 = UploadedFile::getInstance($model, 'file1');
            if ($model->save()) {
                $model->uploadManualFile();
                Yii::$app->session->setFlash('success', "Upload File success!");
                return $this->redirect(['list-search?AssetItemSearch%5Bid_type_asset_item1%5D=&AssetItemSearch%5Bid_type_asset_item2%5D=&AssetItemSearch%5Bnumber1%5D=&AssetItemSearch%5Bid_kabupaten%5D=&AssetItemSearch%5Bid_kecamatan%5D=&AssetItemSearch%5Bid_kelurahan%5D=']);
            }
        }

        return $this->render('upload-file', [
            'model' => $model,
        ]);
    }

    /*public function actionImportFile()
    {
        $model = new AssetItem();
        if ($model->load(Yii::$app->request->post())) {
            $file = UploadedFile::getInstance($model, 'files');
            try {
                $inputFileType = IOFactory::identify($file->tempName);
                $reader = IOFactory::createReader($inputFileType);
                $spreadsheet = $reader->load($file->tempName);
            } catch (Exception $e) {
                die('Error loading file: ' . $e->getMessage());
            }
            $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

            if ($this->saveImport($sheetData, $model)) {
                Yii::$app->getSession()->setFlash('success', 'Success');
                $this->redirect(['index']);
            } else {
                Yii::$app->getSession()->setFlash('error', 'Error');
                $this->redirect(['index']);
            }
        }
        return $this->renderAjax('import-file', [
            'model' => $model,
        ]);
    }*/
    public function actionImportFile()
    {
        $modelImport = new \yii\base\DynamicModel([
            'fileImport'=>'File Import',
        ]);
        $modelImport->addRule(['fileImport'],'required');
        $modelImport->addRule(['fileImport'],'file',['extensions'=>'ods,xls,xlsx'],['maxSize'=>1024*1024]);

        if(Yii::$app->request->post()){
            $modelImport->fileImport = \yii\web\UploadedFile::getInstance($modelImport,'fileImport');
            if($modelImport->fileImport && $modelImport->validate()){
                $inputFileType = IOFactory::identify($modelImport->fileImport->tempName);
                $objReader = IOFactory::createReader($inputFileType);
                $objPHPExcel = $objReader->load($modelImport->fileImport->tempName);
                $sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
                $baseRow = 3;
                while(!empty($sheetData[$baseRow]['B'])){
                    $model = new AssetItem();
                    $model->number1 = (string)$sheetData[$baseRow]['B'];
                    $model->number2 = (string)$sheetData[$baseRow]['C'];
                    $model->save();
                    $baseRow++;
                }
                Yii::$app->getSession()->setFlash('success', 'Success');
            } else {
                Yii::$app->getSession()->setFlash('error', 'Error');
            }
            return $this->redirect(['index']);
        }

        return $this->renderAjax('import-file',[
            'modelImport' => $modelImport,
        ]);
    }

/**
 * Deletes an existing AssetItem model.
 * If deletion is successful, the browser will be redirected to the 'index' page.
 * @param integer $id
 * @return mixed
 * @throws NotFoundHttpException if the model cannot be found
 */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $delete = $model->delete();


        return $this->redirect(['index']);
    }

    /**
     * Finds the AssetItem model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AssetItem the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AssetItem::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function findModelItemLocation($id)
    {
        if (($model = AssetItemLocation::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The Model Item Location does not exist.');
    }

    protected function findModelAssetReceived($id)
    {
        if (($model = AssetReceived::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The Model Asset Received does not exist.');
    }

    protected function getModelItemLocation($id)
    {
        if (($model = AssetItemLocation::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The Model Item Location does not exist.');
    }

    protected function getModelAssetReceived($id)
    {
        if (($model = AssetReceived::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The Model Asset Received does not exist.');
    }
    // protected function getModelSensor($id)
    // {
    //     if (($model = Sensor::findOne($id)) !== null) {
    //         return $model;
    //     }

    //     throw new NotFoundHttpException('The Model Sensore does not exist.');
    // }

    protected function saveImport($data, $model)
    {
        $rows = [];
        array_shift($data); // membuang header pada excel
        foreach ($data as $key => $value) {
            if ($value['A'] != null) {
                $rows[] = array_merge_recursive([null], array_values($value));
            }
        }
        if (!empty($rows)) {
            try {
                return \Yii::$app->db->createCommand()->batchInsert(AssetItem::tableName(), $model->attributes(), $rows)->execute();
            } catch (\yii\db\Exception $exception) {
                \Yii::warning('Kesalahan dalam eksekusi database.');
            }
        } else {
            return false;
        }
    }
}
