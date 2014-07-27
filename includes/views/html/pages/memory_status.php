
<div class="panel">

  <h2>MEMORY</h2>

  <div class="container memory_locations">

    <h2>Physical</h2>
    <table>
      <tr>
        <th>Type</th>
        <th class="right">Size</th>
        <th class="right">Used</th>
        <th class="right">Free</th>
        <th>Usage</th>
      </tr>

      <? foreach($memory_locations as $location => $information):?>
        <? if(isset($information['Virtual']['bool']) && !$information['Virtual']['bool'] && isset($information['Used']['value']) && isset($information['Used']['min']) && isset($information['Used']['max'])):?>
          <tr>
            <th><?=h($location)?></th>
            <td class="right"><?=h(isset($information['Size']['text']) ? $information['Size']['text'] : '')?></td>
            <td class="right"><?=h(isset($information['Used']['text']) ? $information['Used']['text'] : '')?></td>
            <td class="right"><?=h(isset($information['Free']['text']) ? $information['Free']['text'] : '')?></td>
            <td class="code"><?=graph_horizontal_bar($information['Used']['value'], $information['Used']['min'], $information['Used']['max'], isset($information['Used']['positive']) ? $information['Used']['positive'] : '', isset($information['Used']['absolute']) && $information['Used']['absolute'])?></td>
          </tr>
        <? endif?>
      <? endforeach?>
    </table>

  </div>

  <div class="container memory_locations">

    <h2>Virtual</h2>
    <table>
      <tr>
        <th>Type</th>
        <th class="right">Size</th>
        <th class="right">Used</th>
        <th class="right">Free</th>
        <th>Usage</th>
      </tr>

      <? foreach($memory_locations as $location => $information):?>
        <? if(isset($information['Virtual']['bool']) && $information['Virtual']['bool'] && isset($information['Used']['value']) && isset($information['Used']['min']) && isset($information['Used']['max'])):?>
          <tr>
            <th><?=h($location)?></th>
            <td class="right"><?=h(isset($information['Size']['text']) ? $information['Size']['text'] : '')?></td>
            <td class="right"><?=h(isset($information['Used']['text']) ? $information['Used']['text'] : '')?></td>
            <td class="right"><?=h(isset($information['Free']['text']) ? $information['Free']['text'] : '')?></td>
            <td class="code"><?=graph_horizontal_bar($information['Used']['value'], $information['Used']['min'], $information['Used']['max'], isset($information['Used']['positive']) ? $information['Used']['positive'] : '', isset($information['Used']['absolute']) && $information['Used']['absolute'])?></td>
          </tr>
        <? endif?>
      <? endforeach?>
    </table>

  </div>
</div>
