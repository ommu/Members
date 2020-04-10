<?php
/**
 * MemberFollowerHistory
 * 
 * @author Putra Sudaryanto <putra@ommu.id>
 * @contact (+62)856-299-4114
 * @copyright Copyright (c) 2018 OMMU (www.ommu.id)
 * @created date 31 October 2018, 06:18 WIB
 * @link https://github.com/ommu/mod-member
 *
 * This is the model class for table "ommu_member_follower_history".
 *
 * The followings are the available columns in table "ommu_member_follower_history":
 * @property integer $id
 * @property integer $publish
 * @property integer $follower_id
 * @property string $creation_date
 * @property integer $creation_id
 *
 * The followings are the available model relations:
 * @property MemberFollowers $follower
 * @property Users $creation
 *
 */

namespace ommu\member\models;

use Yii;
use yii\helpers\Html;
use yii\helpers\Url;
use ommu\users\models\Users;

class MemberFollowerHistory extends \app\components\ActiveRecord
{
	use \ommu\traits\UtilityTrait;

	public $gridForbiddenColumn = [];

	public $creationDisplayname;
	public $profile_search;
	public $member_search;
	public $userDisplayname;

	/**
	 * @return string the associated database table name
	 */
	public static function tableName()
	{
		return 'ommu_member_follower_history';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return [
			[['follower_id'], 'required'],
			[['publish', 'follower_id', 'creation_id'], 'integer'],
			[['creation_date'], 'safe'],
			[['follower_id'], 'exist', 'skipOnError' => true, 'targetClass' => MemberFollowers::className(), 'targetAttribute' => ['follower_id' => 'id']],
		];
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return [
			'id' => Yii::t('app', 'ID'),
			'publish' => Yii::t('app', 'Follow'),
			'follower_id' => Yii::t('app', 'Follower'),
			'creation_date' => Yii::t('app', 'Creation Date'),
			'creation_id' => Yii::t('app', 'Creation'),
			'creationDisplayname' => Yii::t('app', 'Creation'),
			'profile_search' => Yii::t('app', 'Profile'),
			'member_search' => Yii::t('app', 'Member'),
			'userDisplayname' => Yii::t('app', 'User'),
		];
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getFollower()
	{
		return $this->hasOne(MemberFollowers::className(), ['id' => 'follower_id']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getCreation()
	{
		return $this->hasOne(Users::className(), ['user_id' => 'creation_id']);
	}

	/**
	 * {@inheritdoc}
	 * @return \ommu\member\models\query\MemberFollowerHistory the active query used by this AR class.
	 */
	public static function find()
	{
		return new \ommu\member\models\query\MemberFollowerHistory(get_called_class());
	}

	/**
	 * Set default columns to display
	 */
	public function init()
	{
		parent::init();

		if(!(Yii::$app instanceof \app\components\Application))
			return;

		if(!$this->hasMethod('search'))
			return;

		$this->templateColumns['_no'] = [
			'header' => '#',
			'class' => 'app\components\grid\SerialColumn',
			'contentOptions' => ['class'=>'center'],
		];
		if(!Yii::$app->request->get('follower')) {
			$this->templateColumns['profile_search'] = [
				'attribute' => 'profile_search',
				'value' => function($model, $key, $index, $column) {
					return isset($model->follower) ? $model->follower->member->profile->title->message : '-';
				},
				'filter' => MemberProfile::getProfile(),
			];
			$this->templateColumns['member_search'] = [
				'attribute' => 'member_search',
				'value' => function($model, $key, $index, $column) {
					return isset($model->follower) ? $model->follower->member->displayname : '-';
				},
			];
			$this->templateColumns['userDisplayname'] = [
				'attribute' => 'userDisplayname',
				'value' => function($model, $key, $index, $column) {
					return isset($model->follower) ? $model->follower->user->displayname : '-';
				},
			];
		}
		$this->templateColumns['creation_date'] = [
			'attribute' => 'creation_date',
			'value' => function($model, $key, $index, $column) {
				return Yii::$app->formatter->asDatetime($model->creation_date, 'medium');
			},
			'filter' => $this->filterDatepicker($this, 'creation_date'),
		];
		if(!Yii::$app->request->get('creation')) {
			$this->templateColumns['creationDisplayname'] = [
				'attribute' => 'creationDisplayname',
				'value' => function($model, $key, $index, $column) {
					return isset($model->creation) ? $model->creation->displayname : '-';
					// return $model->creationDisplayname;
				},
			];
		}
		if(!Yii::$app->request->get('trash')) {
			$this->templateColumns['publish'] = [
				'attribute' => 'publish',
				'value' => function($model, $key, $index, $column) {
					return $this->filterYesNo($model->publish);
				},
				'filter' => $this->filterYesNo(),
				'contentOptions' => ['class'=>'center'],
				'format' => 'raw',
			];
		}
	}

	/**
	 * User get information
	 */
	public static function getInfo($id, $column=null)
	{
		if($column != null) {
			$model = self::find();
			if(is_array($column))
				$model->select($column);
			else
				$model->select([$column]);
			$model = $model->where(['id' => $id])->one();
			return is_array($column) ? $model : $model->$column;
			
		} else {
			$model = self::findOne($id);
			return $model;
		}
	}

	/**
	 * before validate attributes
	 */
	public function beforeValidate()
	{
		if(parent::beforeValidate()) {
			if($this->isNewRecord) {
				if($this->creation_id == null)
					$this->creation_id = !Yii::$app->user->isGuest ? Yii::$app->user->id : null;
			}
		}
		return true;
	}
}
