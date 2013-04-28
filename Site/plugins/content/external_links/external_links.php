<?php

/**
* @Copyright Copyright (C) 2010 - JoniJnm.es
* @license GNU/GPL http://www.gnu.org/copyleft/gpl.html
**/

defined( '_JEXEC' ) or die('Restricted access');

class plgContentExternal_links extends JPlugin {
	var $redirect;
	var $host;
	var $no_link;
	var $target;
	var $url;
	var $from;
	var $to;
	var $j15;
	var $itemid;
	var $article_id;
	var $params;
	
	function prepare_plugin() {
		$this->j15 = substr(JVERSION, 0, 3) == "1.5";
		if ($this->j15) {
			$plugin = JPluginHelper::getPlugin('content', 'external_links');
			$this->params = new JParameter($plugin->params);
		}
		$this->redirect = $this->params->get('redirect', 'url');
		$this->article_id = $this->params->get("article_id",0);
		$this->no_link = $this->params->get("no_link");
		$this->target = $this->params->get("target");
		$this->rel = $this->params->get("rel");
		$this->host = substr($_SERVER['HTTP_HOST'], 0, 4) == 'www.' ? substr($_SERVER['HTTP_HOST'], 0) : $_SERVER['HTTP_HOST'];
		$this->from = array($this->no_link, '?&', '&&', '&amp;&amp;');
		$this->to = array('', '?', '&', '&amp;');
		$this->itemid = $this->getItemid();

		if ($this->redirect == 'article')
			require_once (JPATH_SITE.DS.'components'.DS.'com_content'.DS.'helpers'.DS.'route.php');

		if ($this->redirect == 'article') {
			$db =& JFactory::getDBO();
			$db->setQuery("SELECT a.id, a.title, a.alias, a.catid, c.alias as calias".($this->j15?', a.sectionid':'').
					" FROM #__content AS a ".
					" LEFT JOIN #__categories AS c ON c.id=a.catid ".
					" WHERE a.id=".$this->article_id);
			$art = $db->loadObject();
			if ($this->j15)
				$url = ContentHelperRoute::getArticleRoute($art->id.":".$art->alias, $art->catid.":".$art->calias, $art->sectionid);
			else
				$url = ContentHelperRoute::getArticleRoute($art->id.":".$art->alias, $art->catid.":".$art->calias);
			if ($this->itemid && strpos($url, "&Itemid=") === false) $url .= '&Itemid='.$this->itemid;
			$this->url = JRoute::_($url);
			$this->url .= strpos($this->url, "?") === false ? '?url=%s' : '&url=%s';
		}
		else {
			if ($this->j15)
				$this->url = $this->params->get("url", JURI::base()."plugins/content/external_links/frame/frameset.php?url=%s");
			else
				$this->url = $this->params->get("url", JURI::base()."plugins/content/external_links/frameset.php?url=%s");
		}
	}
	function onContentBeforeDisplay($context, &$article, &$params, $limitstart=0) {
		if (isset($article->text))
			$article->text = $this->prerareContent($article->text, $article->id);
		else	
			$article->introtext = $this->prerareContent($article->introtext, $article->id);
	}
	function onPrepareContent(&$row, &$params, $page=0) {
		$row->text = $this->prerareContent($row->text, $row->id);
	}
	function prerareContent($text, $id) {
		$this->prepare_plugin();
		$text = preg_replace_callback('/<a([^h]+href="(https?:\/\/(www\.)?([^"]+))"[^>]*)>/', array($this, 'change'), $text);
		if ($id == $this->article_id && JRequest::getVar('url'))
			$text .= '<p align="center"><a href="'.JRequest::getVar('url').'" '.($this->rel?'rel="nofollow"':'').'>'.$this->params->get('add', 'Visit the page').'</a></p>';
		return $text;
	}
	function change($match) {
		$user =& JFactory::getUser();
		$tmp = strpos($match[4], '/');
		if ($tmp !== false)
			$tmp = substr($match[4], 0, $tmp);
		else
			$tmp = $match[4];
		if (substr($tmp, 0, 4) == 'www.')
			$tmp = substr($tmp, 4);
		if ($tmp != $this->host) {
			if ($this->params->get('onlyreg') && !$user->id) {
				$out = str_replace($match[2], 'javascript:alert(\''.$this->params->get('regtext', 'Only registered users can look links').'\')', $match[0]);
				return preg_replace('#target="[^"]+"#', '', $out);
			}
			else {
				if (strpos($match[4], $this->no_link) === false) {
					$attr = $match[1];
					if ($this->target) {
						$attr = preg_replace('/target="[^"]+"/', '', $attr);
						$attr .= ' target="_blank"';
					}
					if ($this->rel) {
						$attr = preg_replace('/rel="[^"]+"/', '', $attr);
						$attr .= ' rel="nofollow"';
					}
					return str_replace($match[2], str_replace('%s', urlencode($match[2]), $this->url), str_replace($match[1], $attr, $match[0]));
				}
				else
					return str_replace($match[2], preg_replace('/(\?|&)$/', '', str_replace($this->from, $this->to, $match[2])), $match[0]);
			}
		}
		return $match[0];
	}
	function getItemid() {
		$db =& JFactory::getDBO();
		if ($this->j15) {
			$db->setQuery('SELECT id FROM #__menu WHERE link="index.php?option=com_content&view=frontpage" AND home=1');
			$id = $db->loadResult();
			if ($id) return $id;
			$db->setQuery('SELECT id FROM #__menu WHERE link="index.php?option=com_content&view=frontpage" AND access=0 AND published=1 ORDER BY id DESC LIMIT 1');
			$id = $db->loadResult();
			if ($id) return $id;
			$db->setQuery('SELECT id FROM #__menu WHERE link LIKE "index.php?option=com_content%" AND access=0 AND published=1 ORDER BY id DESC LIMIT 1');
			$id = $db->loadResult();
		}
		else {
			$db->setQuery('SELECT id FROM #__menu WHERE link="index.php?option=com_content&view=featured" AND home=1');
			$id = $db->loadResult();
			if ($id) return $id;
			$db->setQuery('SELECT id FROM #__menu WHERE link="index.php?option=com_content&view=featured" AND access<=1 AND published=1 ORDER BY id DESC LIMIT 1');
			$id = $db->loadResult();
			if ($id) return $id;
			$db->setQuery('SELECT id FROM #__menu WHERE link LIKE "index.php?option=com_content%" AND access<=1 AND published=1 ORDER BY id DESC LIMIT 1');
			$id = $db->loadResult();
		}
		if ($id) return $id;
		return 0;
	}
}