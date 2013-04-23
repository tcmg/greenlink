<html>
<head>
    <title><?php echo $this->config->item('product_name') ?></title>

    <link rel="stylesheet" type="text/css" media="all" href="<?php echo site_url("static/bootstrap/css/bootstrap.css") ?>">
    <link rel="stylesheet" type="text/css" media="all" href="<?php echo site_url("static/base.css") ?>">
</head>
<body>

<div id="header">
    <div class="wrapper">
        <h1>Deployment Code</h1>
    </div>
</div>

<div id="main">
    <div class="wrapper">
<p>Hello! Thanks for trying <?php echo $this->config->item('product_name') ?></p>

<h3>Widget Stuff</h3>

<p>
Copy and paste the following code into your webpage. Users will click the link and be directed to your Greenlight&trade; page to upvote you.
</p>

<textarea class="code-example">
<iframe src="<?php echo site_url('deploy/access/' . $game->public_token) ?>" width="330" height="130" scrolling="no" frameborder="0" style="border:none;"></iframe>
</textarea>

<p>Here is the widget in action!</p>

<iframe src="<?php echo site_url('deploy/access/' . $game->public_token) ?>" width="330" height="130" scrolling="no" frameborder="0" style="border:none;"></iframe>

<p>Get a <a href="<?php echo site_url('deploy/access/' . $game->public_token) ?>">direct link to the widget here.</a></p>

<h3>Banner Script</h3>

<p>
Copy and paste the following code into your webpage. When your page loads, an iFrame banner will be automatically added to the top of your webpage encouraging the user to upvote your game. Look at the top of this page for an example!
</p>

<textarea class="code-example">
<script type="text/javascript" src="<?php echo site_url('deploy/banner_js/' . $game->public_token) ?>"></script>
</textarea>

<script type="text/javascript" src="<?php echo site_url('deploy/banner_js/' . $game->public_token) ?>"></script>

<h3>Analytics</h3>

<div id="analytics-page">
    <p>
        A simple breakdown of where your traffic is coming from:
    </p>

    <div id="analytics-pie">

    </div>

    <p>
        Clicks per day:
    </p>

    <div id="analytics-line">
        
    </div>
</div>

    </div>
</div>

</body>

<script>
var pieData = <?php echo $pie_data_json ?>;
var lineData = <?php echo $line_data_json ?>;
</script>

<script src="<?php echo site_url('static/jquery.js') ?>"></script>
<script src="<?php echo site_url('static/flot/jquery.flot.js') ?>"></script>
<script src="<?php echo site_url('static/flot/jquery.flot.pie.js') ?>"></script>
<script src="<?php echo site_url('static/base.js') ?>"></script>

</html>
