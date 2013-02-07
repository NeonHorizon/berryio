
<div class="panel">

  <h2>MAIN BOARD</h2>

  <? $count = 0; foreach($information as $section => $section_details):?>
    <? if($count++ > 1):?><br /><? endif?>
    <div class="container board_information">
      <h2><?=h($section)?> Information</h2>

      <table>
        <? foreach($section_details as $name => $details):?>
          <tr>
            <th><?=h($name)?></th>
            <td class="code"><?=h($details)?></td>
          </tr>
        <? endforeach?>
      </table>

    </div>
  <? endforeach?>

</div>
