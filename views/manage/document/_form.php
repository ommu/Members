<?php
/**
 * Member Documents (member-documents)
 * @var $this app\components\View
 * @var $this ommu\member\controllers\manage\DocumentController
 * @var $model ommu\member\models\MemberDocuments
 * @var $form app\components\widgets\ActiveForm
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @contact (+62)856-299-4114
 * @copyright Copyright (c) 2018 Ommu Platform (www.ommu.co)
 * @created date 1 November 2018, 09:12 WIB
 * @link https://github.com/ommu/mod-member
 *
 */

use yii\helpers\Html;
use yii\helpers\Url;
use app\components\widgets\ActiveForm;
use ommu\member\models\MemberDocuments;
?>

<div class="member-documents-form">

<?php $form = ActiveForm::begin([
	'options' => [
		'class' => 'form-horizontal form-label-left',
		'enctype' => 'multipart/form-data',
	],
	'enableClientValidation' => false,
	'enableAjaxValidation' => false,
	//'enableClientScript' => true,
]); ?>

<?php //echo $form->errorSummary($model);?>

<?php echo $form->field($model, 'profile_document_id')
	->dropDownList($document, ['prompt'=>''])
	->label($model->getAttributeLabel('profile_document_id')); ?>

<?php $documentFilename = !$model->isNewRecord && $model->old_document_filename_i != '' ? Html::img(join('/', [Url::Base(), MemberDocuments::getUploadPath(false), $model->old_document_filename_i]), ['class'=>'mb-15', 'width'=>'100%']) : '';
echo $form->field($model, 'document_filename', ['template' => '{label}{beginWrapper}<div>'.$documentFilename.'</div>{input}{error}{hint}{endWrapper}'])
	->fileInput()
	->label($model->getAttributeLabel('document_filename')); ?>

<?php echo $form->field($model, 'status')
	->checkbox()
	->label($model->getAttributeLabel('status')); ?>

<?php echo $form->field($model, 'publish')
	->checkbox()
	->label($model->getAttributeLabel('publish')); ?>

<div class="ln_solid"></div>

<?php echo $form->field($model, 'submitButton')
	->submitButton(); ?>

<?php ActiveForm::end(); ?>

</div>