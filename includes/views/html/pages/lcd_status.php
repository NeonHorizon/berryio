
<div>
  <div class="panel">

    <h2>CONTROL</h2>

    <div class="container">
      <p>
        <a class="button" href="/lcd_initialise">Initialise</a>
        <a class="button" href="/lcd_command/clear">Clear</a>
        <a class="button" href="/lcd_command/home">Home</a>
        <a class="button" href="/lcd_command/new_line">New Line</a>
      </p>
    </div>

    <div class="divider"></div>

    <div class="container">
      <p>
        <a class="button" href="/lcd_command/cursor_left">&lt; Cursor Left</a><br />
        <a class="button" href="/lcd_command/scroll_left">&lt;&lt; Scroll Left</a>
      </p>
    </div>

    <div class="container">
      <form action="/lcd_output" method="post">
        <p>
          <textarea id="lcd_output" name="output" cols="<?=LCD_COLS?>" rows="<?=LCD_ROWS?>" wrap="hard"></textarea><br />
          <input type="submit" name="clear" value="Send" />
          <input type="submit" name="append" value="Append" />
        </p>
      </form>
    </div>

    <div class="container">
      <p>
        <a class="button" href="/lcd_command/cursor_right">Cursor Right &gt;</a><br />
        <a class="button" href="/lcd_command/scroll_right">Scroll Right &gt;&gt;</a>
      </p>
    </div>

    <p><i>Remember to initialise before use!</i></p>

  </div>
</div>


<div>
  <div class="panel">

    <h2>SETUP COMMANDS</h2>

    <div class="container">
      <h2>Layout</h2>
      <p>
        <a class="button" href="/lcd_command/1_line_5x8">1 line, 5x8 font</a>
        <a class="button" href="/lcd_command/2_line_5x8">2 line, 5x8 font</a><br />
        <a class="button" href="/lcd_command/1_line_5x11">1 line, 5x11 font</a>
        <a class="button" href="/lcd_command/2_line_5x11">2 line, 5x11 font</a>
      </p>
      <p><i>Not all modes may be supported</i></p>
    </div>

    <div class="container">
      <h2>Display</h2>
      <p>
        <a class="button" href="/lcd_command/off">Off</a>
        <a class="button" href="/lcd_command/on_cursor">On with cursor</a><br />
        <a class="button" href="/lcd_command/on_no_cursor">On</a>
        <a class="button" href="/lcd_command/on_blink_cursor">On with blinking cursor</a>
      </p>
      <p><i>Not all modes may be supported</i></p>
    </div>


    <div class="container">
      <h2>Entry Mode</h2>
      <p>
        <a class="button" href="/lcd_command/text_forwards">Text left to right</a>
        <a class="button" href="/lcd_command/text_forwards_scroll">Text scroll left to right</a><br />
        <a class="button" href="/lcd_command/text_reverse">Text right to left</a>
        <a class="button" href="/lcd_command/text_reverse_scroll">Text scroll right to left</a>
      </p>
      <p><i>Some modes may only work with append</i></p>
    </div>

  </div>
</div>


<div class="panel not_too_wide">

  <h2>HINTS AND TIPS</h2>

  <p class="left">
    Refer to the config file <?=h(SETTINGS)?>lcd.php for instructions
    on wiring a HDD44780 or KS0066U compatible LCD display. This file also
    includes options for changing the number of characters on the display and
    which GPIO ports you wish to connect the display to.
  </p>

</div>
