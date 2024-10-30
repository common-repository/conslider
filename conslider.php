<?php
/*
Plugin Name: Conslider
Plugin URI: http://florenciamincucci.com.ar
Description: Javascript Content Slider for Wordpress
Version: 1.0
Author: flomincucci
Author URI: http://florenciamincucci.com.ar
License: GPL2

Copyright 2010  flomincucci  (email : florencia@mincucci.com.ar)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

function generate_slider($post_id) {
	/* Getting data */
	$data_pics = get_post_meta( $post_id,'Imagen',false );
	$data_video = get_post_meta( $post_id, 'YoutubeID', false );
	/* Mixing it up */
	$data = array();
	foreach( $data_pics as $pic ) {
		$data[] = array( 'class' =>'pic' , 'content' => $pic) ;
	}
	foreach( $data_video as $video) {
		$data[] = array( 'class' => 'video' , 'content' => $video );
	}
	shuffle( $data );
	/* Generating HTML Code for Slider Content */
	$html = '<div id="conslider"><ul>';
	foreach($data as $slider) {
		$html.= '<li>';
		if( $slider['class'] == 'pic' ) $html.= '<img src="'.$slider['content'].'" width="522" height="310" alt="" />'; /* Image */
		elseif ( $slider['class'] == 'video' ) $html.= getVideo( $slider['content'] ); /* Video */
		$html.='</li>';
	}
	$html.= '</ul></div></div>';
	/* Generating HTML Code for Thumbnails */
	$html.='<div id="conslider-navigation"><ul id="conslider-pagination" class="conslider-pagination">';
	$j = 0;
	foreach($data as $slider) {
		$html.= '<li onclick="conslideshow.pos('.$j.')">';
		$html.= ($slider['class'] == 'video')? getVideoThumbSmall($slider['content']) : getImageThumbnail($slider['content'],$j);
		$html.= '</li>';
		$j++;
	}
	$html .= '</ul>';
	$html.= '<script type="text/javascript">var conslideshow=new TINY.slider.slide("conslideshow",{id:"conslider",vertical:false,navid:"conslider-pagination",activeclass:"current",position:0});</script>';
	echo $html;
	
}

function getImageThumbnail($original_image, $index) {
	/*$images = get_children('post_type=attachment&post_mime_type=image&numberposts=3&post_parent='. $post->ID);
	foreach ( $images as $attachment_id => $attachment ) {
		echo wp_get_attachment_image( $attachment_id, 'large' );
	}*/
	return '<img id="imagen'.$index.'" onload="resize(\'imagen'.$index.'\')" src="'.$original_image.'" class="thumb" />';
}

function getVideo($id){
	$video='
		<object width="522" height="292">
		<param name="movie" value="http://www.youtube.com/v/'.$id.'&hl=en_US&fs=1&rel=0"></param>
		<param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param>
		<embed src="http://www.youtube.com/v/'.$id.'&hl=en_US&fs=1&rel=0" 
		wmode="opaque" type="application/x-shockwave-flash" 
		allowscriptaccess="always" 
		allowfullscreen="true"  
		width="522" 
		height="292"></embed></object>
	';
	return $video;
}
function getVideoThumb($id){
	$video='<img class="thumb" src="http://i2.ytimg.com/vi/'.$id.'/0.jpg" width="200" />';	
	return $video;
}
function getVideoThumbSmall($id){
	$video='<img class="thumb" src="http://i2.ytimg.com/vi/'.$id.'/0.jpg" width="150" />';	
	return $video;
}

function getmyurl( $str="" ) {
	$path = WP_PLUGIN_URL . "/" . plugin_basename( dirname( __FILE__ ) );

	if ( isset( $str ) && !empty( $str ) ) {
		  $sep = "/" == substr( $str, 0, 1 ) ? "" : "/";
		  return $path . $sep . $str;
	} else {
		  return $path;
	}
}

function conslider_scripts() {
 		wp_register_script( 'script-js', getmyurl( '/js/script.js' ) );
    wp_enqueue_script( 'script-js' );
}

function conslider_styles() {
	echo '<link rel="stylesheet" href="'.getmyurl('/style.css').'" type="text/css" media="all" />';
}

if ( function_exists( 'add_action' ) ) {
	/* Scripts and styles */
	add_action( 'wp_print_scripts', 'conslider_scripts' );
	add_action( 'wp_print_styles', 'conslider_styles' );
}

?>