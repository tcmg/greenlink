<html>
    <head>
        <title><?php echo $game->steam_title ?></title>

        <link rel="stylesheet" type="text/css" media="all" href="<?php echo site_url("static/deploy.css") ?>">
    </head>
    <body>
    <div id="gl_widget">
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
                    Vote for
                    <h1>
                        <?php echo $game->steam_title ?>
                    </h1>
                    on Steam Greenlight&trade;!
                </div>

                <div id="gl_platforms">
                    <label>Platforms:</label>
                    <?php foreach($platforms as $platform): ?>
                        <span class="platform-icon <?php echo $platform ?>" title="<?php echo $platform ?>"><?php echo $platform ?></span>
                    <?php endforeach; ?>
                </div>

                <div id="gl_genres">
                    <label>Genres:</label>
                    <?php foreach($genres as $genre): ?>
                        <span class="genre-icon <?php echo $genre ?>" title="<?php echo $genre ?>"><?php echo $genre ?></span>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="clear"></div>
        </a>
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
