<?if ($info_vote != null) {?>
    <div class="<?=$info_vote_id?>"><?=$info_vote?></div>
    <?}?>
<p><strong><?=$ques->value?></strong></p>

<?foreach ($results_vote as $one):
    $percent = round(($one->votes*100)/$count_vote);?> 
    <?=$one->value.' '?> <strong><?=$one->votes?></strong> <?=' ('.$percent.'%'.')';?>
    <div class="bar " style="width: <?=$percent?>%;"></div>
<?endforeach;?> 

<p>
Всього голосів: <strong><?=$count_vote;?></strong><br />
Перший голос: <strong><?=$first_vote->date;?></strong><br />
Останній голос: <strong><?=$last_vote->date;?></strong><br />
</p>