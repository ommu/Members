<?php
/**
 * MemberUserlevel
 *
 * This is the ActiveQuery class for [[\ommu\member\models\MemberUserlevel]].
 * @see \ommu\member\models\MemberUserlevel
 * 
 * @author Putra Sudaryanto <putra@ommu.id>
 * @contact (+62)856-299-4114
 * @copyright Copyright (c) 2018 OMMU (www.ommu.id)
 * @created date 2 October 2018, 09:24 WIB
 * @link https://github.com/ommu/mod-member
 *
 */

namespace ommu\member\models\query;

class MemberUserlevel extends \yii\db\ActiveQuery
{
	/*
	public function active()
	{
		return $this->andWhere('[[status]]=1');
	}
	*/

	/**
	 * {@inheritdoc}
	 */
	public function published()
	{
		return $this->andWhere(['t.publish' => 1]);
	}

	/**
	 * {@inheritdoc}
	 */
	public function unpublish()
	{
		return $this->andWhere(['t.publish' => 0]);
	}

	/**
	 * {@inheritdoc}
	 */
	public function deleted()
	{
		return $this->andWhere(['t.publish' => 2]);
	}

	/**
	 * {@inheritdoc}
	 * @return \ommu\member\models\MemberUserlevel[]|array
	 */
	public function all($db = null)
	{
		return parent::all($db);
	}

	/**
	 * {@inheritdoc}
	 * @return \ommu\member\models\MemberUserlevel|array|null
	 */
	public function one($db = null)
	{
		return parent::one($db);
	}
}
