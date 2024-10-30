=== Conslider ===
Contributors: flomincucci
Donate link: http://florenciamincucci.com.ar
Tags: slider, javascript, youtube
Requires at least: 2.0.2
Tested up to: 3.1
Stable tag: `/trunk/`

Simple Javascript slider. You can use Youtube videos or images, given the Youtube video ID or image permalink. 

== Description ==

This plugin provides a simple Javascript slider, that gets the data from the post meta. It uses thumbnails for navigation, and accepts images and youtube videos.
You must provide de image URI in case of images or the Youtube video ID - in case of Youtube videos.

== Installation ==

1. Upload `plugin-name.php` to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Place `<?php generate_slider($post->ID) ?>` in your templates

== Frequently Asked Questions ==

= Where do I get the Youtube Video ID? =

You get the ID from the address, is that sequence of letter/numbers/etc that comes after de "v=". For example, in http://www.youtube.com/watch?v=4R-7ZO4I1pI , the Youtube video ID is 4R-7ZO4I1pI

= How do I name the meta fields with the data? =

If it's an image, the key of the field must be 'Imagen'. If it's a Youtube video, the key must be 'YoutubeID'.

== Screenshots ==

1. No screenshots

== Changelog ==

= 0.5 =
* First version. There's not much to say, though.

== Upgrade Notice ==

= 0.5 =
Uhm, there's no upgrades.

