<div id="poll">
<h2>Голосування</h2>
    <p><strong><?=$ques->value?></strong></p>
    <form name="poll" action="/poll" method="post">
    <?php	foreach ($options as $one):?>
    <input type="radio" name="poll" value="<?=$one->id?>" /><label for='<?=$one->id?>'>&nbsp;<?=$one->value?></label><br />                       
    <?php endforeach; ?>
    
    <input type="submit" name = "vote_button" class="submit" value="Голосувати" />
    <input type="submit" name = "result_button" class="submit" value="Результати" />
    </form>
</div>