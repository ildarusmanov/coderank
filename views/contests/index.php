<?php
use yii\widgets\ListView;

$this->title = 'Contests list'
?>
<h1><?= $this->title ?></h1>

<?= ListView::widget([
    'layout' => '<thead><tr><th>Date</th><th>Source</th><th>Title</th></tr></thead><tbody>{items}</tbody><tfoot><tr><td colspan="3">{pager}</td></tr></tfoot>',
    'dataProvider' => $dataProvider,
    'summary' => '',
    'itemView' => '_contest.php',
    'options' => ['tag' => 'table table-hover table-bordered', 'class' => 'table', 'style' => 'width: 100%;'],
    'itemOptions' => ['tag' => 'tr'],
]) ?>   
