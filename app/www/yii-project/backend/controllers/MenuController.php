<?php

namespace backend\controllers;

use common\models\Menu;
use common\models\MenuSearch;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
/**
 * MenuController implements the CRUD actions for Menu model.
 */
class MenuController extends Controller
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
     * Lists all Menu models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new MenuSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Menu model.
     * @param int $id
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
     * Creates a new Menu model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Menu();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                // $model->name = $this->request->post()['Menu']['name'];
                $model->translate('uz')->name = $this->request->post()['Menu']['name'];
                $model->translate('uz')->url = $this->request->post()['Menu']['url'];
                $model->save();

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
     * Updates an existing Menu model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post())) {
            foreach (Yii::$app->request->post('MenuTranslation', []) as $language => $data) {
                foreach ($data as $attribute => $translation) {
                    $model->name = Yii::$app->request->post()['MenuTranslation']['uz']['name'];
                    $model->url = Yii::$app->request->post()['MenuTranslation']['uz']['url'];
                    $model->translate($language)->$attribute = $translation;
                }
            }


            $model->save();

            return $this->redirect(['index', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Menu model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Menu model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id
     * @return Menu the loaded model
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

    protected function findModel($id)
    {
        if (($model = Menu::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
