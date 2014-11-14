<? if (isset($info_ok)) {?>
<div class="not_error"><?=$info_ok?></div>
<?}?>

<div class="add">
<?=HTML::image('media/img/add.png')?>
<?=HTML::anchor('admin/menumain/add', 'Додати підпункт')?>
</div>

<?if($menu_main->count() > 0):?>
<? $tr=null; $k=1; $result=null;?>

<div class="add">
<?=HTML::image('media/img/add.png')?>
<?=HTML::anchor('admin/menumain/add_main', 'Додати головний пункт')?>
</div>

<table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th>ID</th>
            <th>Назва</th>
            <th>Сторінка</th>
            <th>Функції</th>
        </tr>
    </thead>
<? foreach ($menu_main as $menu):?>
<?$result=$k%2;?>
<?if ($result===0) { $tr='a';} else { $tr='b'; }?>
<tbody>
<tr class="<?=$tr?>">
    <td><?=$menu->id?></td>
        <?if ($menu->lvl ==1) { $tab=0;} else {$tab=10;}?>
    <?if ($menu->title != 'Головна')
    {?>
    
    <td><?=HTML::anchor('admin/menumain/edit/'. $menu->id, str_repeat('&nbsp;', $tab) . $menu->title)?></td>
    <td><?=$menu->pages->title?></td>
    <td>
    
    <?=HTML::anchor('admin/menumain/edit/'. $menu->id, HTML::image('media/img/edit.png'))?>
    
    <?=HTML::anchor('admin/menumain/delete/'. $menu->id, HTML::image('media/img/delete.png'))?>
    </td>
    <?}
    else
    {?>
   <td><?=$menu->title?></td>
   <td><?=$menu->pages->title?></td>
   <td>
   </td>
    <?}?>
</tr>
<? $k++;?>
<? endforeach?>
</tbody>
</table>
<?else:?>
<p>Немає пунктів головного меню</p>
<?endif?>