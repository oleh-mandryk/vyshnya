<h2>Крилаті фрази</h2>
    <?foreach($one_wingedphrases as $wingedphrases):?>
    <p><q><?=$wingedphrases->content?></q><br/>
    <cite><?=$wingedphrases->author?></cite></p>
    <?endforeach?>