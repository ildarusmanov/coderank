<?php
namespace app\commands;

class AtcoderController extends AbstractParserController
{
    protected function getRating()
    {
        return \app\models\Rating::find()->byLink('http://atcoder.jp')->one();
    }

    protected function parseHandle($handle)
    {
        $userHtml = file_get_contents("http://atcoder.jp/user/{$handle}");
        $contestsHtml = file_get_contents("http://atcoder.jp/user/{$handle}/history");

        $ratingRegex = "/<dt>Rank<\/dt><dd>(?<rank>[^<]*)<\/dd>\s*<dt>Rating<\/dt><dd><span\s*class='[^']+'>(?<rating>\d+)<\/span><\/dd>/siU";

        $contestRegex = "/<tr class=\"text-center\">\s*<td>(?<date>[^<]+)<\/td>\s*<td class=\"text-left\"><a href=\"(?<link>[^\"\"]+)\">(?<title>[^<]+)<\/a><\/td>\s*<td>(?<rank>[^<]+)<\/td>\s*<td>(?<perf>[^<]+)<\/td>\s*<td><span class='[^']+'>(?<rating>[^<]+)<\/span><\/td>\s*<td data-order=\"[^\"]+\">(?<diff>[^<]+)<\/td>\s*<\/tr>/siU";

        $found = preg_match_all($ratingRegex, $userHtml, $ratingResult);

        if ($found == 0) {
            throw new \Exception("not found");
        }

        preg_match_all($contestRegex, $contestsHtml, $contestResult);

        $member = [
            'rating' => intval($ratingResult['rating'][0]),
            'rank' => intval($ratingResult['rank'][0]),
            'link' => "http://atcoder.jp/user/{$handle}",
            'rating_member_id' => $handle,
        ];

        $contests = [];

        for ($i = 0; $i < count($contestResult[0]); $i++) {
            $contests[] = [
                'contest' => [
                    'title' =>  $contestResult['title'][$i],
                    'date_timestamp' => strtotime($contestResult['date'][$i]),
                    'link' => $contestResult['link'][$i],
                ],
                'result' => [
                    'rank' => intval($contestResult['rank'][$i]),
                    'rating' => intval($contestResult['rating'][$i]),
                    'results' => json_encode([
                        'oldRating' => intval($contestResult['rating'][$i]) + intval($contestResult['diff'][$i]),
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
