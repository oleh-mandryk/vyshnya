<? if (isset($info_ok)) {?>
<div class="not_error"><?=$info_ok?></div>
<?}?>

<div class="add">
<?=HTML::image('media/img/add.png')?>
<?=HTML::anchor('admin/iwonder/add', 'Додати')?>
</div>

<?if($iwonder->count() > 0):?>
<? $tr=null; $k=1; $result=null;?>

<table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th>ID</th>
            <th>Контент</th>
            <th>Функції</th>
        </tr>
    </thead>
<? foreach ($iwonder as $iwond):?>
<?$result=$k%2;?>
<?if ($result===0) { $tr='a';} else { $tr='b'; }?>
<tbody>
<tr class="<?=$tr?>">
    <td><?=$iwond->id?></td>
    <td><?=HTML::anchor('admin/iwonder/edit/'. $iwond->id, $iwond->content)?></td>
    <td>
    
    <?=HTML::anchor('admin/iwonder/edit/'. $iwond->id, HTML::image('media/img/edit.png'))?>
    
    <?=HTML::anchor('admin/iwonder/delete/'. $iwond->id, HTML::image('media/img/delete.png'))?>
    </td>
</tr>
<? $k++;?>
<? endforeach?>
</tbody>
</table>
<?=$pagination;?>
<?else:?>
<p>Немає цікаво знати</p>
<?endif?>