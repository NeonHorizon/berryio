
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
        <td class="code right" id="cpu_1m_num"><?=h($load_average[0])?></td>
        <td class="code"><?=graph_horizontal_bar(1 - pow(SYSTEM_LOAD_SENSITIVITY, -$load_average[0]), 0, 1, FALSE, FALSE, 'cpu_1m')?></td>
      </tr>
      <tr>
        <th class="code right">5 Minutes</th>
        <td class="code right" id="cpu_5m_num"><?=h($load_average[1])?></td>
        <td class="code"><?=graph_horizontal_bar(1 - pow(SYSTEM_LOAD_SENSITIVITY, -$load_average[1]), 0, 1, FALSE, FALSE, 'cpu_5m')?></td>
      </tr>
      <tr>
        <th class="code right">15 Minutes</th>
        <td class="code right" id="cpu_15m_num"><?=h($load_average[2])?></td>
        <td class="code"><?=graph_horizontal_bar(1 - pow(SYSTEM_LOAD_SENSITIVITY, -$load_average[2]), 0, 1, FALSE, FALSE, 'cpu_15m')?></td>
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
          <td id="cpu_temp_num"><?=h($temperature)?><sup>o</sup>C</td>
          <td class="code"><?=graph_horizontal_bar($temperature, CPU_TEMP_MIN, CPU_TEMP_MAX, FALSE, TRUE, 'cpu_temp')?></td>
        </tr>
      <? endif?>
      <? if($speed != ''):?>
        <tr>
          <th>Speed</th>
          <td id="cpu_speed_num"><?=h(si_unit($speed, $na, 1000, $speed > 1000000000 ? 1 : 0))?>Hz</td>
          <td class="code"><?=graph_horizontal_bar($speed, CPU_SPEED_MIN, CPU_SPEED_MAX, FALSE, TRUE, 'cpu_speed')?></td>
        </tr>
      <? endif?>
      <? if($voltage != ''):?>
        <tr>
          <th>Voltage</th>
          <td id="cpu_volt_num"><?=h($voltage)?>V</td>
          <td class="code"><?=graph_horizontal_bar($voltage, $voltage < CPU_VOLT_MIN ? $voltage : CPU_VOLT_MIN, CPU_VOLT_MAX, FALSE, TRUE, 'cpu_volt')?></td>
        </tr>
      <? endif?>
    </table>

  </div>

</div>
