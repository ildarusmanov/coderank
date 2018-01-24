<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "member_rating_contest".
 *
 * @property int $id
 * @property int $member_id
 * @property int $rating_contest_id
 * @property int $rank
 * @property int $rating
 * @property string $results
 *
 * @property Member $member
 * @property RatingContest $ratingContest
 */
class MemberRatingContest extends \yii\db\ActiveRecord
{
    protected $_ratingsDiff;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'member_rating_contest';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['member_id', 'rating_contest_id'], 'required'],
            [['member_id', 'rating_contest_id', 'rank', 'rating'], 'integer'],
            [['results'], 'string'],
            [['member_id'], 'exist', 'skipOnError' => true, 'targetClass' => Member::className(), 'targetAttribute' => ['member_id' => 'id']],
            [['rating_contest_id'], 'exist', 'skipOnError' => true, 'targetClass' => RatingContest::className(), 'targetAttribute' => ['rating_contest_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'member_id' => Yii::t('app', 'Member ID'),
            'rating_contest_id' => Yii::t('app', 'Rating Contest ID'),
            'rank' => Yii::t('app', 'Rank'),
            'rating' => Yii::t('app', 'Rating'),
            'results' => Yii::t('app', 'Results'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMember()
    {
        return $this->hasOne(Member::className(), ['id' => 'member_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRatingContest()
    {
        return $this->hasOne(RatingContest::className(), ['id' => 'rating_contest_id']);
    }

    /**
     * {@inheritdoc}
     * @return MemberRatingContestQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MemberRatingContestQuery(get_called_class());
    }

    public function getRatingsDiff()
    {
        if ($this->_ratingsDiff != null) {
            return $this->_ratingsDiff;
        }

        $json = json_decode($this->results, true);

        if (!isset($json['oldRating'])) {
            $this->_ratingsDiff = 0;
        } else {
            $this->_ratingsDiff = $this->rating - $json['oldRating'];
        }

        return $this->_ratingsDiff;
    }
}
