
<p>
  Your current version is V<?=h($GLOBALS['VERSION_NO'])?><br />
  The latest version is V<?=h($version_number)?>
</p>
<p>
  The upgrade was released on <?=h($version_date)?>
</p>
<br />
<p>
  You can upgrade with the following command:
</p>
<p>
  <code>
    sudo <?=h($berryio)?> upgrade
  </code>
</p>
