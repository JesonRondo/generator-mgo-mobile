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
    <title><%= _.slugify(name) %> - MOGU F2E</title>
    <style>
        <?php echo $less->compileFile($GLOBALS['ROOTPATH'] . '/common/style/reset.less'); ?>
        <?php echo $less->compileFile($GLOBALS['ROOTPATH'] . '/common/style/global.less'); ?>
        <?php echo $less->compileFile($GLOBALS['ROOTPATH'] . '/common/template/header_ushop/index.less'); ?>
        <?php echo $less->compileFile('./index.less'); ?>
        <?php echo $less->compileFile($GLOBALS['ROOTPATH'] . '/common/template/footer_ushop/index.less'); ?>
    </style>
</head>
<body>

    <?php include(dirname(__FILE__) . '/data.php'); ?>

    <% if (sizetype.indexOf('1200') >= 0) { %>
    <div class="ht1200">
    <% } else { %>
    <div class="ht960">
    <% } %>
        <?php include($GLOBALS['ROOTPATH'] . '/common/template/header_ushop/content.php'); ?>
    </div>

    <% if (sizetype.indexOf('1200') >= 0) { %>
    <div class="fm1200">
        <?php include(dirname(__FILE__) . '/content.php'); ?>
    </div>
    <% } %>

    <% if (sizetype.indexOf('960') >= 0) { %>
    <div class="fm960 media_screen_960">
        <?php include(dirname(__FILE__) . '/content.php'); ?>
    </div>
    <% } %>

    <% if (sizetype.indexOf('1200') >= 0) { %>
    <div class="ht1200">
    <% } else { %>
    <div class="ht960">
    <% } %>
        <?php include($GLOBALS['ROOTPATH'] . '/common/template/footer_ushop/content.php'); ?>
    </div>

    <?php include($GLOBALS['ROOTPATH'] . '/common/conf/require.php'); ?>
    <script>
        require([
            '/common/script/base.js'
        ], function() {
            require([
                '/common/template/header_ushop/index.js',
                '/common/template/footer_ushop/index.js'
            ], function() {
                require(['./index']);
            });
        });
    </script>

</body>
</html>
