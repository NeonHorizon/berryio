
<div class="panel">

  <h2>MAIN BOARD</h2>

  <? foreach($information as $section => $section_details):?>
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
