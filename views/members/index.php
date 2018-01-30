<?php
use yii\helpers\Url;

$this->title = 'Members list';

/* @var $this yii\web\View */
?>
<h1><?= $this->title ?></h1>


<table class="table" id="members-table">
    <thead>
        <tr>
            <th>Full Name</th>
            <th>Topcoder</th>
            <th>Codeforces</th>
            <th>Atcoder</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($members as $member): ?>
            <?php 
            $mR = $ratings[$member->id];
            ?>
            <tr>
                <td>
                    <a href="<?= Url::to(['view', 'id' => $member->id]) ?>"><?= $member->full_name ?></a>
                </td>
                <td>
                    <?php if (isset($mR['https://topcoder.com'])): ?>
                        <a href="<?= $mR['https://topcoder.com']->link ?>" target="_blank">
                            <?= $mR['https://topcoder.com']->rating ?> /
                            <?= $mR['https://topcoder.com']->rank ?>
                        </a>
                    <?php else: ?>
                        -
                    <?php endif; ?>
                </td>
                <td>
                    <?php if (isset($mR['http://codeforces.com'])): ?>
                        <a href="<?= $mR['http://codeforces.com']->link ?>" target="_blank">
                            <?= $mR['http://codeforces.com']->rating ?> / 
                            <?= $mR['http://codeforces.com']->rank ?>
                        </a>
                    <?php else: ?>
                        -
                    <?php endif; ?>
                </td>
                <td>
                   
                    <?php if (isset($mR['http://atcoder.jp'])): ?>
                        <a href="<?= $mR['http://atcoder.jp']->link ?>" target="_blank">
                            <?= $mR['http://atcoder.jp']->rating ?> /
                            <?= $mR['http://atcoder.jp']->rank ?>
                        </a>
                    <?php else: ?>
                        -
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
