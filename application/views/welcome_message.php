<html>
    <head>
        <title>
            <?php echo $this->config->item('product_name') ?>
        </title>

        <link rel="stylesheet" type="text/css" media="all" href="<?php echo site_url("static/bootstrap/css/bootstrap.css") ?>">
        <link rel="stylesheet" type="text/css" media="all" href="<?php echo site_url("static/base.css") ?>">

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-34811952-1']);
  _gaq.push(['_trackPageview']);

    (function() {
            var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
                ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
                  })();

  </script>


    </head>

    <body>

<div id="social-bar">
<div class="wrapper">
    Follow the creator on Twitter here: <a href="http://www.twitter.com/kumobius">@kumobius</a>
</div>
</div>
<div id="header">
    <div class="wrapper">
        <iframe class="header-iframe" src="<?php echo site_url('/deploy/access/' . $this->config->item('product_public')) ?>" width="330" height="130" scrolling="no" frameborder="0" style="border:none;"></iframe>

        <h1><a href="<?php echo site_url()  ?>"><?php echo $this->config->item('product_name') ?></a></h1>
<strong>The missing link in Steam Greenlight&trade;</strong>

<em>Check out the example on the right &rarr;</em>

    </div>
</div>

<div id="main">
    <div class="wrapper">

        <p class="lead">
            <?php echo $this->config->item('product_name') ?> is a little tool that helps you easily link to your Steam Greenlight&trade; project page.
            Users will see a nice widget or banner on your website and be driven to upvote your game!
        </p>

        <div id="homepage-content">
        <h2>Create a Widget!</h2>

        <?php if ($error_message): ?>
            <div class="error-message">
                <?php echo $error_message ?>
            </div>
        <?php endif; ?>
        
        <?php if ($result): ?>
            <div class="success-message">
                <?php echo $result ?>
            </div>
        <?php endif; ?>

        <form action="<?php echo site_url("process/submit") ?>" method="post">
        
            <p>Enter the URL to your Steam Greenlight&trade; project on Steam:</p>
            <input id="steam_url_input" name="steam_url" placeholder="Paste your game's Greenlight URL here.." class="input" type="text" />
            
            <br>
            <!--<button class="btn">Go!</button>-->
        
            <p>Provide your email and we'll send you a secret link to access the widget code + some analytics feedback on your widget:</p>

            <input id="steam_email_input" name="email" placeholder="Enter your email" type="email" class="input" />
            <br>

            <button type="submit" class="btn btn-primary">Send Access Email</button>
        </form>

        </div>

<hr>

        <h2>What's it look like?</h2>

        <p><strong>Example:</strong> for Bean's Quest</p>

        <label>Greenlight&trade; URL:</label>
        <code>http://steamcommunity.com/sharedfiles/filedetails/?id=93030406</code>

        <br>
        <br>

        <label>Resulting Widget:</label>
        <iframe src="<?php echo site_url('deploy/access/' . $this->config->item('product_public')) ?>" width="330" height="130" scrolling="no" frameborder="0" style="border:none;"></iframe>

        <br>
        <br>

        <label>Resulting Banner:</label>
        <iframe src="<?php echo site_url('deploy/access/' . $this->config->item('product_public') . '/1') ?>" width="100%" height="130" scrolling="no" frameborder="0" style="border:none;"></iframe>
 

        <h2>FAQ</h2>

        <h4>What's the point of this?</h4>
        <p>
            Steam have just launched Greenlight&trade; and it is already very populated. I was hoping there'd be an easy way to link to your Greenlight&trade; project page from your own website or on forums. A regular anchor link will do this but I believe a more consistent look for this type of branding will help grab your user's attention and drive them to upvote you!
        </p>
        
        <h4>What if Steam releases their own widget? Won't this become pointless?</h4>
        <p>
            Yes! And that'd be great. If <?php echo $this->config->item('product_name') ?> becomes completely irrelevant I'll arrange to provide every user with a method of downloading their data.
        </p>

        <h4>Who are you?</h4>
        <p>
            I'm an indie developer and one third of the Australian studio <a href="http://www.kumobius.com/">Kumobius</a>. We've done pretty well on iOS and Android. We'd like to be on Steam and I created this tool to help encourge more votes for our product on Greenlight&trade;. Our premiere game is <a href="http://steamcommunity.com/sharedfiles/filedetails/?id=93030406">Bean's Quest</a> - an awesome platformer, feel free to upvote it if you appreciate what I've done here. We're also hard at work on our next game.
        </p>


        <h2>Credits</h2>
    
        <p class="small">
            This website was built using <a href="http://codeigniter.com/">CodeIgniter</a>, part of Ellislab. Graphics on this page include icons from <a href="http://glyphicons.com/">Glyphicons</a>, background patterns from <a href="http://luukvanbaars.com/">Luuk van Baars's</a> <a href="http://subtlepatterns.com/shattered/">"Shattered"</a> and Cary Fleming's <a href="http://subtlepatterns.com/black-twill/">Black Twill</a>
        </p>

        <h2>Contact</h2>

        <p>
        Got a question about <?php echo $this->config->item('product_name') ?>? Contact us at <a href="http://kumobius.com/contact/">Kumobius here.</a>
        </p>
        
    </div>
</div>

<div id="footer">
If you like <?php echo $this->config->item('product_name') ?> and find it useful, please consider upvoting Kumobius's game <a href="http://steamcommunity.com/sharedfiles/filedetails/?id=93030406">"Bean's Quest" on Steam Greenlight&trade;</a> as well &lt;3
</div>

    </body>
</html>
