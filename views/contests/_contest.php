<?php
use yii\helpers\Url;
?>
<tr>
    <td><?= $model->date ?></td>
    <td>
        <a href="<?= $model->rating->link ?>" target="_blank"><?= $model->rating->title ?></a>
    </td>
    <td>
        <a href="<?= Url::to(['view', 'id' => $model->id]) ?>"><?= $model->title ?></a>
    </td>
</tr>