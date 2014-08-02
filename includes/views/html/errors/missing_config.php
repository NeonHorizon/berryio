
<code>
**********************************************************************<br />
* ERROR: Action Needed!<br />
* <br />
* The configuration file <?=h(SETTINGS)?><?=h($file)?>.php is missing.<br />
* This may be due to an upgrade requiring a new file.<br />
* <br />
* Please copy the default file in its place:<br />
* sudo cp <?=h(DEFAULT_CONFIG)?>berryio/<?=h($file)?>.php <?=h(SETTINGS)?><br />
* <br />
* And update it:<br />
* sudo nano <?=h(SETTINGS)?><?=h($file)?>.php<br />
* <br />
**********************************************************************<br />
</code>
