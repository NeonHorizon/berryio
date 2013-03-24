
VERSION HISTORY:
<? foreach($GLOBALS['VERSION_HISTORY'] as $version):?>

  V<?=$version[VERSION_NO]?> (<?=$version[VERSION_DATE]?>)
<? foreach($version[VERSION_DETAILS] as $details):?>
  <?=$details?>

<? endforeach?>
<? endforeach?>
