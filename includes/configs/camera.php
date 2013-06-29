<?
/*------------------------------------------------------------------------------
  BerryIO Camera Configuration
------------------------------------------------------------------------------*/

// Extensions we should create thumbnails from
$GLOBALS['CAMERA_EXTENSIONS']['IMAGES'] = array('png', 'jpg', 'gif');
$GLOBALS['CAMERA_EXTENSIONS']['VIDEOS'] = array();

// Common Options
$GLOBALS['CAMERA_OPTIONS']['COMMON']['Processing'] = array(
  'br'  => array( 'name' => 'Brightness',          'type' => 'percent',  'default' => 50,        'multiply' => 1,      'offset' => 0,    ), // 0 to 100
  'co'  => array( 'name' => 'Contrast',            'type' => 'percent',  'default' => 50,        'multiply' => 2,      'offset' => -100, ), // -100 to 100
  'sh'  => array( 'name' => 'Sharpness',           'type' => 'percent',  'default' => 50,        'multiply' => 2,      'offset' => -100, ), // -100 to 100
  'sa'  => array( 'name' => 'Saturation',          'type' => 'percent',  'default' => 50,        'multiply' => 2,      'offset' => -100, ), // -100 to 100
);

$GLOBALS['CAMERA_OPTIONS']['COMMON']['Settings'] = array(
  'w'   => array( 'name' => 'Width',               'type' => 'select',   'default' => 2592,      'options'  => array(  64 => 64, 160 => 160, 320 => 320, 640 => 640, 1280 => 1280, 1360 => 1360, 1600 => 1600, 1920 => 1920, 2592 => '2592 (images only)', )    ),
  'h'   => array( 'name' => 'Height',              'type' => 'select',   'default' => 1944,      'options'  => array(  64 => 64, 120 => 120, 240 => 240, 480 => 480, 720  => 720,  768  => 768,  900  => 900,  1080 => 1080, 1944 => '1944 (images only)', )    ),
  'awb' => array( 'name' => 'White Balance',       'type' => 'select',   'default' => 'auto',    'options'  => array(  'off' => 'Off', 'auto' => 'Automatic', 'sun' => 'Sunny', 'cloud' => 'Cloudy', 'shade' => 'Shaded', 'tungsten' => 'Tungsten', 'fluorescent' => 'Fluorescent', 'incandescent' => 'Incandescent', 'flash' => 'Flash', 'horizon' => 'Horizon', ), ),
  'ev'  => array( 'name' => 'Exposure',            'type' => 'percent',  'default' => 50,        'multiply' => 0.2,    'offset' => -10,  ), // -10 to 10
  'mm'  => array( 'name' => 'Metering',            'type' => 'select',   'default' => 'average', 'options'  => array(  'average' => 'Average', 'spot' => 'Spot', 'backlit' => 'Backlit', 'matrix' => 'Matrix' ), ),
  'ex'  => array( 'name' => 'Mode',                'type' => 'select',   'default' => 'auto',    'options'  => array(  'off' => 'Off','auto' => 'Automatic', 'night' => 'Night', 'nightpreview' => 'Night Preview', 'backlight' => 'Back Lit', 'spotlight' => 'Spotlight',   'sports' => 'Sports', 'snow' => 'Snow', 'beach' => 'Beach', 'verylong' => 'Long Exposure', 'fixedfps' => 'Fixed FPS', 'antishake' => 'Antishake', 'fireworks' => 'Fireworks', ), ),
);

$GLOBALS['CAMERA_OPTIONS']['COMMON']['Orientation'] = array(
  'rot' => array( 'name' => 'Rotation',            'type' => 'select',   'default' => 0,         'options'  => array(0 => 'Upright', 90 => 'Clockwise', 180 => 'Upside Down', 240 => 'Anticlockwise', ) ),
  'hf'  => array( 'name' => 'Horizontal Flip',     'type' => 'on_off',   'default' => 0,         ),
  'vf'  => array( 'name' => 'Vertical Flip',       'type' => 'on_off',   'default' => 0,         ),
);

$GLOBALS['CAMERA_OPTIONS']['COMMON']['Effects'] = array(
  'cfx' => array( 'name' => 'Colour',              'type' => 'select',   'default' => '0:0',     'options'  => array(  '0:0' => 'Colour', '128:128' => 'Monochrome'), ),
  'ifx' => array( 'name' => 'Special FX',          'type' => 'select',   'default' => 'Off',     'options'  => array(  'none' => 'Off', 'negative' => 'Negative', 'solarise' => 'Solarise', 'posterize' => 'Posterise', 'whiteboard' => 'Whiteboard', 'blackboard' => 'Blackboard', 'sketch' => 'Sketch', 'denoise' => 'Remove Noise', 'emboss ' => 'Emboss', 'oilpaint' => 'Oil Painting', 'hatch' => 'Hatch Sketch', 'gpen' => 'Gpen', 'pastel' => 'Pastel', 'watercolour' => 'Watercolour', 'film' => 'Film', 'blur' => 'Blur', 'saturation' => 'Colour Saturate', 'colourswap' => 'Swap Colours', 'washedout' => 'Wash Out', 'posterise' => 'Posterise', 'colourpoint' => 'Colourpoint', 'colourbalance' => 'Colour Balance', 'cartoon' => 'Cartoon', ), ),
);

// Image Only Options
$GLOBALS['CAMERA_OPTIONS']['IMAGES']['Images'] = array(
  'e'   => array( 'name' => 'Encoding',            'type' => 'select',   'default' => 'jpg',     'options'  => array(  'jpg' => 'JPEG (compressed)', 'png' => 'PNG (uncompressed)')    ),
  'q'   => array( 'name' => 'Quality',             'type' => 'percent',  'default' => 75,        'multiply' => 1,      'offset' => 0,    ), // 0 to 100
);

// Video Only Options
$GLOBALS['CAMERA_OPTIONS']['VIDEOS']['Video'] = array(
  'vs'  => array( 'name' => 'Stabilisation',       'type' => 'on_off',   'default' => 0,         ),
  'b'   => array( 'name' => 'Bitrate',             'type' => 'percent',  'default' => 50,        'multiply' => 340000, 'offset' => 0,    ), // 0MB/s to 34MB/s, 17MB/s default
  'fps' => array( 'name' => 'Framerate',           'type' => 'percent',  'default' => 100,       'multiply' => 0.28,   'offset' => 2,    ), // 2fps to 30fps default 30fps
);

