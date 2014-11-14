<? if (isset($info_ok)) {?>
<div class="not_error"><?=$info_ok?></div>
<?}?>

<div class="add">
<?=HTML::image('media/img/add.png')?>
<?=HTML::anchor('admin/photogallery/add', 'Додати')?>
</div>

<?if($photogallery->count() > 0):?>
<? $tr=null; $k=1; $result=null;?>


<table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th>ID</th>
            <th>Дата</th>
            <th>Назва</th>
            <th>Категорія</th>
            <th>Функції</th>
        </tr>
    </thead>
<? foreach ($photogallery as $photo):?>
<?$result=$k%2;?>
<?if ($result===0) { $tr='a';} else { $tr='b'; }?>
<tbody>
<tr class="<?=$tr?>">
    <td><?=$photo->id?></td>
    <td><?=$photo->date?></td>
    <td><?=HTML::anchor('admin/photogallery/edit/'. $photo->id, $photo->title)?></td>
    <td><?=$photo->photos_section->title?></td>
    <td>
    
    <?=HTML::anchor('admin/photogallery/edit/'. $photo->id, HTML::image('media/img/edit.png'))?>
    
    <?=HTML::anchor('admin/photogallery/delete/'. $photo->id, HTML::image('media/img/delete.png'))?>
    </td>
</tr>
<? $k++;?>
<? endforeach?>
</tbody>
</table>
<?=$pagination;?>
<?else:?>
<p>Немає фотографій</p>
<?endif?>