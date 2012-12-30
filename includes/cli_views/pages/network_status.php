
NETWORK CONFIGURATION:

  The default <?=NAME?> Network Manager is wpagui as supplied with Raspbian
  You should configure your wifi networks using the "WiFi Config" utility in the normal way.

INSTALLED INTERFACES:
<? foreach($network_interfaces as $name => $details):?>
<?=view('modules/network/interface', array('details' => $details))?>
<? endforeach?>