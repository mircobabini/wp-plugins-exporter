<?php
/*
Plugin Name: Plugins Exporter
Plugin URI: http://github.com/mirkolofio/wp-plugins-exporter
Description: Easily (one-click) export any installed Wordpress plugin
Author: Mirco Babini
Version: 1.0.1
Author URI: http://github.com/mirkolofio
*/
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

$plugin_basename = @$_GET['pe-export'];
if (is_admin () && $plugin_basename !== null) {

	add_action ('after_setup_theme', function () use ($plugin_basename) {
		$dir = ABSPATH . 'wp-content/plugins/' . $plugin_basename;

		$pos = strrpos ($plugin_basename, '/');
		$plugin_name = ($pos === false) ? $plugin_basename : str_rkeep ('/', $plugin_basename);
		$plugin_name = substr ($plugin_name, 0, -4);
		
		
		header ("Content-Type: archive/zip");
		header ("Content-Disposition: attachment; filename={$plugin_name}.zip");
		$tmp_zip = tempnam ("tmp", "tempname") . ".zip";

		chdir ($dir);
		exec ("zip -r {$tmp_zip} *");

		$filesize = filesize ($tmp_zip);
		header ("Content-Length: $filesize");

		$fp = fopen ($tmp_zip, 'r');
		echo fpassthru ($fp);

		unlink ($tmp_zip);

		exit;
	});
}

if (is_admin ()) {
	
	if (true || isset ($_GET['ghosts'])) {
		
		$plugins = get_plugins ();
		foreach (array_keys ($plugins) as $plugin_basename) {
			
			add_filter ("plugin_action_links_{$plugin_basename}", function ($action_links) use ($plugin_basename) {
				$export_link = "<a href=\"?pe-export={$plugin_basename}\">" . __( 'Export') . "</a>";
				array_push ($action_links, $export_link);
				return $action_links;
			});
		}
	} else {
		
		add_filter ('all_plugins', function ($plugins) {
			unset ($plugins[plugin_basename (__FILE__)]);
			return $plugins;
		});
	}
}

function str_rkeep ($needle, $haystack, $howManyTimes = 1) {
	while ($howManyTimes--) {
		if (($pos = strrpos ($haystack, $needle)) === false) {
			return false;
		}
		
		$haystack = substr ($haystack, $pos + 1);
	}
	
	return $haystack; 
}