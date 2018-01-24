<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rating_contest".
 *
 * @property int $id
 * @property int $rating_id
 * @property string $title
 * @property int $date_timestamp
 * @property string $link
 *
 * @property MemberRatingContest[] $memberRatingContests
 * @property Rating $rating
 */
class RatingContest extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rating_contest';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['rating_id', 'title', 'date_timestamp'], 'required'],
            [['rating_id', 'date_timestamp'], 'integer'],
            [['title', 'link'], 'string', 'max' => 255],
            [['title'], 'unique', 'targetAttribute' => 'rating_id'],
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
            'rating_id' => Yii::t('app', 'Rating ID'),
            'title' => Yii::t('app', 'Title'),
            'date_timestamp' => Yii::t('app', 'Date Timestamp'),
            'link' => Yii::t('app', 'Link'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMemberRatingContests()
    {
        return $this->hasMany(MemberRatingContest::className(), [
            'rating_contest_id' => 'id',
        ]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRating()
    {
        return $this->hasOne(Rating::className(), ['id' => 'rating_id']);
    }

    /**
     * {@inheritdoc}
     * @return RatingContestQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RatingContestQuery(get_called_class());
    }

    public function getDate()
    {
        return date('d.m.Y', $this->date_timestamp);
    }
}
