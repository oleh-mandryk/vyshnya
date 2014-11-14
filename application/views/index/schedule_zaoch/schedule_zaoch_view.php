<div class="scheduleContent">
<form action="schedulezaoch" method="post">
<select onchange="submit();" name="group_id">
    <option value="select">Виберіть групу...</option>
<?  foreach ($groups_all as $group ): ?>
    <option value="<?=$group->id?>" <?if ((isset ($_POST['group_id']))and($_POST['group_id'] == $group->id)) {echo 'selected="selected"';}?>><?=$group->title?></option>
<?endforeach?>
</select>
</form>

<?if (isset($_POST['group_id'])):?>

<?if($lessons_current->count() > 0):?>
<table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th>Пара</th>
            <th>Назва предмету</th>
            <th>Викладач</th>
            <th>Аудиторія</th>
        </tr>
    </thead>

<tbody>
<?$iter=0; $k=1; $result=null;?>
<?foreach ($lessons_current as $group):?>
    <?if ($k != 1) {
            if ($date_cut != $group->date_id) {
                $iter=0;
            }
        }
        if ($iter == 0) {?>
            <tr class="c">
                <td colspan="5"><?=$group->date_id.' '?>(<?=$group->day_id?>)</td>
                <?$iter=1; $date_cut = $group->date_id;?>
            </tr>
    <?}?>
    <tr class="d">
        <td><?=$group->lesson_id?></td>
        <td><?=$group->schedule_subject_con->title?>
            <? if ($group->subject_type_id!=0){echo '<em>('.$group->schedule_subject_type_con->title.')</em>';}?>
        </td>
        <td>
            <?=$group->schedule_teacher1_con->title?>
            
            <? if ($group->teacher2_id!=0){echo ', '.$group->schedule_teacher2_con->title;}?>
            <? if ($group->teacher3_id!=0){echo ', '.$group->schedule_teacher3_con->title;}?>
            <? if ($group->teacher4_id!=0){echo ', '.$group->schedule_teacher4_con->title;}?>
        </td>
        <td>
            <?=$group->schedule_audience1_con->title?>
            <? if ($group->audience2_id!=0){echo ', '.$group->schedule_audience2_con->title;}?>
        </td>
    </tr> 
 <?$k++;?>
<?endforeach?>

</tbody>

</table>
<?else:?>
<div class="error">В даний період група немає в розкладі занять</div>
<?endif?>
<?endif?>
</div>