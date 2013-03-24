
<div class="panel">

  <h2>INSTALLED INTERFACES</h2>

  <? foreach($network_interfaces as $name => $details):?>
    <?=view('modules/network/interface', array('details' => $details))?>
  <? endforeach?>

</div>

<div>
  <div class="panel not_too_wide">

    <h2>HINTS AND TIPS</h2>

    <p class="left">
      The default Network Manager supplied with Raspbian is wpagui.
      You can use this to configure your wifi networks by clicking on the "WiFi Config" utility on the desktop.
    </p>

  </div>
</div>
