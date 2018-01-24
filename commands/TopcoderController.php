<?php
namespace app\commands;

class TopcoderController extends AbstractParserController
{
    protected function getRating()
    {
        return \app\models\Rating::find()->byLink('https://topcoder.com')->one();
    }

    protected function parseHandle($handle)
    {
        $json = json_decode(file_get_contents("http://api.topcoder.com/v2/users/{$handle}/statistics/data/srm"), true);

        $member = [
            'rating' => intval($json['rating']),
            'rank' => intval($json['rank']),
            'link' => "https://www.topcoder.com/members/{$handle}",
            'rating_member_id' => $json['handle'],
        ];

        $contests = [];

        foreach ($json['History'] as $item) {
            $datetime = strtotime(str_replace('.', '/', $item['date']) . ' 12:00');
            
            $contests[] = [
                'contest' => [
                    'title' => $item['challengeName'],
                    'date_timestamp' => intval($datetime),
                    'link' => "https://community.topcoder.com/stat?c=round_overview&rd={$item['challengeId']}",
                ],
                'result' => [
                    'rank' => intval($item['placement']),
                    'rating' => intval($item['rating']),
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
