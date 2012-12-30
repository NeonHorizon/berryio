
<h2 id="message">Are you sure you want to <?=h($description)?>?</h2>
<form action="<?=$_SERVER["REQUEST_URI"]?>" method="post">
  <p>
    <input type="submit" name="no" value="No" />
    <input type="submit" name="yes" value="Yes" />
  </p>
</form>
