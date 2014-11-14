<? if (isset($info_ok)) {?>
<div class="not_error"><?=$info_ok?></div>
<?}?>

<div class="add">
<?=HTML::image('media/img/add.png')?>
<?=HTML::anchor('admin/news/add', 'Додати')?>
</div>

<?if($news->count() > 0):?>
<? $tr=null; $k=1; $result=null;?>

<table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th>ID</th>
            <th>Дата</th>
            <th>Назва</th>
            <th>Кількість переглядів</th>
            <th>Функції</th>
        </tr>
    </thead>
<? foreach ($news as $new):?>
<?$result=$k%2;?>
<?if ($result===0) { $tr='a';} else { $tr='b'; }?>
<tbody>
<tr class="<?=$tr?>">
    <td><?=$new->id?></td>
    <td><?=$new->date?></td>
    <td><?=HTML::anchor('admin/news/edit/'. $new->id, $new->title)?></td>
    <td><?=$new->count_views?></td>
    <td>
    
    <?=HTML::anchor('admin/news/edit/'. $new->id, HTML::image('media/img/edit.png'))?>
    
    <?=HTML::anchor('admin/news/delete/'. $new->id, HTML::image('media/img/delete.png'))?>
    </td>
</tr>
<? $k++;?>
<? endforeach?>
</tbody>
</table>
<?=$pagination;?>
<?else:?>
<p>Немає новин</p>
<?endif?>