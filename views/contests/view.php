<?php
use yii\helpers\Url;
$this->title = $ratingContest->title;
/*@var $this yii\web\View */
?>
<h1><?= $this->title ?></h1>

<!--
<a href="<?= Url::to(['index']) ?>">Back to contests list</a>
-->

<table class="table">
    <thead>
        <tr>
            <th>Full Name</th>
            <th>Rating</th>
            <th>Rank</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($memberContests as $memberContest): ?>
            <tr>
                <td><a href="<?= Url::to(['/members/view', 'id' => $memberContest->member_id]) ?>"><?= $memberContest->member->full_name ?></a></td>
                <td><?= $memberContest->rating ?>
                    <?php if ($memberContest->ratingsDiff > 0): ?>
                        <font color="green">+<?= $memberContest->ratingsDiff ?></font>
                    <?php elseif($memberContest->ratingsDiff < 0): ?>
                        <font color="red"><?= $memberContest->ratingsDiff ?></font>
                    <?php endif; ?>    
                </td>
                <td><?= $memberContest->rank ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

