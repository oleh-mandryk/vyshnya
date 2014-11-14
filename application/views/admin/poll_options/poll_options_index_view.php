<? if (isset($info_ok)) {?>
<div class="not_error"><?=$info_ok?></div>
<?}?>

<div class="add">
<?=HTML::image('media/img/add.png')?>
<?=HTML::anchor('admin/polloptions/add', 'Додати')?>
</div>

<?if($poll_options->count() > 0):?>
<? $tr=null; $k=1; $result=null;?>

<table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th>ID</th>
            <th>Відповідь</th>
            <th>Функції</th>
        </tr>
    </thead>
<? foreach ($poll_options as $poll):?>
<?$result=$k%2;?>
<?if ($result===0) { $tr='a';} else { $tr='b'; }?>
<tbody>
<tr class="<?=$tr?>">
    <td><?=$poll->id?></td>
    <td><?=HTML::anchor('admin/polloptions/edit/'. $poll->id, $poll->value)?></td>
    <td>
    
    <?=HTML::anchor('admin/polloptions/edit/'. $poll->id, HTML::image('media/img/edit.png'))?>
    
    <?=HTML::anchor('admin/polloptions/delete/'. $poll->id, HTML::image('media/img/delete.png'))?>
    </td>
</tr>
<? $k++;?>
<? endforeach?>
</tbody>
</table>

<?else:?>
<p>Немає сторінок</p>
<?endif?>