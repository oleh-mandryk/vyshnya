<? if (isset($info_ok)) {?>
<div class="not_error"><?=$info_ok?></div>
<?}?>

<div class="add">
<?=HTML::image('media/img/add.png')?>
<?=HTML::anchor('admin/menuphotogallery/add', 'Додати')?>
</div>

<?if($menuphotogallery->count() > 0):?>
<? $tr=null; $k=1; $result=null;?>

<table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th>ID</th>
            <th>Аліас</th>
            <th>Назва</th>
            <th>Функції</th>
        </tr>
    </thead>
<? foreach ($menuphotogallery as $menu):?>
<?$result=$k%2;?>
<?if ($result===0) { $tr='a';} else { $tr='b'; }?>
<tbody>
<tr class="<?=$tr?>">
    <td><?=$menu->id?></td>
    <td><?=$menu->alias?></td>
    <td><?=HTML::anchor('admin/menuphotogallery/edit/'. $menu->id, $menu->title)?></td>
    <td>
    
    <?=HTML::anchor('admin/menuphotogallery/edit/'. $menu->id, HTML::image('media/img/edit.png'))?>
    
    <?=HTML::anchor('admin/menuphotogallery/delete/'. $menu->id, HTML::image('media/img/delete.png'))?>
    </td>
</tr>
<? $k++;?>
<? endforeach?>
</tbody>
</table>
<?=$pagination;?>
<?else:?>
<p>Немає категорій</p>
<?endif?>