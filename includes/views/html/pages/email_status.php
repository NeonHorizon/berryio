
<div>
  <div class="panel">

    <h2>TESTING</h2>

    <a class="button" href="/email_ip">Email IP Address</a>

  </div>
</div>

<div class="panel not_too_wide">

  <h2>HINTS AND TIPS</h2>

  <p class="left">
    The default MTA (Mail Transfer Agent) used by <?=h(NAME)?> is <a href="http://msmtp.sourceforge.net/">msmtp</a>.<br />
    The email account settings for msmtp are in the file /etc/msmtprc<br />
    <?=h(NAME)?> email addresses must be configured in the file <?=h(SETTINGS)?>email.php<br />
  </p>
  <p class="left">
    Currently emails are sent to <a href="mailto:<?=h(EMAIL_TO)?>"><?=h(EMAIL_TO)?></a> and will arrive from <a href="mailto:<?=h(EMAIL_FROM)?>"><?=h(EMAIL_FROM)?></a>.
  </p>

</div>
