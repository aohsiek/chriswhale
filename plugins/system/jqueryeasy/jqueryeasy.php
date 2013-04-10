<?php
/**
 * @copyright	Copyright (C) 2011 Simplify Your Web, Inc. All rights reserved.
 * @license		GNU General Public License version 3 or later; see LICENSE.txt
*/

// no direct access
defined( '_JEXEC' ) or die;

// import library dependencies
jimport('joomla.plugin.plugin');

class plgSystemJqueryeasy extends JPlugin {
	
	public function __construct( &$subject, $config ) {
		
		parent::__construct( $subject, $config );	
        
        $this->_jqpath = '';
		$this->_jquipath = '';
		$this->_jquicsspath = '';		
		$this->_jqnoconflictpath = '';
		
		$this->_usejQuery = 0;
		$this->_usejQueryUI = 0;
				
		//$this->loadLanguage(); // needed?
		
		$this->_enabled = true;
	} 
	
	function onAfterRoute() {
		
		if (JFactory::getDocument()->getType() !== 'html') { 
			// put here so JFactory::getDocument() does not break feeds (will break if used in any function before onAfterRoute)
			// https://groups.google.com/forum/?fromgroups#!topic/joomla-dev-general/S0GYKhLm92A
			$this->_enabled = false;
		}
		
		if (!$this->_enabled) {
			return;
		}
		
        $app = JFactory::getApplication();		
		$doc = JFactory::getDocument();
		
		// enable plugin only on the allowed pages
		if ($app->isSite()) {
			$includedPaths = trim( (string) $this->params->get('enableonlyin', ''));
			if ($includedPaths) {
				$this->_includedpaths = array_map('trim', (array) explode("\n", $includedPaths));
				$found = false;
				foreach ($this->_includedpaths as $path) {
					if (strstr(JURI::current(), $path)) {
						$found = true;
					}
				}				
				if (!$found) {
					$this->_enabled = false;
					return;
				}
			}
		}
		
		$suffix = 'frontend';
		if ($app->isAdmin()) {
			$suffix = 'backend';
		}
		
		$useWhat = $this->params->get('jqueryin'.$suffix, 0);
		switch ($useWhat) {
			case 1: $this->_usejQuery = 1; break;
			case 2: $this->_usejQuery = 1; $this->_usejQueryUI = 1; break;
			default: break;
		}
		
		if (!$this->_usejQuery) {
			return;
		}
		
		// disable plugin in the listed pages
		if ($app->isSite()) {
			$excludedPaths = trim( (string) $this->params->get('disablein', ''));
			if ($excludedPaths) {
				$this->_excludedpaths = array_map('trim', (array) explode("\n", $excludedPaths));
				foreach ($this->_excludedpaths as $path) {
					if (strstr(JURI::current(), $path)) {
						$this->_enabled = false;
						return;
					}
				}
			}
		}
		
        $jQueryVersion = $this->params->get('jqueryversion'.$suffix, '1.7');		
		$jQuerySubversion = $this->params->get('jquerysubversion'.$suffix, '');
		if ($jQuerySubversion) {
			$jQuerySubversion = '.'.$jQuerySubversion;
		}
        		
		$jQueryHTTP = $this->params->get('whichhttp'.$suffix,'https');
		
		$jQueryCompressed = '';
		if ($this->params->get('compression'.$suffix,'compressed') == 'compressed') {
			$jQueryCompressed = '.min';
		}
        
        if ($jQueryVersion == 'local') {
        	$localVersionPath = trim($this->params->get('localversion'.$suffix, ''));
        	if ($localVersionPath) {
        		$this->_jqpath = $localVersionPath."jquery".$jQueryCompressed.".js";
        	} else {
        		$this->_jqpath = "jquery".$jQueryCompressed.".js";
        	}
        } else {
        	$this->_jqpath = $jQueryHTTP."://ajax.googleapis.com/ajax/libs/jquery/".$jQueryVersion.$jQuerySubversion."/jquery".$jQueryCompressed.".js";
        }
		
		$doc->addScript("JQLIB");	
		
		$addjQueryNoConflict = $this->params->get('addnoconflict'.$suffix, 1);
		if ($addjQueryNoConflict == 1) {
        	$doc->addScriptDeclaration("JQNOCONFLICT");
		} else if ($addjQueryNoConflict == 2) {
			$doc->addScript("JQNOCONFLICT");
        	$this->_jqnoconflictpath = JURI::root(true)."/plugins/system/jqueryeasy/jquerynoconflict.js";
		}
		
		if ($this->_usejQueryUI) { // use jQuery UI
			$jQueryUIVersion = $this->params->get('jqueryuiversion'.$suffix, '1.8');	
			$jQueryUISubversion = $this->params->get('jqueryuisubversion'.$suffix, '');
			if ($jQueryUISubversion) {
				$jQueryUISubversion = '.'.$jQueryUISubversion;
			}
			$jQueryUITheme = $this->params->get('jqueryuitheme'.$suffix,'base');			
			
			if ($jQueryUIVersion == 'local') {
				$localVersionPath = trim($this->params->get('localversion'.$suffix, ''));
				if ($localVersionPath) {
					$this->_jquipath = $localVersionPath."jquery-ui".$jQueryCompressed.".js";
				} else {
					$this->_jquipath = "jquery-ui".$jQueryCompressed.".js";
				}
			} else {
				$this->_jquipath = $jQueryHTTP."://ajax.googleapis.com/ajax/libs/jqueryui/".$jQueryUIVersion.$jQueryUISubversion."/jquery-ui".$jQueryCompressed.".js";
			}			
			
			/*if ($jQueryUITheme != 'none') {
				$customCSS = trim($this->params->get('jqueryuithemecustom'.$suffix, ''));
				if ($jQueryUITheme == 'custom' && $customCSS) {
					$this->_jquicsspath = $customCSS;
				} else {
					if ($jQueryUITheme == 'custom') {
						$jQueryUITheme = 'base';
					}
					$this->_jquicsspath = $jQueryHTTP."://ajax.googleapis.com/ajax/libs/jqueryui/".$jQueryUIVersion."/themes/".$jQueryUITheme."/jquery-ui.css";
				}
				$doc->addStyleSheet("JQUICSS");
			}*/			
			
			if ($jQueryUITheme != 'none') {				
				if ($jQueryUITheme == 'custom') {
					$customCSS = trim($this->params->get('jqueryuithemecustom'.$suffix, ''));
					if ($customCSS) {
						$this->_jquicsspath = $customCSS."jquery-ui.css";
					} else {
						$this->_jquicsspath = $jQueryHTTP."://ajax.googleapis.com/ajax/libs/jqueryui/".$jQueryUIVersion.$jQueryUISubversion."/themes/base/jquery-ui.css";
					}
				} else {
					$this->_jquicsspath = $jQueryHTTP."://ajax.googleapis.com/ajax/libs/jqueryui/".$jQueryUIVersion.$jQueryUISubversion."/themes/".$jQueryUITheme."/jquery-ui.css";
				}
				$doc->addStyleSheet("JQUICSS");
			}
			
			$doc->addScript("JQUILIB");
		}
	
		$app->set('jQuery', true);		
	}
	
	function onBeforeRender() {

		if (!$this->_enabled || !$this->_usejQuery) {
			return;
		}
		
		$app = JFactory::getApplication();
		$doc = JFactory::getDocument();	
		
		//if (!method_exists($doc, 'getHeadData')) {
			//return;
		//}

		// at this point, jQuery and MooTools libraries are loaded in the wrong order
		// we have jQuery, MooTools and other libraries loaded in that order
		// take all 'media/system/js' libraries and put them in front of all others	
		
		$headerdata = $doc->getHeadData();
		$scripts = $headerdata['scripts'];
		$headerdata['scripts'] = array();
				
		$ignore_caption = $this->params->get('disablecaptions', 0);
		$needed_library_present = false;
		
		$js_needing_mootools = array("mooRainbow.js", "mootree.js");
		$js_to_ignore = array("mootools-core.js", "mootools-more.js"); // uncompressed versions are not taken into account because used for debug
		//if ($ignore_caption) {
			// add caption.js to the list of libraries to ignore
			//$js_to_ignore[] = "caption.js";
		//}
		
		foreach ($scripts as $url => $type) {
			if (preg_match("#media/system/js/#s", $url)) {	
				
				//$found = false;
				foreach ($js_needing_mootools as $library) {
					if (preg_match("#media/system/js/".$library."#s", $url)) {
						$needed_library_present = true;
					}
				}
				//if (!$found) {
					//$needed_library_present = true;
				//}
				
				$headerdata['scripts'][$url] = $type;
				unset($scripts[$url]);
				
				if ($ignore_caption && preg_match("#media/system/js/caption#s", $url)) {
					unset($headerdata['scripts'][$url]);
				} 
			}
		}		
		
		foreach ($scripts as $url => $type) {
			$headerdata['scripts'][$url] = $type;
		}
		
		// get rid of MooTools only if :
		// + on its own, with no other library using MooTools loaded from media/system/js
		// + in frontend
		// + view is not editing of articles
		// + not in specified pages
		
		if ($this->params->get('disablemootools', 0) && $app->isSite() && !$needed_library_present) {
			if (isset($_GET['view']) && $_GET['view'] != 'form') {
				foreach ($headerdata['scripts'] as $url => $type) {
					$ignore = false;
					foreach ($js_to_ignore as $library) {
						if (preg_match("#media/system/js/".$library."#s", $url)) {
							// found library to ignore
							$ignore = true;
						}
					}
				
					// DO NOT REMOVE if a page has been specifically listed as not to disable MooTools
					$exceptPaths = trim( (string) $this->params->get('keepmootoolsin', ''));
					if ($exceptPaths) {
						$this->_exceptpaths = array_map('trim', (array) explode("\n", $exceptPaths));
						foreach ($this->_exceptpaths as $path) {
							if (strstr(JURI::current(), $path)) {
								$ignore = false;
							}
						}
					}
				
					if ($ignore) {
						unset($headerdata['scripts'][$url]);
					}
				}
			}		
		}
		
		// also we have script declarations loaded alongside MooTools libraries
		// if getting rid of libraries, also need to get rid of script declarations associated to them
		
		if ($ignore_caption) {
			$headerdata['script'] = preg_replace('#([a-zA-Z0-9();,\'_:\.-\s]*)JCaption([a-zA-Z0-9();,\'_:\.-\s]*)#', '', $headerdata['script']);
			//$headerdata['script'] = preg_replace('#([a-zA-Z0-9();,\'_:\.-\s]*)function(){}#', '', $headerdata['script']);
		}	
		
		$doc->setHeadData($headerdata);	
	}
		
	function onAfterRender() {
		
		if (!$this->_enabled || !$this->_usejQuery) {
			return;
		}
		
		$app = JFactory::getApplication();
		
		$suffix = 'frontend';
		if ($app->isAdmin()) {
			$suffix = 'backend';
		}		
		
		$body = JResponse::getBody();
		
		$remainingScripts = trim( (string) $this->params->get('stripremainingscripts'.$suffix, ''));
		if ($remainingScripts) {
			$remainingScripts = array_map('trim', (array) explode("\n", $remainingScripts));
			foreach ($remainingScripts as $script) {
				$body = preg_replace('#<script[^>]*'.$script.'[^>]*></script>#', '', $body);
			}
		}
		
		$remainingStylesheets = trim( (string) $this->params->get('stripremainingcss'.$suffix, ''));
		if ($remainingStylesheets) {
			$remainingStylesheets = array_map('trim', (array) explode("\n", $remainingStylesheets));
			foreach ($remainingStylesheets as $stylesheet) {
				$body = preg_replace('#<link[^>]*'.$stylesheet.'[^>]*/>#', '', $body);
			}
		}		
		
		// remove all '... jQuery.noConflict();'
		$removejQueryNoConflict = $this->params->get('removenoconflict'.$suffix, 1);
		if ($removejQueryNoConflict) {
			$body = preg_replace('#[^>]*jQuery\.noConflict\(\);#', '', $body);
			$body = preg_replace('#([\\\/a-zA-Z0-9_:\.-]*)jquery[.-]noconflict\.js#', 'GARBAGE', $body); // find potential jquery-noconflict.js
		}
			
		// remove all other references to jQuery library
        $body = preg_replace('#([\\\/a-zA-Z0-9_:\.-]*)jquery([0-9\.-]|min|pack)*?.js#', 'GARBAGE', $body); // find jQuery versions
		        
        //$body = preg_replace('#<script[^>]*GARBAGE[^>]*></script>#', '', $body); // remove newly empty scripts
        
		// use jQuery version set in the plugin
		$body = preg_replace('#[^"]*?JQLIB#', $this->_jqpath, $body, 1);
				
		// replace deleted occurences
		$addjQueryNoConflict = $this->params->get('addnoconflict'.$suffix, 1);			
        if ($addjQueryNoConflict == 1) {
        	$body = preg_replace('#JQNOCONFLICT#', 'jQuery.noConflict();', $body, 1); // add unique jQuery.noConflict();
        } else if ($addjQueryNoConflict == 2) {
        	$body = preg_replace('#JQNOCONFLICT#', $this->_jqnoconflictpath, $body, 1); // add jquerynoconflict.js       	
        }        
		
		if ($this->_usejQueryUI) {
			// remove all other references to jQuery UI library
			$body = preg_replace('#([\\\/a-zA-Z0-9_:\.-]*)jquery-ui([0-9\.-]|custom|min|pack)*?.js#', 'GARBAGE', $body); // find jQuery UI versions			
			//$body = preg_replace('#<script[^>]*GARBAGE[^>]*></script>#', '', $body); // remove newly empty scripts
			
			// use jQuery UI version set in the plugin
			$body = preg_replace('#[^"]*?JQUILIB#', $this->_jquipath, $body, 1);
		
			// remove all other references to jQuery UI stylesheets
			$body = preg_replace('#([\\\/a-zA-Z0-9_:\.-]*)jquery-ui([0-9\.-]|custom|min|pack)*?.css#', 'GARBAGE', $body); // find jQuery UI CSS versions			
			$body = preg_replace('#<link[^>]*GARBAGE[^>]*/>#', '', $body); // remove newly empty stylesheets
			
			// use jQuery UI CSS set in the plugin
			if (!empty($this->_jquicsspath)) {
				$body = preg_replace('#[^"]*?JQUICSS#', $this->_jquicsspath, $body, 1);
			}
		}
		
		// placed here to avoid 2 identical lookups
		$body = preg_replace('#<script[^>]*GARBAGE[^>]*></script>#', '', $body); // remove newly empty scripts
		
		if ($this->params->get('removeblanklines'.$suffix, 1)) {
			$body = preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "\n", $body); // gets all of the empty lines in the source and replaces them with a simple carriage return to preserve the content structure.
		}
				
		JResponse::setBody($body);
		
		return true;
	}
}