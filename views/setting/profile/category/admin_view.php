<?php
/**
 * Member Profile Categories (member-profile-category)
 * @var $this app\components\View
 * @var $this ommu\member\controllers\setting\profile\CategoryController
 * @var $model ommu\member\models\MemberProfileCategory
 *
 * @author Putra Sudaryanto <putra@ommu.co>
 * @contact (+62)856-299-4114
 * @copyright Copyright (c) 2018 Ommu Platform (www.ommu.co)
 * @created date 2 October 2018, 09:58 WIB
 * @modified date 28 October 2018, 21:38 WIB
 * @link https://github.com/ommu/mod-member
 *
 */

use yii\helpers\Html; 
use yii\helpers\Url;
use yii\widgets\DetailView;

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Profile Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->title->message;

if(!$small) {
$this->params['menu']['content'] = [
	['label' => Yii::t('app', 'Back To Manage'), 'url' => Url::to(['index', 'profile'=>$model->profile_id]), 'icon' => 'table'],
	['label' => Yii::t('app', 'Update'), 'url' => Url::to(['update', 'id'=>$model->cat_id]), 'htmlOptions' => ['class'=>'modal-btn'], 'icon' => 'pencil', 'htmlOptions' => ['class'=>'btn btn-primary']],
	['label' => Yii::t('app', 'Delete'), 'url' => Url::to(['delete', 'id'=>$model->cat_id]), 'htmlOptions' => ['data-confirm'=>Yii::t('app', 'Are you sure you want to delete this item?'), 'data-method'=>'post', 'class'=>'btn btn-danger'], 'icon' => 'trash'],
];
} ?>

<div class="member-profile-category-view">

<?php
$attributes = [
	[
		'attribute' => 'cat_id',
		'value' => $model->cat_id,
		'visible' => !$small,
	],
	[
		'attribute' => 'publish',
		'value' => $model->quickAction(Url::to(['publish', 'id'=>$model->primaryKey]), $model->publish, 'Enable,Disable'),
		'format' => 'raw',
		'visible' => !$small,
	],
	[
		'attribute' => 'profile_id',
		'value' => isset($model->profile) ? $model->profile->title->message : '-',
	],
	[
		'attribute' => 'parent_id',
		'value' => isset($model->parent) ? $model->parent->title->message : '-',
	],
	[
		'attribute' => 'cat_name_i',
		'value' => $model->cat_name_i,
	],
	[
		'attribute' => 'cat_desc_i',
		'value' => $model->cat_desc_i,
	],
	[
		'attribute' => 'creation_date',
		'value' => Yii::$app->formatter->asDatetime($model->creation_date, 'medium'),
		'visible' => !$small,
	],
	[
		'attribute' => 'creationDisplayname',
		'value' => isset($model->creation) ? $model->creation->displayname : '-',
	],
	[
		'attribute' => 'modified_date',
		'value' => Yii::$app->formatter->asDatetime($model->modified_date, 'medium'),
		'visible' => !$small,
	],
	[
		'attribute' => 'modifiedDisplayname',
		'value' => isset($model->modified) ? $model->modified->displayname : '-',
	],
	[
		'attribute' => 'updated_date',
		'value' => Yii::$app->formatter->asDatetime($model->updated_date, 'medium'),
		'visible' => !$small,
	],
	[
		'attribute' => '',
		'value' => Html::a(Yii::t('app', 'Update'), ['update', 'id'=>$model->primaryKey], ['title'=>Yii::t('app', 'Update'), 'class'=>'btn btn-primary']),
		'format' => 'html',
		'visible' => !$small && Yii::$app->request->isAjax ? true : false,
	],
];

echo DetailView::widget([
	'model' => $model,
	'options' => [
		'class'=>'table table-striped detail-view',
	],
	'attributes' => $attributes,
]); ?>

</div>