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
  You can upgrade using the following commands:<br />
</p>
<p>
  <code>
    wget <a href="<?=$version_download?>"><?=$version_download?></a><br />
    tar -xvzf berryio_<?=h($version_number)?>.tar.gz<br />
    cd berryio_<?=h($version_number)?><br />
    more UPGRADE.README.txt
  </code>
</p>
