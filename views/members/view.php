<?php
use yii\helpers\Url;

$this->title = $member->full_name;
/* @var $this yii\web\View */
?>
<h1><?= $this->title ?></h1>

<div class="panel panel-default">
  <div class="panel-heading">Rating</div>
  <div class="panel-body">
<table class="table table-bordered table-hover" style="width: 100%;">
    <thead>
        <tr>
            <th>Type</th>
            <th>Rating</th>
            <th>Rank</th>
        </tr>
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
  </div>
</div>


<div class="panel panel-default">
  <div class="panel-heading">Contests</div>
  <div class="panel-body">
<table class="table table-bordered table-hover data-table" width="100%">
    <thead>
        <tr>
            <th>Date</th>
            <th>Name</th>
            <th>Source</th>
            <th>Rating</th>
            <th>Rating update</th>
            <th>Rank</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($contests as $contest): ?>
            <tr>
                <td><?= $contest->ratingContest->date ?></td>
                <td><a href="<?= $contest->ratingContest->rating->link ?>" target="_blank"><?= $contest->ratingContest->rating->title ?></a></td>
                <td><a href="<?= Url::to(['/contests/view', 'id' => $contest->rating_contest_id]) ?>"><?= $contest->ratingContest->title ?></a></td>
                <td><?= $contest->rating ?></td>
                <td>
                    <?php if ($contest->ratingsDiff > 0): ?>
                        <font color="green">+<?= $contest->ratingsDiff ?></font>
                    <?php elseif($contest->ratingsDiff < 0): ?>
                        <font color="red"><?= $contest->ratingsDiff ?></font>
                    <?php else: ?>
                        <font color="silver">0</font>
                    <?php endif; ?>

                        
                </td>
                <td><?= $contest->rank ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
    </div>
</div>

