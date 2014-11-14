<? if (isset($info_ok)) {?>
<div class="not_error"><?=$info_ok?></div>
<?}?>

<div class="add">
<?=HTML::image('media/img/add.png')?>
<?=HTML::anchor('admin/presentation/add', 'Додати')?>
</div>

<?if($slides->count() > 0):?>
<? $tr=null; $k=1; $result=null;?>

<table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th>ID</th>
            <th>Назва</th>
            <th>Функції</th>
        </tr>
    </thead>
<? foreach ($slides as $slide):?>
<?$result=$k%2;?>
<?if ($result===0) { $tr='a';} else { $tr='b'; }?>
<tbody>
<tr class="<?=$tr?>">
    <td><?=$slide->id?></td>
    <td><?=HTML::anchor('admin/presentation/edit/'. $slide->id, $slide->title)?></td>
    <td>
    
    <?=HTML::anchor('admin/presentation/edit/'. $slide->id, HTML::image('media/img/edit.png'))?>
    
    <?=HTML::anchor('admin/presentation/delete/'. $slide->id, HTML::image('media/img/delete.png'))?>
    </td>
</tr>
<? $k++;?>
<? endforeach?>
</tbody>
</table>
<?=$pagination;?>
<?else:?>
<p>Немає слайдів</p>
<?endif?>