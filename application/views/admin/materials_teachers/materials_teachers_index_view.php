<? if (isset($info_ok)) {?>
<div class="not_error"><?=$info_ok?></div>
<?}?>

<div class="add">
<?=HTML::image('media/img/add.png')?>
<?=HTML::anchor('admin/materialsteachers/add', 'Додати')?>
</div>

<?if($materials_teachers->count() > 0):?>
<? $tr=null; $k=1; $result=null;?>

<table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th>ID</th>
            <th>Назва</th>
            <th>Меню</th>
            <th>Функції</th>
        </tr>
    </thead>
<? foreach ($materials_teachers as $menu):?>
<?$result=$k%2;?>
<?if ($result===0) { $tr='a';} else { $tr='b'; }?>
<tbody>
<tr class="<?=$tr?>">
    <td><?=$menu->id?></td>
    <td><?=HTML::anchor('admin/materialsteachers/edit/'. $menu->id, $menu->title)?></td>
    <td><?=$menu->menu->parent()->title?> &rarr; <?=$menu->menu->title?></td>
    <td>
        <?=HTML::anchor('admin/materialsteachers/edit/'. $menu->id, HTML::image('media/img/edit.png'))?>
        <?=HTML::anchor('admin/materialsteachers/delete/'. $menu->id, HTML::image('media/img/delete.png'))?>
    </td>
</tr>
<? $k++;?>
<? endforeach?>
</tbody>
</table>
<?=$pagination;?>
<?else:?>
<p>Немає методичних матеріалів викладачу</p>
<?endif?>