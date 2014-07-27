
<div class="panel">

  <h2>CPU STATUS</h2>

  <div class="container cpu_status">

    <h2>System Load Average</h2>
    <table>
      <tr>
        <th>Time Period</th>
        <th colspan="2">Queued Processes</th>
      </tr>
      <tr>
        <th class="code right">1 Minute</th>
        <td class="code right"><?=h($load_average[0])?></td>
        <td class="code"><?=graph_horizontal_bar(1 - pow(3, -$load_average[0]), 0, 1, FALSE, FALSE)?></td>
      </tr>
      <tr>
        <th class="code right">5 Minutes</th>
        <td class="code right"><?=h($load_average[1])?></td>
        <td class="code"><?=graph_horizontal_bar(1 - pow(3, -$load_average[1]), 0, 1, FALSE, FALSE)?></td>
      </tr>
      <tr>
        <th class="code right">15 Minutes</th>
        <td class="code right"><?=h($load_average[2])?></td>
        <td class="code"><?=graph_horizontal_bar(1 - pow(3, -$load_average[2]), 0, 1, FALSE, FALSE)?></td>
      </tr>
    </table>

  </div>

  <div class="container cpu_status">

    <h2>CPU Readings</h2>
    <table>
      <tr>
        <th>Parameter</th>
        <th colspan="2">Current Value</th>
      </tr>
      <? if($temperature != ''):?>
        <tr>
          <th>Temperature</th>
          <td><?=h($temperature)?><sup>o</sup>C</td>
          <td class="code"><?=graph_horizontal_bar($temperature, CPU_TEMP_MIN, CPU_TEMP_MAX, FALSE)?></td>
        </tr>
      <? endif?>
      <? if($speed != ''):?>
        <tr>
          <th>Speed</th>
          <td><?=h(si_unit($speed, $na, 1000, 0))?>Hz</td>
          <td class="code"><?=graph_horizontal_bar($speed, CPU_SPEED_MIN, CPU_SPEED_MAX, FALSE)?></td>
        </tr>
      <? endif?>
      <? if($voltage != ''):?>
        <tr>
          <th>Voltage</th>
          <td><?=h($voltage)?>V</td>
          <td class="code"><?=graph_horizontal_bar($voltage, $voltage < CPU_VOLT_MIN ? $voltage : CPU_VOLT_MIN, CPU_VOLT_MAX, FALSE)?></td>
        </tr>
      <? endif?>
    </table>

  </div>

</div>
