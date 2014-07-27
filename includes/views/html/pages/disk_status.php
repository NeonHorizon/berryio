
<div class="panel">

  <h2>DISK PARTITIONS</h2>

  <div class="container disk_partitions">

    <h2>Permanent</h2>
    <table>
      <tr>
        <th>Mount</th>
        <th class="right">Size</th>
        <th class="right">Used</th>
        <th class="right">Free</th>
        <th>Usage</th>
      </tr>

      <? foreach($disk_partitions as $partition => $information):?>
        <? if(isset($information['Temporary']['bool']) && !$information['Temporary']['bool'] && isset($information['Used']['value']) && isset($information['Used']['min']) && isset($information['Used']['max'])):?>
          <tr>
            <th><?=h($partition)?></th>
            <td class="right"><?=h(isset($information['Size']['text']) ? $information['Size']['text'] : '')?></td>
            <td class="right"><?=h(isset($information['Used']['text']) ? $information['Used']['text'] : '')?></td>
            <td class="right"><?=h(isset($information['Free']['text']) ? $information['Free']['text'] : '')?></td>
            <td class="code"><?=graph_horizontal_bar($information['Used']['value'], $information['Used']['min'], $information['Used']['max'], isset($information['Used']['positive']) ? $information['Used']['positive'] : '')?></td>
          </tr>
        <? endif?>
      <? endforeach?>
    </table>

  </div>

  <div class="container disk_partitions">

    <h2>Temporary</h2>
    <table>
      <tr>
        <th>Mount</th>
        <th class="right">Size</th>
        <th class="right">Used</th>
        <th class="right">Free</th>
        <th>Usage</th>
      </tr>

      <? foreach($disk_partitions as $partition => $information):?>
        <? if(isset($information['Temporary']['bool']) && $information['Temporary']['bool'] && isset($information['Used']['value']) && isset($information['Used']['min']) && isset($information['Used']['max'])):?>
          <tr>
            <th><?=h($partition)?></th>
            <td class="right"><?=h(isset($information['Size']['text']) ? $information['Size']['text'] : '')?></td>
            <td class="right"><?=h(isset($information['Used']['text']) ? $information['Used']['text'] : '')?></td>
            <td class="right"><?=h(isset($information['Free']['text']) ? $information['Free']['text'] : '')?></td>
            <td class="code"><?=graph_horizontal_bar($information['Used']['value'], $information['Used']['min'], $information['Used']['max'], isset($information['Used']['positive']) ? $information['Used']['positive'] : '')?></td>
          </tr>
        <? endif?>
      <? endforeach?>
    </table>

  </div>
</div>
