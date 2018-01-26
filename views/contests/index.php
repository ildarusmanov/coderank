<?php
use yii\widgets\ListView;

$this->title = 'Contests list'
?>
<h1><?= $this->title ?></h1>

<?= ListView::widget([
    'layout' => '<table class="table"><thead><tr><th>Date</th><th>Source</th><th>Title</th></tr></thead><tbody>{items}</tbody></table><div>{pager}</div>',
    'dataProvider' => $dataProvider,
    'summary' => '',
    'itemView' => '_contest.php',
]) ?>   
