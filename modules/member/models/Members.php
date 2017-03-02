<?php
/**
 * Members
 * version: 0.0.1
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @copyright Copyright (c) 2017 Ommu Platform (opensource.ommu.co)
 * @created date 2 March 2017, 09:36 WIB
 * @link https://github.com/ommu/Members
 * @contact (+62)856-299-4114
 *
 * This is the template for generating the model class of a specified table.
 * - $this: the ModelCode object
 * - $tableName: the table name for this class (prefix is already removed if necessary)
 * - $modelClass: the model class name
 * - $columns: list of table columns (name=>CDbColumnSchema)
 * - $labels: list of attribute labels (name=>label)
 * - $rules: list of validation rules
 * - $relations: list of relations (name=>relation declaration)
 *
 * --------------------------------------------------------------------------------------
 *
 * This is the model class for table "ommu_members".
 *
 * The followings are the available columns in table 'ommu_members':
 * @property string $member_id
 * @property integer $publish
 * @property integer $profile_id
 * @property string $member_header
 * @property string $member_photo
 * @property string $short_biography
 * @property string $creation_date
 * @property string $creation_id
 * @property string $modified_date
 * @property string $modified_id
 *
 * The followings are the available model relations:
 * @property OmmuCvBio[] $ommuCvBios
 * @property OmmuCvEducationAssure[] $ommuCvEducationAssures
 * @property OmmuCvEducations[] $ommuCvEducations
 * @property OmmuCvExperienceAssure[] $ommuCvExperienceAssures
 * @property OmmuCvExperiences[] $ommuCvExperiences
 * @property OmmuCvOrganizations[] $ommuCvOrganizations
 * @property OmmuCvPortfolioAssure[] $ommuCvPortfolioAssures
 * @property OmmuCvPortfolios[] $ommuCvPortfolioses
 * @property OmmuCvPositiveNegative[] $ommuCvPositiveNegatives
 * @property OmmuCvReferences[] $ommuCvReferences
 * @property OmmuCvReferences[] $ommuCvReferences1
 * @property OmmuCvSkillAssure[] $ommuCvSkillAssures
 * @property OmmuCvSkills[] $ommuCvSkills
 * @property OmmuCvTrainings[] $ommuCvTrainings
 * @property OmmuMemberCompany[] $ommuMemberCompanies
 * @property OmmuMemberUser[] $ommuMemberUsers
 * @property OmmuMemberProfile $profile
 * @property OmmuVacancies[] $ommuVacancies
 */
class Members extends CActiveRecord
{
	public $defaultColumns = array();

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Members the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ommu_members';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('profile_id, member_header, member_photo, short_biography, creation_date, creation_id, modified_id', 'required'),
			array('publish, profile_id', 'numerical', 'integerOnly'=>true),
			array('creation_id, modified_id', 'length', 'max'=>11),
			array('modified_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('member_id, publish, profile_id, member_header, member_photo, short_biography, creation_date, creation_id, modified_date, modified_id', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'ommuCvBios_relation' => array(self::HAS_MANY, 'OmmuCvBio', 'member_id'),
			'ommuCvEducationAssures_relation' => array(self::HAS_MANY, 'OmmuCvEducationAssure', 'member_id'),
			'ommuCvEducations_relation' => array(self::HAS_MANY, 'OmmuCvEducations', 'member_id'),
			'ommuCvExperienceAssures_relation' => array(self::HAS_MANY, 'OmmuCvExperienceAssure', 'member_id'),
			'ommuCvExperiences_relation' => array(self::HAS_MANY, 'OmmuCvExperiences', 'member_id'),
			'ommuCvOrganizations_relation' => array(self::HAS_MANY, 'OmmuCvOrganizations', 'member_id'),
			'ommuCvPortfolioAssures_relation' => array(self::HAS_MANY, 'OmmuCvPortfolioAssure', 'member_id'),
			'ommuCvPortfolioses_relation' => array(self::HAS_MANY, 'OmmuCvPortfolios', 'member_id'),
			'ommuCvPositiveNegatives_relation' => array(self::HAS_MANY, 'OmmuCvPositiveNegative', 'member_id'),
			'ommuCvReferences_relation' => array(self::HAS_MANY, 'OmmuCvReferences', 'member_id'),
			'ommuCvReferences1_relation' => array(self::HAS_MANY, 'OmmuCvReferences', 'referee_member_id'),
			'ommuCvSkillAssures_relation' => array(self::HAS_MANY, 'OmmuCvSkillAssure', 'member_id'),
			'ommuCvSkills_relation' => array(self::HAS_MANY, 'OmmuCvSkills', 'member_id'),
			'ommuCvTrainings_relation' => array(self::HAS_MANY, 'OmmuCvTrainings', 'member_id'),
			'ommuMemberCompanies_relation' => array(self::HAS_MANY, 'OmmuMemberCompany', 'member_id'),
			'ommuMemberUsers_relation' => array(self::HAS_MANY, 'OmmuMemberUser', 'member_id'),
			'profile_relation' => array(self::BELONGS_TO, 'OmmuMemberProfile', 'profile_id'),
			'ommuVacancies_relation' => array(self::HAS_MANY, 'OmmuVacancies', 'member_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'member_id' => Yii::t('attribute', 'Member'),
			'publish' => Yii::t('attribute', 'Publish'),
			'profile_id' => Yii::t('attribute', 'Profile'),
			'member_header' => Yii::t('attribute', 'Member Header'),
			'member_photo' => Yii::t('attribute', 'Member Photo'),
			'short_biography' => Yii::t('attribute', 'Short Biography'),
			'creation_date' => Yii::t('attribute', 'Creation Date'),
			'creation_id' => Yii::t('attribute', 'Creation'),
			'modified_date' => Yii::t('attribute', 'Modified Date'),
			'modified_id' => Yii::t('attribute', 'Modified'),
		);
		/*
			'Member' => 'Member',
			'Publish' => 'Publish',
			'Profile' => 'Profile',
			'Member Header' => 'Member Header',
			'Member Photo' => 'Member Photo',
			'Short Biography' => 'Short Biography',
			'Creation Date' => 'Creation Date',
			'Creation' => 'Creation',
			'Modified Date' => 'Modified Date',
			'Modified' => 'Modified',
		
		*/
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('t.member_id',strtolower($this->member_id),true);
		if(isset($_GET['type']) && $_GET['type'] == 'publish')
			$criteria->compare('t.publish',1);
		elseif(isset($_GET['type']) && $_GET['type'] == 'unpublish')
			$criteria->compare('t.publish',0);
		elseif(isset($_GET['type']) && $_GET['type'] == 'trash')
			$criteria->compare('t.publish',2);
		else {
			$criteria->addInCondition('t.publish',array(0,1));
			$criteria->compare('t.publish',$this->publish);
		}
		if(isset($_GET['profile']))
			$criteria->compare('t.profile_id',$_GET['profile']);
		else
			$criteria->compare('t.profile_id',$this->profile_id);
		$criteria->compare('t.member_header',strtolower($this->member_header),true);
		$criteria->compare('t.member_photo',strtolower($this->member_photo),true);
		$criteria->compare('t.short_biography',strtolower($this->short_biography),true);
		if($this->creation_date != null && !in_array($this->creation_date, array('0000-00-00 00:00:00', '0000-00-00')))
			$criteria->compare('date(t.creation_date)',date('Y-m-d', strtotime($this->creation_date)));
		if(isset($_GET['creation']))
			$criteria->compare('t.creation_id',$_GET['creation']);
		else
			$criteria->compare('t.creation_id',$this->creation_id);
		if($this->modified_date != null && !in_array($this->modified_date, array('0000-00-00 00:00:00', '0000-00-00')))
			$criteria->compare('date(t.modified_date)',date('Y-m-d', strtotime($this->modified_date)));
		if(isset($_GET['modified']))
			$criteria->compare('t.modified_id',$_GET['modified']);
		else
			$criteria->compare('t.modified_id',$this->modified_id);

		if(!isset($_GET['Members_sort']))
			$criteria->order = 't.member_id DESC';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
				'pageSize'=>30,
			),
		));
	}


	/**
	 * Get column for CGrid View
	 */
	public function getGridColumn($columns=null) {
		if($columns !== null) {
			foreach($columns as $val) {
				/*
				if(trim($val) == 'enabled') {
					$this->defaultColumns[] = array(
						'name'  => 'enabled',
						'value' => '$data->enabled == 1? "Ya": "Tidak"',
					);
				}
				*/
				$this->defaultColumns[] = $val;
			}
		} else {
			//$this->defaultColumns[] = 'member_id';
			$this->defaultColumns[] = 'publish';
			$this->defaultColumns[] = 'profile_id';
			$this->defaultColumns[] = 'member_header';
			$this->defaultColumns[] = 'member_photo';
			$this->defaultColumns[] = 'short_biography';
			$this->defaultColumns[] = 'creation_date';
			$this->defaultColumns[] = 'creation_id';
			$this->defaultColumns[] = 'modified_date';
			$this->defaultColumns[] = 'modified_id';
		}

		return $this->defaultColumns;
	}

	/**
	 * Set default columns to display
	 */
	protected function afterConstruct() {
		if(count($this->defaultColumns) == 0) {
			/*
			$this->defaultColumns[] = array(
				'class' => 'CCheckBoxColumn',
				'name' => 'id',
				'selectableRows' => 2,
				'checkBoxHtmlOptions' => array('name' => 'trash_id[]')
			);
			*/
			$this->defaultColumns[] = array(
				'header' => 'No',
				'value' => '$this->grid->dataProvider->pagination->currentPage*$this->grid->dataProvider->pagination->pageSize + $row+1'
			);
			if(!isset($_GET['type'])) {
				$this->defaultColumns[] = array(
					'name' => 'publish',
					'value' => 'Utility::getPublish(Yii::app()->controller->createUrl("publish",array("id"=>$data->member_id)), $data->publish, 1)',
					'htmlOptions' => array(
						'class' => 'center',
					),
					'filter'=>array(
						1=>Yii::t('phrase', 'Yes'),
						0=>Yii::t('phrase', 'No'),
					),
					'type' => 'raw',
				);
			}
			$this->defaultColumns[] = 'profile_id';
			$this->defaultColumns[] = 'member_header';
			$this->defaultColumns[] = 'member_photo';
			$this->defaultColumns[] = 'short_biography';
			$this->defaultColumns[] = array(
				'name' => 'creation_date',
				'value' => 'Utility::dateFormat($data->creation_date)',
				'htmlOptions' => array(
					'class' => 'center',
				),
				'filter' => Yii::app()->controller->widget('zii.widgets.jui.CJuiDatePicker', array(
					'model'=>$this,
					'attribute'=>'creation_date',
					'language' => 'ja',
					'i18nScriptFile' => 'jquery.ui.datepicker-en.js',
					//'mode'=>'datetime',
					'htmlOptions' => array(
						'id' => 'creation_date_filter',
					),
					'options'=>array(
						'showOn' => 'focus',
						'dateFormat' => 'dd-mm-yy',
						'showOtherMonths' => true,
						'selectOtherMonths' => true,
						'changeMonth' => true,
						'changeYear' => true,
						'showButtonPanel' => true,
					),
				), true),
			);
			$this->defaultColumns[] = 'creation_id';
			$this->defaultColumns[] = array(
				'name' => 'modified_date',
				'value' => 'Utility::dateFormat($data->modified_date)',
				'htmlOptions' => array(
					'class' => 'center',
				),
				'filter' => Yii::app()->controller->widget('zii.widgets.jui.CJuiDatePicker', array(
					'model'=>$this,
					'attribute'=>'modified_date',
					'language' => 'ja',
					'i18nScriptFile' => 'jquery.ui.datepicker-en.js',
					//'mode'=>'datetime',
					'htmlOptions' => array(
						'id' => 'modified_date_filter',
					),
					'options'=>array(
						'showOn' => 'focus',
						'dateFormat' => 'dd-mm-yy',
						'showOtherMonths' => true,
						'selectOtherMonths' => true,
						'changeMonth' => true,
						'changeYear' => true,
						'showButtonPanel' => true,
					),
				), true),
			);
			$this->defaultColumns[] = 'modified_id';
		}
		parent::afterConstruct();
	}

	/**
	 * User get information
	 */
	public static function getInfo($id, $column=null)
	{
		if($column != null) {
			$model = self::model()->findByPk($id,array(
				'select' => $column
			));
			return $model->$column;
			
		} else {
			$model = self::model()->findByPk($id);
			return $model;			
		}
	}

	/**
	 * before validate attributes
	 */
	/*
	protected function beforeValidate() {
		if(parent::beforeValidate()) {
			// Create action
		}
		return true;
	}
	*/

	/**
	 * after validate attributes
	 */
	/*
	protected function afterValidate()
	{
		parent::afterValidate();
			// Create action
		return true;
	}
	*/
	
	/**
	 * before save attributes
	 */
	/*
	protected function beforeSave() {
		if(parent::beforeSave()) {
		}
		return true;	
	}
	*/
	
	/**
	 * After save attributes
	 */
	/*
	protected function afterSave() {
		parent::afterSave();
		// Create action
	}
	*/

	/**
	 * Before delete attributes
	 */
	/*
	protected function beforeDelete() {
		if(parent::beforeDelete()) {
			// Create action
		}
		return true;
	}
	*/

	/**
	 * After delete attributes
	 */
	/*
	protected function afterDelete() {
		parent::afterDelete();
		// Create action
	}
	*/

}