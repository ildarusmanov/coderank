<?php
namespace app\commands;

use yii\console\Controller;
use yii\console\ExitCode;
use app\models\RatingContest;
use app\models\Member;
use app\models\MemberRating;
use app\models\MemberRatingContest;

abstract class AbstractParserController extends Controller
{
    public function actionParse()
    {
        $this->processMemberRatings();
    }


    /**
     * Get ActiveQuery object for current rating
     * @return \yii\db\ActiveQuery
     */
    protected function getMemberRatingsQuery()
    {
        return $this->getRating()->getMemberRatings();
    }

    /**
     * process loaded member ratings
     * @return null
     */
    protected function processMemberRatings()
    {
        foreach ($this->getMemberRatingsQuery()->each() as $memberRating) {
            $this->processMemberRating($memberRating);
        }
    }

    /**
     * Process one item per call
     * @param  \app\models\MemberRating $memberRating
     * @return null
     */
    protected function processMemberRating($memberRating)
    {
        try {
            $parsedData = $this->parseHandle($memberRating->rating_handle);
            sleep(1);
        } catch (\Exception $e) {

            echo "Error! Can not parse from {$this->getRating()->title}"
                . " for {$memberRating->rating_handle}"
                . " with {$e->getMessage()}\n";

            return;
        }

        $this->saveParsed(
            $memberRating,
            $parsedData
        );        
    }

    protected function saveParsed($memberRating, $parsed)
    {
        $this->saveMemberRating($memberRating, $parsed['member']);
        $this->saveContests($memberRating, $parsed['contests']);
    }

    protected function saveMemberRating($memberRating, $memberArr)
    {
        foreach ($memberArr as $key => $val) {
            $memberRating->$key = $val;
        }

        return $memberRating->save();
    }

    protected function saveContests($memberRating, $contests)
    {
        foreach ($contests as $contest) {
            $this->saveContest($memberRating, $contest);
        }
    }

    /**
     * [saveContest description]
     * @param  \app\models\MemberRating $memberRating
     * @param  array $data
     * @return bool
     */
    protected function saveContest($memberRating, $data)
    {
        $ratingContest = $this->findOrCreateRatingContest(
            $memberRating->rating_id,
            $data['contest']
        );

        if ($ratingContest == null) {
            throw new \Exception("Null RatingContest object");
        } 

        $this->saveContestResult(
            $memberRating,
            $ratingContest,
            $data['result']
        );
    }

    /**
     * [findOrCreateRatingContest description]
     * @param  int $ratingId
     * @param  array $contest
     * @return \app\models\RatingContest
     */
    protected function findOrCreateRatingContest($ratingId, $contestArr)
    {
        $ratingContest = RatingContest::find()
            ->byRatingId($ratingId)
            ->byTitle($contestArr['title'])
            ->one();

        if ($ratingContest == null) {
            $ratingContest = new RatingContest();
            $ratingContest->rating_id = $ratingId;
        }

        foreach ($contestArr as $key => $val) {
            $ratingContest->$key = $val;
        }

        if (!$ratingContest->save()) {
            return null;
        }

        return $ratingContest;
    }

    /**
     * [saveContestResult description]
     * @param  \app\models\MemberRating $memberRating
     * @param  \app\models\RatingContest $ratingContest
     * @param  array $resultData
     * @return bool 
     */
    protected function saveContestResult($memberRating, $ratingContest, $resultData)
    {
        $memberContest = $memberRating
            ->getMemberRatingContests()
            ->where(['rating_contest_id' => $ratingContest->id])
            ->one();

        if ($memberContest == null) {
            $memberContest = new MemberRatingContest();
            $memberContest->member_id = $memberRating->member_id;
            $memberContest->rating_contest_id = $ratingContest->id;
        }

        foreach ($resultData as $key => $val) {
            $memberContest->$key = $val;
        }

        return $memberContest->save();
    }

    /**
     * Get current rating model
     * @return app\models\Rating
     */
    abstract protected function getRating();

    /**
     *
     * @param  string $handle
     * @return array
     */
    abstract protected function parseHandle($handle);
}
