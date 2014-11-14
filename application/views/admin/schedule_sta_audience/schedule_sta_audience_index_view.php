<? if (isset($info_ok)) {?>
<div class="not_error"><?=$info_ok?></div>
<?}?>

<div class="add">
<?=HTML::image('media/img/add.png')?>
<?=HTML::anchor('admin/schedulestaaudience/add', 'Додати')?>
</div>

<?if($audience_current->count() > 0):?>
<? $tr=null; $k=1; $result=null;?>

<table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th>ID</th>
            <th>Назва</th>
            <th>Функції</th>
        </tr>
    </thead>
<? foreach ($audience_current as $audience):?>
<?$result=$k%2;?>
<?if ($result===0) { $tr='a';} else { $tr='b'; }?>
<tbody>
<tr class="<?=$tr?>">
    <td><?=$audience->id?></td>
    <td><?=HTML::anchor('admin/schedulestaaudience/edit/'. $audience->id, $audience->title)?></td>
    <td>
    
    <?=HTML::anchor('admin/schedulestaaudience/edit/'. $audience->id, HTML::image('media/img/edit.png'))?>
    
    <?=HTML::anchor('admin/schedulestaaudience/delete/'. $audience->id, HTML::image('media/img/delete.png'))?>
    </td>
</tr>
<? $k++;?>
<? endforeach?>
</tbody>
</table>
<?=$pagination;?>
<?else:?>
<p>Немає аудиторій</p>
<?endif?>