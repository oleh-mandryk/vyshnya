<? if (isset($info_ok)) {?>
<div class="not_error"><?=$info_ok?></div>
<?}?>

<?if($settings->count() > 0):?>
<? $tr=null; $k=1; $result=null;?>

<table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th>ID</th>
            <th>Назва</th>
            <th>Значення</th>
            <th>Функції</th>
        </tr>
    </thead>
<? foreach ($settings as $setting):?>
<?$result=$k%2;?>
<?if ($result===0) { $tr='a';} else { $tr='b'; }?>
<tbody>
<tr class="<?=$tr?>">
    <td><?=$setting->id?></td>
    <td><?=HTML::anchor('admin/settings/edit/'. $setting->id, $setting->pref_id)?></td>
    <td><?=$setting->value?></td>
    <td>
        <?=HTML::anchor('admin/settings/edit/'. $setting->id, HTML::image('media/img/edit.png'))?>
    </td>
</tr>
<? $k++;?>
<? endforeach?>
</tbody>
</table>
<?else:?>
<p>Немає налаштувань</p>
<?endif?>