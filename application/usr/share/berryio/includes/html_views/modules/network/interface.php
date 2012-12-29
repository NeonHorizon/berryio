
<div class="container network_interface">

  <? if(isset($details['Link']['bool']) && isset($details['Connected']['bool']) && $details['Link']['bool'] && $details['Connected']['bool']):?>
    <img class="network_interface" src="/images/network_interface/<?=strtolower($details['Media']['text'])?>_2.png" alt="Connected and working <?=$details['Media']['text']?> interface" title="Connected and working!" />
  <? elseif(isset($details['Link']['bool']) && $details['Link']['bool']):?>
    <img class="network_interface" src="/images/network_interface/<?=strtolower($details['Media']['text'])?>_1.png" alt="Connected but idle <?=$details['Media']['text']?> interface" title="Connected but idle" />
  <? elseif(isset($details['Connected']['bool']) && $details['Connected']['bool']):?>
    <img class="network_interface" src="/images/network_interface/<?=strtolower($details['Media']['text'])?>_1.png" alt="Connected but idle <?=$details['Media']['text']?> interface" title="Connected but idle" />
  <? else:?>
    <img class="network_interface" src="/images/network_interface/<?=strtolower($details['Media']['text'])?>_0.png" alt="Not connected <?=$details['Media']['text']?> interface" title="Not connected" />
  <? endif?>

  <h2><?=h($details['Interface']['text'])?></h2>
  <table>

    <? foreach($details as $name => $information):?>

      <? if(isset($information['value']) && isset($information['min']) && isset($information['max'])):?>
        <tr>
          <th><?=h($name)?>:</th>
          <td class="code"><?=graph_horizontal_bar($information['value'], $information['min'], $information['max'], isset($information['positive']) ? $information['positive'] : '')?></td>
        </tr>
      <? elseif(isset($information['text']) && $name != 'Interface'):?>
        <tr>
          <th><?=h($name)?>:</th>
          <td class="code"><?=h($information['text'])?></td>
        </tr>
      <? endif?>

    <? endforeach?>

  </table>
</div>
