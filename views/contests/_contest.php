<?php
use yii\helpers\Url;
?>

<td><?= $model->date ?></td>
<td>
    <a href="<?= $model->rating->link ?>"><?= $model->rating->title ?></a>
</td>
<td>
    <a href="<?= Url::to(['view', 'id' => $model->id]) ?>"><?= $model->title ?></a>
</td>

