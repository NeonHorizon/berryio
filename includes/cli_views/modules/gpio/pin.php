  GPIO-<?=str_pad($pin, 4)?> <?=str_pad($GLOBALS['GPIO_PINS'][$pin], 10)?> <? if($mode != 'not_exported'):?><?=$value?> (<?=$mode?>)<? else:?>Not Exported<? endif?>

