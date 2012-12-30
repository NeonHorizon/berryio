<h1>An upgrade is available!</h1>
<p>
  Your current version is V<?=h($GLOBALS['ABOUT_VERSION_NO'])?><br />
  The latest version is V<?=h($version_number)?>
</p>
<p>
  The upgrade was released on <?=h($version_date)?>
</p>
<br />
<p>
  You can upgrade using the following command:<br />
</p>
<p>
  <code>
    sudo /usr/share/berryio/scripts/berryio_upgrade.sh
  </code>
</p>
