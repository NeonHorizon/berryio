<?=REAL_NAME?> V<?=$GLOBALS['VERSION_NO']?> (<?=$GLOBALS['VERSION_DATE']?>)

VERSION HISTORY:
<? foreach($GLOBALS['VERSION_HISTORY'] as $version):?>

  V<?=$version[VERSION_NO]?> (<?=$version[VERSION_DATE]?>)
<? foreach($version[VERSION_DETAILS] as $details):?>
  <?=$details?>

<? endforeach?>
<? endforeach?>

LICENSE:

  This program is free software: you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation, either version 3 of the License, or
  (at your option) any later version.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program.  If not, see http://www.gnu.org/licenses/.

CREDITS:

  SPI module based on code from the Gertboard test suite:
  Copyright (C) Gert Jan van Loo & Myra VanInwegen 2012

CONTACT:

  <?=ABOUT_CONTACT?>

  <?=ABOUT_URL?>

