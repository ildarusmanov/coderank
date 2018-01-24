<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[MemberRatingContest]].
 *
 * @see MemberRatingContest
 */
class MemberRatingContestQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return MemberRatingContest[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return MemberRatingContest|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
