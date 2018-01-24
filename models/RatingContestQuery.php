<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[RatingContest]].
 *
 * @see RatingContest
 */
class RatingContestQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return RatingContest[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return RatingContest|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function byRatingId($ratingId)
    {
        return $this->andWhere(['rating_id' => $ratingId]);
    }

    public function byTitle($contestTitle)
    {
        return $this->andWhere(['title' => $contestTitle]);
    }
}
