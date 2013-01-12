
HINTS AND TIPS:

  The default Network Manager supplied with Raspbian is wpagui.
  You can use this to configure your wifi networks by clicking
  on the "WiFi Config" utility on the desktop.

INSTALLED INTERFACES:
<? foreach($network_interfaces as $name => $details):?>
<?=view('modules/network/interface', array('details' => $details))?>
<? endforeach?>