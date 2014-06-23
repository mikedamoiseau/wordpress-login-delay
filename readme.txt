=== Plugin Name ===
Contributors: michael.damoiseau
Donate link: http://damoiseau.me/
Tags: brute-force attack,security,login
Requires at least: 3.5.1
Tested up to: 3.8
Version: 1.1
Stable tag: 1.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

WP Login Delay is a plugin that adds a one second delay when logging into the system in order to slow down any brute-force attack on your website.

== Description ==

Wordpress is one of the most used CMS on the internet, and because of this, one of the most targeted systems by bots and hackers.

A brute-force attack consists of systematically checking all possible keys or passwords until the correct one is found. WP Login Delay is a small plugin that offers a simple help against this.
For each login attempt on the system, the plugin will add a delay of one second. Although the users will not feel any difference when logging into the system, this can help again a bot that is sending thousands of requests and waits for their results.

*This plugin will not make your system highly secure, there are other security plugins that do the job better than WP Login Delay.* But installing this plugin will add one more defense to your website, and this defense should not conflict with any other defense already installed.

== Installation ==

1. Upload the `wp-login-delay` folder to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. That's it, WP Login Delay is installed and working

== Frequently Asked Questions ==

= Is this really working? =

Just think about it... If you want to pass through a huge door and you have to try thousands of different keys to find the correct one. You will test all of them until the correct one works, right? This means that for each attempt, you will have to wait for the result to know if it is the correct key or not. Each result being delayed, it will take a lot more time to find out which key is the correct one. It is the same principle that is used here, one second delay is ok for a human, but looks like eternity for a bot.


== Changelog ==

= 1.1 =
* Updated the readme file for Wordpress 3.8
* Renamed a function of the plugin to avoid conflict with WooCommerce plugin
* Added a setting under "Settings > WP Login Delay" to set the delay time in seconds (the default value is one second)

= 1.0 =
* First version of the plugin

