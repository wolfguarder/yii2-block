<?php

namespace wolfguard\block\controllers;

use yii\web\Controller;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;

/**
 * AdminController allows you to administrate blocks.
 *
 * @property \wolfguard\block\Module $module
 * @author Ivan Fedyaev <ivan.fedyaev@gmail.com
 */
class AdminController extends Controller
{
    /** @inheritdoc */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete'  => ['post'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'create', 'update', 'delete'],
                        'allow' => true,
                        'roles' => ['@'],
                        /*'matchCallback' => function ($rule, $action) {
                            return in_array(\Yii::$app->user->identity->username, $this->module->admins);
                        }*/
                    ],
                ]
            ]
        ];
    }

    /**
     * Lists all Block models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel  = $this->module->manager->createBlockSearch();
        $dataProvider = $searchModel->search($_GET);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel'  => $searchModel,
        ]);
    }

    /**
     * Creates a new Block model.
     * If creation is successful, the browser will be redirected to the 'index' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = $this->module->manager->createBlock(['scenario' => 'create']);

        if ($model->load(\Yii::$app->request->post()) && $model->create()) {
            \Yii::$app->getSession()->setFlash('block.success', \Yii::t('block', 'Block has been created'));
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model
        ]);
    }

    /**
     * Updates an existing Block model.
     * If update is successful, the browser will be redirected to the 'index' page.
     * @param  integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->scenario = 'update';

        if ($model->load(\Yii::$app->request->post()) && $model->save()) {
            if(\Yii::$app->request->get('returnUrl')){
                $back = urldecode(\Yii::$app->request->get('returnUrl'));
                return $this->redirect($back);
            }

            \Yii::$app->getSession()->setFlash('block.success', \Yii::t('block', 'Block has been updated'));
            return $this->refresh();
        }

        return $this->render('update', [
            'model' => $model
        ]);
    }

    /**
     * Deletes an existing Block model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param  integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        \Yii::$app->getSession()->setFlash('block.success', \Yii::t('block', 'Block has been deleted'));

        return $this->redirect(['index']);
    }

    /**
     * Finds the Block model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param  integer                    $id
     * @return \wolfguard\block\models\Block the loaded model
     * @throws NotFoundHttpException      if the model cannot be found
     */
    protected function findModel($id)
    {
        $model = $this->module->manager->findBlockById($id);

        if ($model === null) {
            throw new NotFoundHttpException('The requested page does not exist');
        }

        return $model;
    }
}
