
<div class="panel">

  <h2>MAIN BOARD</h2>

  <div class="container">
    <h2>CPU Information</h2>

    <table>
      <? foreach($information as $name => $details):?>
        <tr>
          <th><?=h($name)?></th>
          <td class="code"><?=h($details)?></td>
        </tr>
      <? endforeach?>
    </table>

  </div>

</div>
