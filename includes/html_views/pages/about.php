
<?=usage()?>

<div>
  <div class="panel">
    <h2>VERSION HISTORY</h2>
    <a class="button" href="/check_version">Check for updates</a>

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
  </div>
</div>

<div>
  <div class="panel not_too_wide">
    <h2>LICENSE</h2>

    <p>
      This program is free software: you can redistribute it and/or modify
      it under the terms of the GNU General Public License as published by
      the Free Software Foundation, either version 3 of the License, or
      (at your option) any later version.
    </p>
    <p>
      This program is distributed in the hope that it will be useful,
      but WITHOUT ANY WARRANTY; without even the implied warranty of
      MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
      GNU General Public License for more details.
    </p>
    <p>
      You should have received a copy of the GNU General Public License
      along with this program.  If not, see <a target="_blank" href="http://www.gnu.org/licenses/">http://www.gnu.org/licenses/</a>.
    </p>
  </div>
</div>

<div>
  <div class="panel not_too_wide">
    <h2>CREDITS</h2>

    <p>
      SPI module based on code from the Gertboard test suite:<br />
      Copyright (C) Gert Jan van Loo & Myra VanInwegen 2012
    </p>
  </div>
</div>

<div>
  <div class="panel not_too_wide">
    <h2>CONTACT</h2>
    <p>
      <a href="mailto:<?=ABOUT_CONTACT?>"><?=h(ABOUT_CONTACT)?></a><br />
      <a href="<?=ABOUT_URL?>"><?=h(ABOUT_URL)?></a>
    </p>
  </div>
</div>
