
<div class="panel">
  <h2>CHANGELOG</h2>

  <table>
    <? foreach($GLOBALS['VERSION_HISTORY'] as $version):?>
      <tr>
        <th class="top">V<?=$version[VERSION_NO]?></th>
        <td class="top no_break"><?=$version[VERSION_DATE]?></td>
        <td class="top">
          <? foreach($version[VERSION_DETAILS] as $details):?>
            <?=h($details)?><br />
          <? endforeach?>
        </td>
      </tr>
    <? endforeach?>
  </table>

  <a class="button" href="/check_version">Check For Updates</a>
</div>
