<?php
/**
 * Member Company Contacts (member-company-contact)
 * @var $this yii\web\View
 * @var $this ommu\member\controllers\manage\CompanyContactController
 * @var $model ommu\member\models\MemberCompanyContact
 * @var $form yii\widgets\ActiveForm
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @contact (+62)856-299-4114
 * @copyright Copyright (c) 2018 Ommu Platform (www.ommu.co)
 * @created date 1 November 2018, 19:49 WIB
 * @link https://github.com/ommu/mod-member
 *
 */

use Yii;
use yii\helpers\Url;

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Company Contacts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('app', 'Create');

$company = Yii::$app->request->get('company');
$this->params['menu']['content'] = [
	['label' => Yii::t('app', 'Back To Manage'), 'url' => Url::to(['index', 'company'=>$company]), 'icon' => 'table'],
];
?>

<div class="member-company-contact-create">

<?php echo $this->render('_form', [
	'model' => $model,
]); ?>

</div>
