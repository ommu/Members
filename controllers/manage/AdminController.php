<?php
/**
 * AdminController
 * @var $this yii\web\View
 * @var $model ommu\member\models\Members
 *
 * AdminController implements the CRUD actions for Members model.
 * Reference start
 * TOC :
 *	Index
 *	Create
 *	Update
 *	View
 *	Delete
 *	RunAction
 *	Publish
 *	Approved
 *	MemberPrivate
 *
 *	findModel
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @contact (+62)856-299-4114
 * @copyright Copyright (c) 2018 Ommu Platform (www.ommu.co)
 * @created date 30 October 2018, 22:51 WIB
 * @link https://github.com/ommu/mod-member
 *
 */
 
namespace ommu\member\controllers\manage;

use Yii;
use yii\filters\VerbFilter;
use app\components\Controller;
use mdm\admin\components\AccessControl;
use ommu\member\models\Members;
use ommu\member\models\search\Members as MembersSearch;

class AdminController extends Controller
{
	/**
	 * {@inheritdoc}
	 */
	public function behaviors()
	{
		return [
			'access' => [
				'class' => AccessControl::className(),
			],
			'verbs' => [
				'class' => VerbFilter::className(),
				'actions' => [
					'delete' => ['POST'],
					'publish' => ['POST'],
					'approved' => ['POST'],
					'member-private' => ['POST'],
				],
			],
		];
	}

	/**
	 * Lists all Members models.
	 * @return mixed
	 */
	public function actionIndex()
	{
		$searchModel = new MembersSearch();
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

		$gridColumn = Yii::$app->request->get('GridColumn', null);
		$cols = [];
		if($gridColumn != null && count($gridColumn) > 0) {
			foreach($gridColumn as $key => $val) {
				if($gridColumn[$key] == 1)
					$cols[] = $key;
			}
		}
		$columns = $searchModel->getGridColumn($cols);

		$this->view->title = Yii::t('app', 'Members');
		$this->view->description = '';
		$this->view->keywords = '';
		return $this->render('admin_index', [
			'searchModel' => $searchModel,
			'dataProvider' => $dataProvider,
			'columns' => $columns,
		]);
	}

	/**
	 * Creates a new Members model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate()
	{
		$model = new Members();

		if(Yii::$app->request->isPost) {
			$model->load(Yii::$app->request->post());
			if($model->save()) {
				Yii::$app->session->setFlash('success', Yii::t('app', 'Member success created.'));
				return $this->redirect(['index']);
				//return $this->redirect(['view', 'id'=>$model->member_id]);
			}
		}

		$this->view->title = Yii::t('app', 'Create Member');
		$this->view->description = '';
		$this->view->keywords = '';
		return $this->render('admin_create', [
			'model' => $model,
		]);
	}

	/**
	 * Updates an existing Members model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionUpdate($id)
	{
		$model = $this->findModel($id);
		if(Yii::$app->request->isPost) {
			$model->load(Yii::$app->request->post());

			if($model->save()) {
				Yii::$app->session->setFlash('success', Yii::t('app', 'Member success updated.'));
				return $this->redirect(['index']);
				//return $this->redirect(['view', 'id'=>$model->member_id]);
			}
		}

		$this->view->title = Yii::t('app', 'Update {model-class}: {username}', ['model-class' => 'Member', 'username' => $model->displayname]);
		$this->view->description = '';
		$this->view->keywords = '';
		return $this->render('admin_update', [
			'model' => $model,
		]);
	}

	/**
	 * Displays a single Members model.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionView($id)
	{
		$model = $this->findModel($id);

		$this->view->title = Yii::t('app', 'Detail {model-class}: {username}', ['model-class' => 'Member', 'username' => $model->displayname]);
		$this->view->description = '';
		$this->view->keywords = '';
		return $this->oRender('admin_view', [
			'model' => $model,
		]);
	}

	/**
	 * Deletes an existing Members model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionDelete($id)
	{
		$model = $this->findModel($id);
		$model->publish = 2;

		if($model->save(false, ['publish','modified_id'])) {
			Yii::$app->session->setFlash('success', Yii::t('app', 'Member success deleted.'));
			return $this->redirect(['index']);
		}
	}

	/**
	 * actionPublish an existing Members model.
	 * If publish is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionPublish($id)
	{
		$model = $this->findModel($id);
		$replace = $model->publish == 1 ? 0 : 1;
		$model->publish = $replace;

		if($model->save(false, ['publish','modified_id'])) {
			Yii::$app->session->setFlash('success', Yii::t('app', 'Member success updated.'));
			return $this->redirect(['index']);
		}
	}

	/**
	 * actionApproved an existing Members model.
	 * If approved is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionApproved($id)
	{
		$model = $this->findModel($id);
		$replace = $model->approved == 1 ? 0 : 1;
		$model->approved = $replace;

		if($model->save(false, ['approved','approved_id'])) {
			Yii::$app->session->setFlash('success', Yii::t('app', 'Member success updated.'));
			return $this->redirect(['index']);
		}
	}

	/**
	 * Finds the Members model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return Members the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id)
	{
		if(($model = Members::findOne($id)) !== null)
			return $model;

		throw new \yii\web\NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
	}
}
