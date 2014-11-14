<? if (isset($info_ok)) {?>
<div class="not_error"><?=$info_ok?></div>
<?}?>
<?if($groups_current->count() > 0):?>
<? $tr=null; $k=1; $result=null;?>

<div class="add">
<?=HTML::image('media/img/add.png')?>
<?=HTML::anchor('admin/schedulezaochgroups/add', 'Додати')?>
</div>
<table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th>ID</th>
            <th>Назва</th>
            <th>Функції</th>
        </tr>
    </thead>
<? foreach ($groups_current as $group):?>
<?$result=$k%2;?>
<?if ($result===0) { $tr='a';} else { $tr='b'; }?>
<tbody>
<tr class="<?=$tr?>">
    <td><?=$group->id?></td>
    <td><?=HTML::anchor('admin/schedulezaochgroups/edit/'. $group->id, $group->title)?></td>
    <td>
    
    <?=HTML::anchor('admin/schedulezaochgroups/edit/'. $group->id, HTML::image('media/img/edit.png'))?>
    
    <?=HTML::anchor('admin/schedulezaochgroups/delete/'. $group->id, HTML::image('media/img/delete.png'))?>
    </td>
</tr>
<? $k++;?>
<? endforeach?>
</tbody>
</table>
<?else:?>
<p>Немає груп</p>
<?endif?>