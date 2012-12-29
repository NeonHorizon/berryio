
<div>
  <div class="panel">

    <h2>TESTING</h2>

    <a class="button" href="/email_ip">Email IP Address</a>

  </div>
</div>

<div class="panel">

  <h2>CONFIGURATION</h2>

  <p class="left">
    The default <?=h(NAME)?> MTA (Mail Transfer Agent) is <a href="http://msmtp.sourceforge.net/">msmtp</a><br />
    Email account settings for msmtp are set in the file /etc/msmtprc<br />
    <?=h(NAME)?> email addresses must be configured in the file <?=h(SETTINGS)?>email.php<br />
  </p>
  <p class="left">
    Emails will be sent to <a href="mailto:<?=h(EMAIL_TO)?>"><?=h(EMAIL_TO)?></a> by default<br />
    Emails will be sent from <a href="mailto:<?=h(EMAIL_FROM)?>"><?=h(EMAIL_FROM)?></a> by default<br />
  </p>

</div>
