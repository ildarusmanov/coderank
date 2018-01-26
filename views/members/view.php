<?php
use yii\helpers\Url;

$this->title = $member->full_name;
/* @var $this yii\web\View */
?>
<h1><?= $this->title ?></h1>

<!--
<a href="<?= Url::to(['index']) ?>">Back to members list</a>
-->
<h2>Rating</h2>
<table class="table">
    <thead>
        <th>Type</th>
        <th>Rating</th>
        <th>Rank</th>
    </thead>
    <tbody>
        <?php foreach ($member->memberRatings as $mr): ?>
            <tr>
                <td><?= $mr->rating0->title ?></td>
                <td><?= $mr->rating ?></td>
                <td><?= $mr->rank ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>    
</table>

<h2>Contests</h2>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Date</th>
            <th>Name</th>
            <th>Source</th>
            <th>Rating</th>
            <th>Rank</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($contests as $contest): ?>
            <tr>
                <td><?= $contest->ratingContest->date ?></td>
                <td><a href="<?= $contest->ratingContest->rating->link ?>" target="_blank"><?= $contest->ratingContest->rating->title ?></a></td>
                <td><a href="<?= Url::to(['/contests/view', 'id' => $contest->rating_contest_id]) ?>" target="_blank"><?= $contest->ratingContest->title ?></a></td>
                <td><?= $contest->rating ?>
                    <?php if ($contest->ratingsDiff > 0): ?>
                        <font color="green">+<?= $contest->ratingsDiff ?></font>
                    <?php elseif($contest->ratingsDiff < 0): ?>
                        <font color="red"><?= $contest->ratingsDiff ?></font>
                    <?php endif; ?>
                        
                </td>
                <td><?= $contest->rank ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>


