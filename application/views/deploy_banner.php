<html>
    <head>
        <title><?php echo $game->steam_title ?></title>

        <link rel="stylesheet" type="text/css" media="all" href="<?php echo site_url("static/deploy.css") ?>">
    </head>
    <body>
    <div id="gl_banner">
    <div class="wrapper">
<!--        <a href="http://steamcommunity.com/sharedfiles/filedetails/?id=<?php echo $game->steam_id ?>">-->
        <a id="a" target="_blank" href="<?php echo site_url('deploy/refer/' . $game->public_token) ?>">
            <div id="gl_image">
            <!--
                <div id="img" style="background: url(<?php echo site_url("image/index/" . $game->id) ?>);" />
                </div>
                -->
                <img src="<?php echo $game->steam_icon_url ?>" />
            </div>
            <div id="gl_stats">
                <div id="gl_title">
                    <h1>
                        <?php echo $game->steam_title ?>
                    </h1>
                    is listed on Steam Greenlight&trade;
                </div>
                <div id="gl_subtitle">
                    If you have a Steam account, click here to visit the page and upvote <?php echo $game->steam_title ?>!
                </div>
            </div>

            <div class="clear"></div>
        </a>
    </div>
    </div>

<script>
var a = document.getElementById('a');

a.href = a.href + '?q=' + parent.location;

a.onclick = function() {
    parent.location  = a.href;
    return false;
}
</script>

    </body>
</html>
