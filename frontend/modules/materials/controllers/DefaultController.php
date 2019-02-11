<?php

namespace frontend\modules\materials\controllers;

use Yii;
use frontend\modules\materials\models\Material;
use frontend\modules\materials\models\MaterialSearch;
use yii\data\ActiveDataProvider;
use yii\db\Expression;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * Default controller for the `materials` module
 */
class DefaultController extends Controller
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
     * Show material types
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Lists all Material models by type.
     * @return mixed
     */
    public function actionList($type)
    {
        $searchModel = new MaterialSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('list', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Material model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Material();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Material model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Material model.
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
     * Show video material by id
     * @param $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionVideo($id)
    {
        $ids = Yii::$app->request->cookies->getValue('viewed', []);
        $ids[] = $id;

        Yii::$app->response->cookies->add(new \yii\web\Cookie([
            'name' => 'viewed',
            'value' => array_unique($ids),
        ]));

        return $this->render('view', [
            'model' => $this->findModel($id, Material::TYPE_VIDEO),
            'recommendations' => $dataProvider = new ActiveDataProvider([
                'query' => $this->findRecommendMaterials($ids, Material::TYPE_VIDEO),
            ])
        ]);
    }

    /**
     * Show audio material by id
     * @param $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionAudio($id)
    {
        $ids = Yii::$app->request->cookies->getValue('viewed', []);
        $ids[] = $id;

        Yii::$app->response->cookies->add(new \yii\web\Cookie([
            'name' => 'viewed',
            'value' => array_unique($ids),
        ]));

        return $this->render('view', [
            'model' => $this->findModel($id, Material::TYPE_AUDIO),
            'recommendations' => $this->findRecommendMaterials($ids, Material::TYPE_AUDIO)
        ]);
    }

    /**
     * Finds the Material model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @param string $type
     * @return Material the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id, $type = null)
    {
        if (($model = Material::find()->where(['id' => $id, 'type' => $type])->one()) !== null && isset($type)) {
            return $model;
        } elseif (($model = Material::find()->where(['id' => $id])->one()) !== null && !isset($type)) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Get recommend materials query
     * @param $id array
     * @param $type string
     * @return \frontend\modules\materials\models\MaterialQuery
     */
    protected function findRecommendMaterials($id, $type)
    {
        return Material::find()
            ->where(['not in', 'id', $id])
            ->andWhere(['type' => $type])
            ->orderBy(new Expression('rand()'))
            ->limit(3);
//            ->all();
    }
}
