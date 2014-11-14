<?if($errors):?>
<?foreach ($errors as $error):?>
<div class="error"><?=$error?></div>
<?endforeach?>
<?endif?>
<div id="adminForms">
<?=Form::open('admin/schedulezaochlessons/add/'.$id)?>
<table cellpadding="0" cellspacing="0">
    <tbody>
    <tr class="a">
        <td><?=Form::label('lesson_id', 'Пара')?>:</td>
        <td>
        <select name="lesson_id">
            <option value="">Виберіть пару...</option>
            <option value="1" <?if ((isset ($_POST['lesson_id']))and($_POST['lesson_id'] == 1)) {echo 'selected="selected"';}?>>1</option>
            <option value="2" <?if ((isset ($_POST['lesson_id']))and($_POST['lesson_id'] == 2)) {echo 'selected="selected"';}?>>2</option>
            <option value="3" <?if ((isset ($_POST['lesson_id']))and($_POST['lesson_id'] == 3)) {echo 'selected="selected"';}?>>3</option>
            <option value="4" <?if ((isset ($_POST['lesson_id']))and($_POST['lesson_id'] == 4)) {echo 'selected="selected"';}?>>4</option>
            <option value="5" <?if ((isset ($_POST['lesson_id']))and($_POST['lesson_id'] == 5)) {echo 'selected="selected"';}?>>5</option>
            <option value="6" <?if ((isset ($_POST['lesson_id']))and($_POST['lesson_id'] == 6)) {echo 'selected="selected"';}?>>6</option>
            <option value="7" <?if ((isset ($_POST['lesson_id']))and($_POST['lesson_id'] == 7)) {echo 'selected="selected"';}?>>7</option>
        </select>
        </td>
    </tr>
    <tr class="b">
        <td><?=Form::label('subject_id', 'Предмет')?>:</td>
        <td>
        <div class="posBlockTwo">
        <select name="subject_id">
            <option value="">Виберіть предмет...</option>
            <?  foreach ($subject_all_ad as $subject_all ): ?>
                <option  value="<?=$subject_all->id?>" <?if ((isset ($_POST['subject_id']))and($_POST['subject_id'] == $subject_all->id)) {echo 'selected="selected"';}?>><?=$subject_all->title?></option>
            <?endforeach?>
        </select>
        </div>
        <div class="posBlockTwo">
        <select name="subject_type_id">
            <option value="">Виберіть атрибут...</option>
            <?  foreach ($subject_type_all_ad as $subject_type_all ): ?>
                <option  value="<?=$subject_type_all->id?>" <?if ((isset ($_POST['subject_type_id']))and($_POST['subject_type_id'] == $subject_type_all->id)) {echo 'selected="selected"';}?>><?=$subject_type_all->title?></option>
            <?endforeach?>
        </select>
        </div>
    </td>
    </tr>
    <tr class="a">
        <td><?=Form::label('teacher_id', 'Викладач')?>:</td>
        <td>
        <div class="posBlockTwo">
        <select name="teacher1_id">
            <option value="">Виберіть викладача 1...</option>
            <?  foreach ($teacher_all_ad as $teacher_all ): ?>
                <option  value="<?=$teacher_all->id?>" <?if ((isset ($_POST['teacher1_id']))and($_POST['teacher1_id'] == $teacher_all->id)) {echo 'selected="selected"';}?>><?=$teacher_all->title?></option>
            <?endforeach?>
        </select>
        </div>
        <div class="posBlockTwo">
        <select name="teacher2_id">
            <option value="">Виберіть викладача 2...</option>
            <?  foreach ($teacher_all_ad as $teacher_all ): ?>
                <option  value="<?=$teacher_all->id?>" <?if ((isset ($_POST['teacher2_id']))and($_POST['teacher2_id'] == $teacher_all->id)) {echo 'selected="selected"';}?>><?=$teacher_all->title?></option>
            <?endforeach?>
        </select>
        </div>
        <div class="posBlockTwo">
        <select name="teacher3_id">
            <option value="">Виберіть викладача 3...</option>
            <?  foreach ($teacher_all_ad as $teacher_all ): ?>
                <option  value="<?=$teacher_all->id?>" <?if ((isset ($_POST['teacher3_id']))and($_POST['teacher3_id'] == $teacher_all->id)) {echo 'selected="selected"';}?>><?=$teacher_all->title?></option>
            <?endforeach?>
        </select>
        </div>
        <div class="posBlockTwo">
        <select name="teacher4_id">
            <option value="">Виберіть викладача 4...</option>
            <?  foreach ($teacher_all_ad as $teacher_all ): ?>
                <option  value="<?=$teacher_all->id?>" <?if ((isset ($_POST['teacher4_id']))and($_POST['teacher4_id'] == $teacher_all->id)) {echo 'selected="selected"';}?>><?=$teacher_all->title?></option>
            <?endforeach?>
        </select>
        </div>
    </td>
    </tr>
    <tr class="b">
        <td><?=Form::label('audience_id', 'Аудиторія')?>:</td>
        <td>
        <div class="posBlockTwo">
        <select name="audience1_id">
            <option value="">Виберіть аудиторію 1...</option>
            <?  foreach ($audience_all_ad as $audience_all ): ?>
                <option  value="<?=$audience_all->id?>" <?if ((isset ($_POST['audience1_id']))and($_POST['audience1_id'] == $audience_all->id)) {echo 'selected="selected"';}?>><?=$audience_all->title?></option>
            <?endforeach?>
        </select>
        </div>
        <div class="posBlockTwo">
        <select name="audience2_id">
            <option value="">Виберіть аудиторію 2...</option>
            <?  foreach ($audience_all_ad as $audience_all ): ?>
                <option  value="<?=$audience_all->id?>" <?if ((isset ($_POST['audience2_id']))and($_POST['audience2_id'] == $audience_all->id)) {echo 'selected="selected"';}?>><?=$audience_all->title?></option>
            <?endforeach?>
        </select>
        </div>
    </td>
    </tr>
    
    <tr class="a">
        <td><?=Form::label('date_id', 'Дата')?>:</td>
        <td><?=Form::input('date_id', $date['date_id'] = date ("Y-m-d") ,array('class'=>'numeric'))?></td>
    </tr>
    
    <tr class="b">
        <td colspan="2" align="center"><?=Form::submit('submit', 'Додати', array('class' => 'submit'))?></td>
    </tr>
</tbody>
</table>
<?=Form::close()?>
</div>