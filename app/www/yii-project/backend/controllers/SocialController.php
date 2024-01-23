<?php

namespace backend\controllers;

use common\components\StaticFunctions;
use common\models\Social;
use common\models\SocialSearch;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * SocialController implements the CRUD actions for Social model.
 */
class SocialController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
                'access' => [
                    'class' => AccessControl::class,
                    'rules' => [
                        [
                            'actions' => [''],
                            'allow' => true,
                            'roles' => ['?'],
                        ],
                        [
                            'actions' => ['index', 'view', 'create','update','delete','delete-multiple'],
                            'allow' => true,
                            'roles' => ['@'],
                        ],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Social models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new SocialSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Social model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Social model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Social();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $image = UploadedFile::getInstance($model, 'image');

                // Сначала пытаемся сохранить модель
                if ($model->save()) {
                    Yii::$app->session->setFlash('success', 'Успешно добавлено!');

                    // Проверяем, было ли загружено изображение
                    if ($image) {
                        // Теперь у нас есть ID модели
                        $model->image = StaticFunctions::saveImage($image, 'social', $model->id);
                        $model->save(); // Сохраняем модель с привязанным изображением
                    }

                    return $this->redirect(['index']);
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }


    /**
     * Updates an existing Social model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $oldImage = $model->image;

        if ($this->request->isPost && $model->load($this->request->post())) {
            $image = UploadedFile::getInstance($model, 'image');
            if($image){
                StaticFunctions::deleteImage($oldImage,'social',$model->id);
                $model->image = StaticFunctions::saveImage($image, 'social',$model->id);
            }else{
                $model->image = $oldImage;
            }

            if($model->save()){
                Yii::$app->session->setFlash('success','Успешно обновлено!');
                return $this->redirect(['index', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Social model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
    public function actionDeleteMultiple()
    {
        $selectedIds = Yii::$app->request->post('selection'); // Получите выбранные ID элементов

        if (!empty($selectedIds)){
            // Проведите удаление для выбранных элементов (используйте цикл или другую логику)
            foreach ($selectedIds as $selectedId){
                $this->findModel($selectedId)->delete();
            }
        }
        return $this->redirect(['index']); // Перенаправьте обратно на страницу со списком элементов после удаления
    }
    /**
     * Finds the Social model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Social the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Social::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
