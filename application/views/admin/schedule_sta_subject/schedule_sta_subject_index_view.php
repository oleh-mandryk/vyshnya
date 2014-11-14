<? if (isset($info_ok)) {?>
<div class="not_error"><?=$info_ok?></div>
<?}?>

<div class="add">
<?=HTML::image('media/img/add.png')?>
<?=HTML::anchor('admin/schedulestasubject/add', 'Додати')?>
</div>

<?if($subject_current->count() > 0):?>
<? $tr=null; $k=1; $result=null;?>

<table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th>ID</th>
            <th>Назва</th>
            <th>Функції</th>
        </tr>
    </thead>
<? foreach ($subject_current as $subject):?>
<?$result=$k%2;?>
<?if ($result===0) { $tr='a';} else { $tr='b'; }?>
<tbody>
<tr class="<?=$tr?>">
    <td><?=$subject->id?></td>
    <td><?=HTML::anchor('admin/schedulestasubject/edit/'. $subject->id, $subject->title)?></td>
    <td>
    
    <?=HTML::anchor('admin/schedulestasubject/edit/'. $subject->id, HTML::image('media/img/edit.png'))?>
    
    <?=HTML::anchor('admin/schedulestasubject/delete/'. $subject->id, HTML::image('media/img/delete.png'))?>
    </td>
</tr>
<? $k++;?>
<? endforeach?>
</tbody>
</table>
<?=$pagination;?>
<?else:?>
<p>Немає предметів</p>
<?endif?>