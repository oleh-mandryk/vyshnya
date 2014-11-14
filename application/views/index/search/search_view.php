<? $id=null; $p=1; $result=null;?>

<?  if($errors): ?>
<?  foreach ($errors as $error): ?>
<div class="error"><?=$error?></div>
<?  endforeach ?>
<?  endif ?>

<?  if ($info_vote != null)
    { ?>
        <div class="<?=$info_vote_id?>"><?=$info_vote?></div>
<?  }
    else
    { ?>
        <div class="not_error">По запиту <strong>"<?=$ses_search_ok?>"</strong> знайдено:</div>
<?  } ?>
        <div class="searchResults">
        <ul>
<?          for ($i = 0; $i < $p_search_results['counter']; $i++)
            {
                if (isset($p_search_results[$i][0]))
                {
                    $result=$p%2;
                    if ($result===0) { $id='last';}
                    
                    $p_search_results[$i][1] = Text::highlight_phrase($p_search_results[$i][1], $ses_search_ok,'<span style="background:#feffc9">','</span>');
                    $p_search_results[$i][2] = Text::highlight_phrase($p_search_results[$i][2], $ses_search_ok,'<span style="background:#feffc9">','</span>'); ?>
                    <li class="<?=$id?>">
                    <h2><?=HTML::anchor($p_search_results[$i][0], $p_search_results[$i][1])?></h2>
                    <?=$p_search_results[$i][2]?>
                    </li>
                    <? if ($result===0) { $id='prevLast';} else {$id=null;} $p++;?>          
<?              } 
            } ?>
        </ul>
        <br class="clear" />
        </div>
        <?=$pagination;?>