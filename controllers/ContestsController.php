<?php
namespace app\controllers;

use app\models\RatingContest;

class ContestsController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $query = RatingContest::find()->orderBy('date_timestamp DESC');

        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => $query,
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        $ratingContest = $this->findRatingContest($id);
        $memberContests = $ratingContest
            ->getMemberRatingContests()
            ->with('member')
            ->orderBy("rating DESC")
            ->all();

        return $this->render('view', [
            'ratingContest' => $ratingContest,
            'memberContests' => $memberContests,
        ]);
    }

    protected function findRatingContest($id)
    {
        $ratingContest = RatingContest::findOne($id);

        if ($ratingContest == null) {
            throw new \yii\web\NotFoundHttpException();
        }

        return $ratingContest;
    }
}
