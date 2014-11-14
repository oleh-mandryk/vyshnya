<? $tr=null; $m=1; $k=1; $result=null;?>

<table cellpadding="0" cellspacing="0">
<tbody>
<? foreach ($groups_current as $group):?>
<?if ($m==1) {
$result=$k%2;
if ($result===0) { $tr='a';} else { $tr='b'; }?>
<tr class="<?=$tr?>">
<?}
else {
    $m++;
}?>


    <?$m++;?>
    <td><?=HTML::anchor('admin/schedulestalessons/index/'. $group->id, $group->title)?></td>

<?if ($m==12) {?>
    </tr>
<? $k++; $m=1;
}?>


<? endforeach?>
</tbody>
</table>