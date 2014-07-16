<?php
    /**
     * 本地开发环境的ROOTPATH处理
     */
    $GLOBALS['ROOTPATH'] = $_SERVER['DOCUMENT_ROOT'];

    require $GLOBALS['ROOTPATH'] . '/system/less.php';
    $less = new lessc;
?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>header_h5_inof - MOGU F2E</title>
    <meta name="apple-mobile-web-app-title" content="蘑菇街H5" />
    <meta name="format-detection" content="telephone=no" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no" media="(device-height: 568px)" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="grey" />
    <link rel="apple-touch-icon-precomposed" href="/img/imgwap/icon/57x57.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="/img/imgwap/icon/114x114.png" />
    <link rel="apple-touch-startup-image" media="(device-width: 320px) and (device-height: 480px)" href="/img/imgwap/startup/640x920.jpg" />
    <link rel="apple-touch-startup-image" media="(device-width: 320px) and (device-height: 568px)" href="/img/imgwap/startup/640x1096.jpg" />
    <style>
        <?php echo $less->compileFile($GLOBALS['ROOTPATH'] . '/common_mobile/style/base.less'); ?>
        <?php echo $less->compileFile($GLOBALS['ROOTPATH'] . '/common_mobile/template/header_buyer/index.less'); ?>
        <?php echo $less->compileFile('./index.less'); ?>
    </style>
</head>
<body>
    
    <?php include($GLOBALS['ROOTPATH'] . '/common_mobile/template/header_buyer/content.php'); ?>

    <?php include(dirname(__FILE__) . '/data.php'); ?>
    
    <?php include(dirname(__FILE__) . '/content.php'); ?>

    <?php include($GLOBALS['ROOTPATH'] . '/common/conf/require.php'); ?>
    <script>
        require([
            '/common_mobile/script/base.js'
        ], function() {
            require([
                '/common_mobile/template/header_buyer/index.js'
            ], function() {
                require(['./index']);
            });
        });
    </script>

</body>
</html>
