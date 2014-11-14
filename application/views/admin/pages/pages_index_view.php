<? if (isset($info_ok)) {?>
<div class="not_error"><?=$info_ok?></div>
<?}?>

<div class="add">
<?=HTML::image('media/img/add.png')?>
<?=HTML::anchor('admin/pages/add', 'Додати')?>
</div>

<?if($pages->count() > 0):?>
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
<? foreach ($pages as $page):?>
<?$result=$k%2;?>
<?if ($result===0) { $tr='a';} else { $tr='b'; }?>
<tbody>
<tr class="<?=$tr?>">
    <td><?=$page->id?></td>
    <td><?=$page->alias?></td>
    <td><?=HTML::anchor('admin/pages/edit/'. $page->id, $page->title)?></td>
    <td>
    
    <?=HTML::anchor('admin/pages/edit/'. $page->id, HTML::image('media/img/edit.png'))?>
    
    <?=HTML::anchor('admin/pages/delete/'. $page->id, HTML::image('media/img/delete.png'))?>
    </td>
</tr>
<? $k++;?>
<? endforeach?>
</tbody>
</table>
<?=$pagination;?>
<?else:?>
<p>Немає сторінок</p>
<?endif?>