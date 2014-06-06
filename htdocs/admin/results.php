<?php

session_start();

require_once 'libs/classes/session.inc.php';
require_once '../includes/mysqlcon.inc.php';

$session = new session();

if(!$session->is_logged_in()){
    header("Location: index.html");
}

?>

<!doctype html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!-- Consider adding a manifest.appcache: h5bp.com/d/Offline -->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
  <meta charset="utf-8">

  <!-- prevent indexing for staging site >>>> NB : REMOVE WHEN GOING LIVE -->
  <meta name="robots" content="noindex,nofollow"/>
 
  <!-- Use the .htaccess and remove these lines to avoid edge case issues.
       More info: h5bp.com/i/378 -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

  <title>BoxyFile</title>
  <meta name="description" content="">

  <!-- Mobile viewport optimized: h5bp.com/viewport -->
  <meta name="viewport" content="width=device-width">

  <!-- Place favicon.ico and apple-touch-icon.png in the root directory: mathiasbynens.be/notes/touch-icons -->

  <link rel="stylesheet" href="../css/style.css">

  <!-- More ideas for your <head> here: h5bp.com/d/head-Tips -->

  <!-- All JavaScript at the bottom, except this Modernizr build.
       Modernizr enables HTML5 elements & feature detects for optimal performance.
       Create your own custom Modernizr build: www.modernizr.com/download/ -->
  <script src="../js/libs/modernizr-2.5.3.min.js"></script>
</head>
<body>
  <!-- Prompt IE 6 users to install Chrome Frame. Remove this if you support IE 6.
       chromium.org/developers/how-tos/chrome-frame-getting-started -->
  <!--[if lt IE 7]><p class=chromeframe>Your browser is <em>ancient!</em> <a href="http://browsehappy.com/">Upgrade to a different browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to experience this site.</p><![endif]-->
  <header>
      <div id="header"></div>
  </header>
  <div role="main">

              <div style="width: 600px; margin: 0 auto;">
                  <img src="../img/boxy_header.jpg" alt="Boxyfile logo" />
              </div>
              <div id="adminresults">
                  <table style="width: 960px; margin: 10px auto;">
                      <tr>
                          <td><a href="export.exec.php"><div id="exportbtn">Export CSV</div></a></td>
                      </tr>
                  </table>
                              
                  <table cellpadding="5px;" style="width: 960px; margin: 0 auto; background: #a39b88;" border="1">
                      
                      <tr>
                          <td class="resulthead">Ref. Number</td>
                          <td class="resulthead">Name</td>
                          <td class="resulthead">Contact Number</td>
                          <td class="resulthead">Email</td>
                          <td class="resulthead">Delivery Address</td>
                          <td class="resulthead">Order Summary</td>
                          <td class="resulthead">Total</td>
                          <td class="resulthead">Date</td>
                      </tr>
                      
                      <?php
                      
                        $query = "SELECT ref, name, contact_number, email_address, delivery_address, order_summery, total, date FROM orders ORDER BY unix DESC";
                        $result = mysql_query($query) or die(mysql_error());
                        
                        if(mysql_num_rows($result) > 0){
                            while($data = mysql_fetch_array($result, MYSQLI_ASSOC)){?>
                               
                            <tr>
                                <td id="refnum"><?php echo $data['ref']; ?></td>
                                <td id="name"><?php echo $data['name']; ?></td>
                                <td id="contact"><?php echo $data['contact_number']; ?></td>
                                <td id="email"><?php echo $data['email_address']; ?></td>
                                <td id="delivery"><?php echo nl2br($data['delivery_address']); ?></td>
                                <td id="summary"><?php echo nl2br($data['order_summery']); ?></td>
                                <td id="total"><?php echo $data['total']; ?></td>
                                <td id="date"><?php echo $data['date']; ?></td>
                            </tr>
                      
                            <?php }
                        }
                      
                      ?>
                      
                      
                  </table>
              </div>
  </div><!-- main close -->
  <footer>
      <p>(C) Copyright Boxyfile. All rights reserved.</p>
  </footer>

  <!-- JavaScript at the bottom for fast page loading -->

  <!-- Grab Google CDN's jQuery, with a protocol relative URL; fall back to local if offline -->
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
  <script>window.jQuery || document.write('<script src="../js/libs/jquery-1.7.1.min.js"><\/script>')</script>
  
    <!-- ======================SLIDES.JS ================= -->


  <!-- scripts concatenated and minified via build script -->
  <script src="../js/plugins.js"></script>

  <!-- end scripts -->

  <!-- Asynchronous Google Analytics snippet. Change UA-XXXXX-X to be your site's ID.
       mathiasbynens.be/notes/async-analytics-snippet -->
  <script>
    var _gaq=[['_setAccount','UA-34767107-1'],['_trackPageview']];
    (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
    g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
    s.parentNode.insertBefore(g,s)}(document,'script'));
  </script>
</body>
</html>