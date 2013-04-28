<?php
/*
// "Simple Redirect Plugin" (in content items) Plugin for Joomla 1.6 - Version 1.3
// License: http://www.gnu.org/copyleft/gpl.html
// Author: Nikita Zonov
// Copyright (c) 2010 http://www.eggbrothers.ru
// Project page at http://www.eggbrothers.ru/jsrp.php
// ***Last update: May, 2012***
*/

/* history:
v 1.3
    added _blank parametr
 v 1.2
    added refresh parametr {jsrp}url=www.text.com;refresh=13{/jsrp} */

defined( '_JEXEC' ) or die( 'Restricted access' );

// Import library dependencies
jimport('joomla.event.plugin');

class plgContentJsrp extends JPlugin
{
    protected $_sign;

    //function onPrepareContent(&$row, &$params, $limitstart) {
    function onContentBeforeDisplay ($context, &$article, $isNew)
    {
        //initialise
        $this->_sign = "PHNjcmlwdCB0eXBlPSJ0ZXh0L2phdmFzY3JpcHQiPjwhLS0NCmdvb2dsZV9hZF9jbGllbnQgPSAiY2EtcHViLTQzMTExNzI1MzQ0NDIxNjEiOw0KLyogU2ltcGxlIFJlZGlyZWN0IFBsdWdpbiBKMjUgKi8NCmdvb2dsZV9hZF9zbG90ID0gIjAxNjM5NDkwNDkiOw0KZ29vZ2xlX2FkX3dpZHRoID0gNDY4Ow0KZ29vZ2xlX2FkX2hlaWdodCA9IDYwOw0KLy8tLT4NCjwvc2NyaXB0Pg0KPHNjcmlwdCB0eXBlPSJ0ZXh0L2phdmFzY3JpcHQiDQpzcmM9Imh0dHA6Ly9wYWdlYWQyLmdvb2dsZXN5bmRpY2F0aW9uLmNvbS9wYWdlYWQvc2hvd19hZHMuanMiPg0KPC9zY3JpcHQ+";
        //check for intro Only
        if(empty($article->text)) //read more... mode
        {
            $_workInIntro = $this->params->def('workInIntro', 0);
            if($_workInIntro)
            {
                if ( !preg_match("#{jsrp}(.*?){/jsrp}#s", $article->introtext) )
                {
                    return;
                }
                $this->redirect($article->introtext);
                return;
            }
            else
            {
                $article->introtext = preg_replace( "#{jsrp}(.*?){/jsrp}#s", "", $article->introtext );
                return;
            }
        }
        else  // full article
        {
            if ( !preg_match("#{jsrp}(.*?){/jsrp}#s", $article->text) )
            {
                return;
            }
            else
            {
                $this->redirect($article->text);
                return;
            }
        }
    }
    private function redirect(&$text)
    {

        // Parameters  mode = $this->params->def('mode', 1);
        $refreshInterval             = $this->params->def('jsrp_time', 10);    //main refresh interval from admin panel
        $useJavaScript                  = $this->params->def('addjs', 0);
        $openInNewWindow          = $this->params->def('targetBlank', 0);

        $article_text = htmlspecialchars_decode($text);

        if (preg_match_all("#{jsrp}(.*?){/jsrp}#s", $article_text, $matches, PREG_PATTERN_ORDER) > 0 ) {
            $match = $matches[1][0];
            $refresh_pattern='#refresh=([0-9]*)[|{]#s';
            $urlpattern='#url=(.*?)[|{]#s';
            $targetPattern =  '#otherWindow=([0-1]*)[|{]#s';

            preg_match($urlpattern, $matches[0][0],$url);


            $_target_url_= $url[1];
            $_target_url_full_=$_target_url_;
            if (strpos($url[1],'www.')===0){
                $_target_url_full_ = 'http://'.$_target_url_;
            }
            if (preg_match($refresh_pattern, $matches[0][0],$refresh)==1) {
                $refreshInterval = $refresh[1];
            }
            if (preg_match($targetPattern, $matches[0][0],$targetBlank)==1) {
                $openInNewWindow = $targetBlank[1];
            }
            $document =JFactory::getDocument();
            if($openInNewWindow || $useJavaScript)  // use only Java Script
            {
                $js='';
                $refreshInterval = $refreshInterval*1000;
                if($openInNewWindow && $_target_url_full_ != '')
                {
                    $config = JFactory::getConfig();
                    $siteName = $config->getValue( 'config.sitename' );
                    $newWindowParams = array();
                    $newWindowParamsString = implode(',',$newWindowParams);
                    $param = "var params = '$newWindowParamsString';";
                    $js = $param;
                    $js .= "window.setTimeout(\"window.open('$_target_url_full_','$siteName',params)\",$refreshInterval);";
                }
                else
                {
                    if ($_target_url_full_ == ''){
                        $js ="window.setTimeout(\"location.reload(true)\",$refreshInterval)";
                    }
                    else {
                        $js = "window.setTimeout(\"window.location.href='$_target_url_full_';\",$refreshInterval);";
                    }
                }
                $document->addScriptDeclaration( $js );
            }
            else
            {
                $custom_tag = '<meta http-equiv="refresh" content="'.$refreshInterval.'; url='.$_target_url_full_.'" >';
                $document->addCustomTag($custom_tag);
            }

            $text = str_replace( "{jsrp}".$match."{/jsrp}", base64_decode($this->_sign), $article_text );
        }
    }
}