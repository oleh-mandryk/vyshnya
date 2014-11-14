<? if (isset($info_ok)) {?>
<div class="not_error"><?=$info_ok?></div>
<?}?>

<div class="add">
<?=HTML::image('media/img/add.png')?>
<?=HTML::anchor('admin/schedulestateachers/add', 'Додати')?>
</div>

<?if($teachers_current->count() > 0):?>
<? $tr=null; $k=1; $result=null;?>

<table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th>ID</th>
            <th>Назва</th>
            <th>Функції</th>
        </tr>
    </thead>
<? foreach ($teachers_current as $teachers):?>
<?$result=$k%2;?>
<?if ($result===0) { $tr='a';} else { $tr='b'; }?>
<tbody>
<tr class="<?=$tr?>">
    <td><?=$teachers->id?></td>
    <td><?=HTML::anchor('admin/schedulestateachers/edit/'. $teachers->id, $teachers->title)?></td>
    <td>
    
    <?=HTML::anchor('admin/schedulestateachers/edit/'. $teachers->id, HTML::image('media/img/edit.png'))?>
    
    <?=HTML::anchor('admin/schedulestateachers/delete/'. $teachers->id, HTML::image('media/img/delete.png'))?>
    </td>
</tr>
<? $k++;?>
<? endforeach?>
</tbody>
</table>
<?=$pagination;?>
<?else:?>
<p>Немає викладачів</p>
<?endif?>