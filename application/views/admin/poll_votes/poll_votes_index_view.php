<? if (isset($info_ok)) {?>
<div class="not_error"><?=$info_ok?></div>
<?}?>

<?if($poll_votes->count() > 0):?>
<? $tr=null; $k=1; $result=null;?>

<table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th>ID</th>
            <th>Відповідь</th>
            <th>Дата</th>
            <th>IP-адреса</th>
            <th>Функції</th>
        </tr>
    </thead>
<? foreach ($poll_votes as $poll):?>
<?$result=$k%2;?>
<?if ($result===0) { $tr='a';} else { $tr='b'; }?>
<tbody>
<tr class="<?=$tr?>">
    <td><?=$poll->id?></td>
    <td><?=$poll->poll_options->value?></td>
    <td><?=$poll->date?></td>
    <td><?=$poll->ip?></td>
    <td>
    <?=HTML::anchor('admin/pollvotes/delete/'. $poll->id, HTML::image('media/img/delete.png'))?>
    </td>
</tr>
<? $k++;?>
<? endforeach?>
</tbody>
</table>

<?else:?>
<p>Немає результатів голосування</p>
<?endif?>