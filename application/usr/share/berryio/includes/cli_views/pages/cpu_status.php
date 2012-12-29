
SYSTEM LOAD AVERAGE:

  Time Period   Queued Processes
     1 Minute   <?=str_pad($load_average[0], 7, ' ', STR_PAD_RIGHT)?> <?=graph_horizontal_bar(1 - pow(3, -$load_average[0]), 0, 1, FALSE, FALSE)?>

    5 Minutes   <?=str_pad($load_average[1], 7, ' ', STR_PAD_RIGHT)?> <?=graph_horizontal_bar(1 - pow(3, -$load_average[0]), 0, 1, FALSE, FALSE)?>

   14 Minutes   <?=str_pad($load_average[2], 7, ' ', STR_PAD_RIGHT)?> <?=graph_horizontal_bar(1 - pow(3, -$load_average[0]), 0, 1, FALSE, FALSE)?>


CPU READINGS:

<? if($temperature != ''):?>
  Temperature   <?=str_pad($temperature.'\'C', 7, ' ', STR_PAD_RIGHT)?> <?=graph_horizontal_bar($temperature, 0, 85, FALSE)?>

<? endif?>
<? if($speed != ''):?>
  Speed         <?=str_pad(si_unit($speed, $na, 1000, 0).'Hz', 7, ' ', STR_PAD_RIGHT)?> <?=graph_horizontal_bar($speed, 200000000, 1200000000, FALSE)?>

<? endif?>
<? if($voltage != ''):?>
  Voltage       <?=str_pad($voltage.'V', 7, ' ', STR_PAD_RIGHT)?> <?=graph_horizontal_bar($voltage, $voltage < 1 ? $voltage : 1, 1.4, FALSE)?>

<? endif?>