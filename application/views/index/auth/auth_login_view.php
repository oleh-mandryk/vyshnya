<?if($errors):?>
<?foreach ($errors as $error):?>
<div class="error"><?=$error?></div>
<?endforeach?>
<?endif?>
<div id="login">
<p>Введіть всій логін та пароль для входу на сайт.<a href="/register"> Реєстрація.</a><a href="/restore_password"> Забули пароль?</a></p>
      <form action="/login" method="post">
        <label>Логін<input type="text" name="username" value=""/></label>
        <label>Пароль<input type="password" name="password" value=""/></label>
        <div class="posBlock"><input type="checkbox" name="remember" value="checkbox1" /></div>
        <div class="posBlock">Запам'ятати мене</div>
        <br class="clear"/>
        <input type="submit" name="submit" class="submit" value="Увійти" />
      </form>
</div>