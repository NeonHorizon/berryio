
  <div class="container camera_controls">
    <h3><?=h($control)?></h3>
    <table>
      <? foreach($GLOBALS['CAMERA_OPTIONS'][$type][$control] as $setting => $details):?>

        <tr>
          <th><?=h($details['name'])?></th>
          <td class="code">
            <?=view('layout/control/'.$details['type'], $details + array('id' => 'control_'.$setting))?>
          </td>
        </tr>

      <? endforeach?>

      <? if(isset($blanks)):?>
        <? for($i = 0; $i < $blanks; $i++):?>
          <tr><th></th><td></td></tr>
        <? endfor?>
      <? endif?>
    </table>
  </div><br />
