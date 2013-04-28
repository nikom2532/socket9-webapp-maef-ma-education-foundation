<?php
/**
*** Zen Grid v1.2 Joomla Template Framework is a commercial Joomla template from Joomla Bamboo
*** @author    Joomlabamboo
*** @copyright (C) 2010 by Joomlabamboo
*** @license   Commercial
**/

// no direct access
//http://listen21.com/MAEF/dev-site2/index.php?option=com_content&view=article&id=42/


defined( '_JEXEC' ) or die( 'Restricted index access' );

  if (substr(JVERSION, 0, 3) >= '1.6') {
    $framework = JPATH_SITE.DS.'plugins'.DS.'system'.DS.'zengridframework'.DS.'zengridframework'.DS.'zengrid.php';
    $frameworkPath = JPATH_SITE.DS.'plugins'.DS.'system'.DS.'zengridframework'.DS.'zengridframework';
    $frameworkClass = JPATH_SITE.DS.'plugins'.DS.'system'.DS.'zengridframework'.DS.'zengridframework'.DS.'classes'.DS.'j17'.DS.'zengrid.php';
  }
  else {
    $framework = JPATH_SITE.DS.'plugins'.DS.'system'.DS.'zengridframework'.DS.'zengrid.php';  
    $frameworkPath = JPATH_SITE.DS.'plugins'.DS.'system'.DS.'zengridframework';
    $frameworkClass = JPATH_SITE.DS.'plugins'.DS.'system'.DS.'zengridframework'.DS.'classes'.DS.'zengrid.php';
  }

  if(file_exists($framework)) {
    include_once($frameworkPath.DS.'index.php');
  }
  else { ?>
    <body style="background:#f9f9f9">
      <div style="font-size:12px;font-family: helvetica neue, arial, sans serif;width:600px;margin:0 auto;background: #f9f9f9;border:1px solid #ddd ;margin-top:100px;padding:40px"><h3>Ooops. It looks like the Zengridframework plugin is not installed!</h3><p>The template you are attempting to use requires the Zen Grid Framework.
        <p>Please ensure that you have installed the Zen Grid Framework system plugin in addition to this template.</p>
      </div>
    </body>
<?php }
/*   echo $_GET["option"]."<br/>".$_GET["view"]." <br/>".$_GET["layout"]."<br/>".$_GET["task"]."<br/>".$_GET["id"]."<br/>".$_GET["Itemid"]; */
/*   echo $_GET["Itemid"]; */
/*   echo $_GET["option"]; */


//Arming Huang

$user =& JFactory::getUser();
if (!$user->guest) {
	?><style>
		div#zenpaneltrigger.tab{
			background:#fff url('templates/jbcorporate/images/panel/panelogout.png') no-repeat;
		}
	</style>
	<script>
		jQuery("#nav #menuwrap .item-363 a").attr("href","/index.php?option=com_content&view=article&id=91&Itemid=441");
		jQuery("#nav #menuwrap .item-363 a").html("My Dashboard");
	</script>
	<?php
}


//Handle the jQuery code for the home page here!!!
if($_GET["option"]=="com_content" && $_GET["view"]=="featured")
{  
?>
<script type="text/javascript">
 
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-39217933-1']);
  _gaq.push(['_trackPageview']);
 
  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
 
</script>
<?php

}
?>