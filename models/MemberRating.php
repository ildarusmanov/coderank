<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "member_rating".
 *
 * @property int $id
 * @property int $member_id
 * @property int $rating_id
 * @property string $rating_handle
 * @property string $rating_member_id
 * @property string $link
 * @property int $rank
 * @property int $rating
 * @property string $rating_data
 *
 * @property Member $member
 * @property Rating $rating0
 */
class MemberRating extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'member_rating';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['member_id', 'rating_id', 'rating_handle'], 'required'],
            [['member_id', 'rating_id', 'rank', 'rating'], 'integer'],
            [['rating_data'], 'string'],
            [['rating_handle', 'rating_member_id', 'link'], 'string', 'max' => 255],
            [['member_id'], 'exist', 'skipOnError' => true, 'targetClass' => Member::className(), 'targetAttribute' => ['member_id' => 'id']],
            [['rating_id'], 'exist', 'skipOnError' => true, 'targetClass' => Rating::className(), 'targetAttribute' => ['rating_id' => 'id']],
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
            'rating_id' => Yii::t('app', 'Rating ID'),
            'rating_handle' => Yii::t('app', 'Rating Handle'),
            'rating_member_id' => Yii::t('app', 'Rating Member ID'),
            'link' => Yii::t('app', 'Link'),
            'rank' => Yii::t('app', 'Rank'),
            'rating' => Yii::t('app', 'Rating'),
            'rating_data' => Yii::t('app', 'Rating Data'),
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
    public function getRating0()
    {
        return $this->hasOne(Rating::className(), ['id' => 'rating_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMemberRatingContests()
    {
        return $this->hasOne(MemberRatingContest::className(), [
            'member_id' => 'member_id',
        ]);
    }
    /**
     * {@inheritdoc}
     * @return MemberRatingQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MemberRatingQuery(get_called_class());
    }
}
