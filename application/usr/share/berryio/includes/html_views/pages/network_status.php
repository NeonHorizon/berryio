
<div class="panel">

  <h2>INSTALLED INTERFACES</h2>

  <? foreach($network_interfaces as $name => $details):?>
    <?=view('modules/network/interface', array('details' => $details))?>
  <? endforeach?>

</div>

<div>
  <div class="panel">

    <h2>CONFIGURATION</h2>

    <p class="left">
      The default <?=h(NAME)?> Network Manager is wpagui as supplied with Raspbian<br />
      You should configure your wifi networks using the "WiFi Config" utility in the normal way.
    </p>

  </div>
</div>
