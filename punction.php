<?php
/*
 * Plugin Name: Punction
 * Version: 1.0-alpha
 * Description: Patients Unit Nurse Categorisation Tool
 * Author: Andrzej Marcinkowski
 * Author URI:
 * Plugin URI:
 * Text Domain: punction
 * Domain Path: /languages
 */
// PRIO 2:
// TODO dodac cache: https://github.com/asm89/twig-cache-extension
use Punction\WP\Actions;
use Hospitalplugin\WP\ScriptsAndStyles;
use Hospitalplugin\WP\Menu;
use Symfony\Component\Yaml\Yaml;
require_once WP_CONTENT_DIR . "/../vendor/autoload.php";

$cfg = Yaml::parse(file_get_contents(__DIR__ . '/punction.yml'));

$menuPnct = new Menu();
$hsac = new ScriptsAndStyles();
$psac = new ScriptsAndStyles();

Actions::init();
$menuPnct->init($cfg['menus'], $cfg['url'], $cfg['menu-remove']);
$hsac->init(HOSPITAL_PLUGIN_URL, $cfg['pages'], $cfg['scripts'], $cfg['styles']);
$psac->init(WP_PLUGIN_URL . '/punction', $cfg['pages'], $cfg['plugin-scripts'], $cfg['plugin-styles']);
?>

