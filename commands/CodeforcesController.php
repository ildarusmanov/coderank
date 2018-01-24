<?php
namespace app\commands;

use app\models\Rating;

class CodeforcesController extends AbstractParserController
{
    protected function getRating()
    {
        return \app\models\Rating::find()->byLink('http://codeforces.com')->one();
    }

    protected function parseHandle($handle)
    {
        $jsonUser = json_decode(file_get_contents("http://codeforces.com/api/user.info?handles={$handle}"),true);
        $jsonUser = $jsonUser['result'][0];
        $jsonContests = json_decode(file_get_contents("http://codeforces.com/api/user.rating?handle={$handle}"), true);

        $member = [
            'rating' => intval($jsonUser['rating']),
            'rank' => intval($jsonUser['rating']),
            'link' => "http://codeforces.com/profile/{$handle}",
            'rating_member_id' => $jsonUser['handle'],
        ];

        $contests = [];

        foreach ($jsonContests['result'] as $item) {
            $contests[] = [
                'contest' => [
                    'title' => $item['contestName'],
                    'date_timestamp' => $item['ratingUpdateTimeSeconds'],
                    'link' => "http://codeforces.com/contest/{$item['contestId']}",
                ],
                'result' => [
                    'rank' => intval($item['rank']),
                    'rating' => intval($item['newRating']),
                    'results' => json_encode([
                        'oldRating' => intval($item['oldRating']),
                    ]),
                ],
            ];
        }

        $result = [
            'member' => $member,
            'contests' => $contests,
        ];

        return $result;
    }
}
