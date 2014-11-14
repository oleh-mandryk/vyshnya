<div class="scheduleContent">
<form action="schedulezaochteachers" method="post">
<select class="schedule" onchange="submit();" name="teacher_id">
    <option value="select">Виберіть викладача...</option>
<?  foreach ($teachers_all as $teacher ): ?>
    <option value="<?=$teacher->id?>" <?if ((isset ($_POST['teacher_id']))and($_POST['teacher_id'] == $teacher->id)) {echo 'selected="selected"';}?>><?=$teacher->title?></option>
<?endforeach?>
</select>
</form>

<?if (isset($_POST['teacher_id'])):?>

<?if($lessons_current->count() > 0):?>
<table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th>Пара</th>
            <th>Назва предмету</th>
            <th>Група</th>
            <th>Аудиторія</th>
        </tr>
    </thead>
 
 <tbody>
<?$iter=0; $k=1; $result=null;?>
<?foreach ($lessons_current as $teacher):?>
    <?if ($k != 1) {
            if ($date_cut != $teacher->date_id) {
                $iter=0;
            }
        }
        if ($iter == 0) {?>
            <tr class="c">
                <td colspan="5"><?=$teacher->date_id.' '?>(<?=$teacher->day_id?>)</td>
                <?$iter=1; $date_cut = $teacher->date_id;?>
            </tr>
    <?}?>
    <tr class="d">
        <td><?=$teacher->lesson_id?></td>
        <td><?=$teacher->schedule_subject_con->title?>
            <? if ($teacher->subject_type_id!=0){echo '<em>('.$teacher->schedule_subject_type_con->title.')</em>';}?>
        </td>
        <td><?=$teacher->schedule_group->title?></td>
        <td>
            <?=$teacher->schedule_audience1_con->title?>
            <? if ($teacher->audience2_id!=0){echo ', '.$teacher->schedule_audience2_con->title;}?>
        </td>
    </tr>
<?$k++;?>
<?endforeach?>
</tbody>
</table>
<?else:?>
<div class="error">В даний період викладач немає в розкладі занять</div>
<?endif?>
<?endif?>
</div>