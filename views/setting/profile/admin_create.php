<?php
/**
 * Member Profiles (member-profile)
 * @var $this yii\web\View
 * @var $this ommu\member\controllers\setting\ProfileController
 * @var $model ommu\member\models\MemberProfile
 * @var $form yii\widgets\ActiveForm
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @contact (+62)856-299-4114
 * @copyright Copyright (c) 2018 Ommu Platform (www.ommu.co)
 * @created date 2 October 2018, 09:48 WIB
 * @link https://github.com/ommu/mod-member
 *
 */

use yii\helpers\Url;

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Profiles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('app', 'Create');
?>

<div class="member-profile-create">

<?php echo $this->render('_form', [
	'model' => $model,
]); ?>

</div>