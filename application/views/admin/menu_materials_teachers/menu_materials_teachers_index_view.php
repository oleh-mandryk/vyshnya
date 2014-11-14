<? if (isset($info_ok)) {?>
<div class="not_error"><?=$info_ok?></div>
<?}?>

<div class="add">
<?=HTML::image('media/img/add.png')?>
<?=HTML::anchor('admin/menumaterialsteachers/add', 'Додати підпункт')?>
</div>

<div class="add">
<?=HTML::image('media/img/add.png')?>
<?=HTML::anchor('admin/menumaterialsteachers/add_main', 'Додати головний пункт')?>
</div>

<?if($menu_materials_teachers->count() > 0):?>
<? $tr=null; $k=1; $result=null;?>

<table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th>ID</th>
            <th>Назва</th>
            <th>Функції</th>
        </tr>
    </thead>
<? foreach ($menu_materials_teachers as $menu):?>
<?$result=$k%2;?>
<?if ($result===0) { $tr='a';} else { $tr='b'; }?>
<tbody>
<tr class="<?=$tr?>">
    <td><?=$menu->id?></td>
        <?if ($menu->lvl ==1) { $tab=0;} else {$tab=10;}?>
        <td><?=HTML::anchor('admin/menumaterialsteachers/edit/'. $menu->id, str_repeat('&nbsp;', $tab) . $menu->title)?></td>
    
    <td>
    
    <?=HTML::anchor('admin/menumaterialsteachers/edit/'. $menu->id, HTML::image('media/img/edit.png'))?>
    
    <?=HTML::anchor('admin/menumaterialsteachers/delete/'. $menu->id, HTML::image('media/img/delete.png'))?>
    </td>
</tr>
<? $k++;?>
<? endforeach?>
</tbody>
</table>
<?else:?>
<p>Немає пунктів меню методичних матеріалів викладачу</p>
<?endif?>