<?php

namespace backend\controllers;

use common\components\StaticFunctions;
use common\models\Post;
use common\models\PostGallery;
use common\models\PostSearch;
use common\models\ProductImage;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * PostController implements the CRUD actions for Post model.
 */
class PostController extends Controller
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
                            'actions' => ['index', 'view', 'create','update','delete','delete-multiple','delete-image'],
                            'allow' => true,
                            'roles' => ['@'],
                        ],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Post models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new PostSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Post model.
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
     * Creates a new Post model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Post();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $model->translate('uz')->title = $this->request->post()['Post']['title'];
                $model->translate('uz')->preview_text = $this->request->post()['Post']['preview_text'];
                $model->translate('uz')->body = $this->request->post()['Post']['body'];

                $model->save();
                $galleryImages = UploadedFile::getInstances($model,'galleryImages');
                foreach ($galleryImages as $image) {
                    $postGallery = new PostGallery();
                    $postGallery->post_id = $model->id;
                    $postGallery->image = StaticFunctions::saveImage($image,'post',$model->id);
                    $postGallery->save();
                }
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Post model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post())) {
            foreach (Yii::$app->request->post('PostTranslation', []) as $language => $data) {
                foreach ($data as $attribute => $translation) {
                    $model->title = Yii::$app->request->post()['PostTranslation']['uz']['title'];
                    $model->preview_text = Yii::$app->request->post()['PostTranslation']['uz']['preview_text'];
                    $model->body = Yii::$app->request->post()['PostTranslation']['uz']['body'];
                    $model->translate($language)->$attribute = $translation;
                }
            }
            $galleryImages = UploadedFile::getInstances($model,'galleryImages');
            foreach ($galleryImages as $image) {
                $postGallery = new PostGallery();
                $postGallery->post_id = $model->id;
                $postGallery->image = StaticFunctions::saveImage($image,'post',$model->id);
                $postGallery->save();
            }
            $model->save();

            return $this->redirect(['', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Post model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
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
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Post model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Post the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Post::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    public function actionDeleteImage($id)
    {
        $model = PostGallery::findOne($id);
        $postId = $model->post_id;
        StaticFunctions::deleteImage($postId,'post',$model->image);
        $model->delete();
        return $this->redirect(['update','id'=>$postId]);
    }
}
