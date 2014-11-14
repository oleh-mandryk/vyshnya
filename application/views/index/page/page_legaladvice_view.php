<a name="top"></a>
<p><strong>Заповнивши форму Ви зможете отримати безкоштовну юридичну консультацію. Для швидкого та якісного розгляду Вашого запитання опишіть проблему якомога детальніше</strong>.</p>
<? if (isset($info_ok)) {?>
<div class="not_error"><?=$info_ok?></div>
<?}?>

<?if($errors):?>
<?foreach ($errors as $error):?>
<div class="error"><?=$error?></div>
<?endforeach?>
<?endif?>

<div id="indexForms">
<?=Form::open('page/legaladvice')?>
    <p><?=Form::label('first_name', 'Прізвище')?>:<br/>
    <?=Form::input('first_name', $data['first_name'])?></p>
    
    <p><?=Form::label('last_name', 'Ім\'я')?>:<br/>
    <?=Form::input('last_name', $data['last_name'])?></p>
    
    <p><?=Form::label('middle_name', 'По батькові')?>:<br/>
    <?=Form::input('middle_name', $data['middle_name'])?></p>
    
    <p>
    <?=Form::label('birthday_date', 'Рік народження')?>:<br/>
    <select name="birthday_date">
            <option value="">Виберіть рік</option>
            <?for($d3=date("Y"); $d3>=1930; $d3--):?>
                <option value="<?=$d3?>" <?if ((isset ($data['birthday_date']))and($data['birthday_date'] == $d3)) {echo 'selected="selected"';}?>><?=$d3?></option>
            <?endfor;?>
    </select></p>
    
    <p><?=Form::label('email', 'Ваш E-mail')?>:<br/>
    <?=Form::input('email', $data['email'])?></p>
    
    <p><?=Form::label('phone', 'Контактний телефон')?>:<br/>
    <?=Form::input('phone', $data['phone'])?></p>
    
    <p><?=Form::label('address', 'Місце проживання')?>:<br/>
    <?=Form::textarea('address',$data['address'])?></p>
    
    <p><?=Form::label('question', 'Питання')?>:<br/>
    <?=Form::textarea('question',$data['question'])?></p>
   
    <p><?=Form::label('captcha', 'Введіть цифри з картинки')?>:<br/>
    <?=$captcha; ?></p>
    <p><?=Form::input('captcha', null, array('class' => 'numeric'))?></p>
    
    <p><?=Form::submit('send', 'Надіслати запитання', array('class' => 'submit'))?></p>
    
<?=Form::close()?>
</div>
<p><strong>Ваше звернення буде розглянуто відповідно до ст. 20 Закону України "Про звернення громадян" з моменту отримання на електронну пошту юридичної консультації у визначені цим Законом строки.</strong></p>
<a name="top1"></a>
<?if(count($answers)>0):?>
<h3>
	Відповіді на питання</h3>
<div class="legaladvice">
<?foreach ($answers as $answer):?>
<p class="legaladviceAnswer"><span class="expand"><?=$answer['question'];?></span></p>
<ul class="answer">
    <li class="author">
    <div class="blockA"><?='<strong>Консультував:</strong> '.$answer['author_answer'];?></div>
    <div class="blockB"><?='<strong>Дата відповіді:</strong> '.$answer['date_answer'];?></div>
    <div class="clear"></div>
    </li>
    <li><?=$answer['answer'];?></li>
    <?if ($answer['show_form']==0) {$sd = 'display:block'; $sd1 = 'display:none';} else {$sd = 'display:none'; $sd1 = 'display:block';}?>
    <li id="infoBottom<?=$answer['id']?>" class="infoBottom" style="<?=$sd?>">
    <div class="blockD"><strong>Вам допомогла ця інформація?</strong> </div>
    <div class="blockC">Так</div>
    <div class="blockC"><input id="legaladviceRadio" class="legaladviceRadio" type="radio" name="legaladvice<?=$answer['id']?>"
    onclick="addLegaladvice(1, <?=$answer['id']?>);" value="1" /></div>
    <div class="blockC">Ні</div>
    <input class="legaladviceRadio" type="radio" name="legaladvice<?=$answer['id']?>"
    onclick="addLegaladvice(2, <?=$answer['id']?>);" value="2" />
    </li>
    <li id="infoBottomResult<?=$answer['id']?>" class="infoBottomResult" style="<?=$sd1?>">
    <div class="blockD"><strong>Так</strong></div>
    <div class="blockD"><?=$answer['votes_yes'];?></div>
    <div class="blockD"><strong>Ні</strong></div>
    <?=$answer['votes_no'];?>
    </li>
    <li id="infoBottomInfo<?=$answer['id']?>" class="infoBottomInfo" style="display:none">
    <strong>Дякуємо з ваш голос!</strong>
    </li>
</ul>
<?endforeach?>
</div>
<?endif?>