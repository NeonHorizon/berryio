
<div class="panel">

  <h2>Board Information</h2>

  <div class="container">

    <table>
    <? foreach($information as $name => $details):?>
      <tr>
        <th><?=$name?></th>
        <td class="code"><?=$details?></td>
      </tr>
    <? endforeach?>
    </table>

  </div>

</div>

