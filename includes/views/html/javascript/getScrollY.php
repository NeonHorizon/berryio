
<script type="text/javascript">
  function getScrollY() {
    var scroll = 0;
    if( typeof( window.pageYOffset ) == 'number' )
      return window.pageYOffset;
    if( document.body && document.body.scrollTop )
      return document.body.scrollTop;
    if( document.documentElement && document.documentElement.scrollTop )
      return document.documentElement.scrollTop;
    return 0;
  }
</script>
