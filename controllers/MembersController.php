<?php
namespace app\controllers;

use app\models\Member;
use app\models\MemberRating;
use app\models\MemberRatingContest;

class MembersController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $members = Member::find()->all();
        $ratings = [];

        foreach (MemberRating::find()->with('rating0')->each() as $memberRating) {
            $memberId = $memberRating->member_id;
            $ratingId = $memberRating->rating0->link;

            $ratings[$memberId][$ratingId] = $memberRating;
        }

        return $this->render('index', [
            'members' => $members,
            'ratings' => $ratings,
        ]);
    }

    public function actionView($id)
    {
        $member = $this->findMember($id);

        $ratingsIds = array_map(function($item) {
            return $item->id;
        }, $member->memberRatings);

        $contests = MemberRatingContest::find()
            ->joinWith('ratingContest')
            ->where(['member_id' => $member->id,])
            ->orderBy('date_timestamp DESC')
            ->all();

        return $this->render('view', [
            'member' => $member,
            'contests' => $contests,
        ]);
    }

    protected function findMember($id)
    {
        $member = Member::findOne($id);

        if ($member == null) {
            throw new \yii\web\NotFoundHttpException();
        }

        return $member;
    }
}
