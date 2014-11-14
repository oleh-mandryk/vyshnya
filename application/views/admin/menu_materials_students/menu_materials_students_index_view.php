<? if (isset($info_ok)) {?>
<div class="not_error"><?=$info_ok?></div>
<?}?>

<div class="add">
<?=HTML::image('media/img/add.png')?>
<?=HTML::anchor('admin/menumaterialsstudents/add_material', 'Додати підпункт (матеріал)')?>
</div>

<div class="add">
<?=HTML::image('media/img/add.png')?>
<?=HTML::anchor('admin/menumaterialsstudents/add_subject', 'Додати підпункт (предмет)')?>
</div>

<div class="add">
<?=HTML::image('media/img/add.png')?>
<?=HTML::anchor('admin/menumaterialsstudents/add_main', 'Додати головний пункт')?>
</div>

<?if($menu_materials_students->count() > 0):?>
<? $tr=null; $k=1; $result=null;?>

<table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th>ID</th>
            <th>Назва</th>
            <th>Функції</th>
        </tr>
    </thead>
<? foreach ($menu_materials_students as $menu):?>
<?$result=$k%2;?>
<?if ($result===0) { $tr='a';} else { $tr='b'; }?>
<tbody>
<tr class="<?=$tr?>">
    <td><?=$menu->id?></td>
        <?switch($menu->lvl)
        {case 1: $tab=0; break; case 2: $tab=10; break; case 3: $tab=20; break;}?>
        <td><?=HTML::anchor('admin/menumaterialsstudents/edit/'. $menu->id, str_repeat('&nbsp;', $tab) . $menu->title)?></td>
    
    <td>
    
    <?=HTML::anchor('admin/menumaterialsstudents/edit/'. $menu->id, HTML::image('media/img/edit.png'))?>
    
    <?=HTML::anchor('admin/menumaterialsstudents/delete/'. $menu->id, HTML::image('media/img/delete.png'))?>
    </td>
</tr>
<? $k++;?>
<? endforeach?>
</tbody>
</table>
<?else:?>
<p>Немає пунктів меню методичних матеріалів студентам стаціонару</p>
<?endif?>