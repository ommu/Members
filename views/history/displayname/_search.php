<?php
/**
 * Member History Displaynames (member-history-displayname)
 * @var $this yii\web\View
 * @var $this ommu\member\controllers\history\DisplaynameController
 * @var $model ommu\member\models\search\MemberHistoryDisplayname
 * @var $form yii\widgets\ActiveForm
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @contact (+62)856-299-4114
 * @copyright Copyright (c) 2018 Ommu Platform (www.ommu.co)
 * @created date 30 October 2018, 23:03 WIB
 * @link https://github.com/ommu/mod-member
 *
 */

use Yii;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use ommu\member\models\MemberProfile;
?>

<div class="member-history-displayname-search search-form">

	<?php $form = ActiveForm::begin([
		'action' => ['index'],
		'method' => 'get',
		'options' => [
			'data-pjax' => 1
		],
	]); ?>

		<?php $profile = MemberProfile::getProfile();
		echo $form->field($model, 'profile_search')
			->dropDownList($profile, ['prompt'=>'']);?>

		<?php echo $form->field($model, 'member_search');?>

		<?php echo $form->field($model, 'displayname');?>

		<?php echo $form->field($model, 'updated_date')
			->input('date');?>

		<?php echo $form->field($model, 'updated_search');?>

		<div class="form-group">
			<?php echo Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
			<?php echo Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
		</div>

	<?php ActiveForm::end(); ?>

</div>
