<?php
		if($short):
	function startPost() {
	function postBlock($postID) {
		$spamCount = 0;
	function esEmail($email = ""){
	function getInfoPadres($id, $padres = array()){
			array_push($padres, $row);
		return $padres;
	function getIdHijos($id=0, $hijos = array()){
		if($result and $num_items):
		if($result and $num_items):
	function getIdUser($nameUser){
		if($result and $num_items):
		return $info['id_usuario'];
	function getTags($id){
		if($result and mysql_num_rows($result)):
	function getIdTag($tag){
	function printTags($tags){
		$pageURL .= "://";
		if ($_SERVER["SERVER_PORT"] != "80") {
	function getMenu_($id = 0, $submenus = true, $maxNivel = "-1", $menu = array(), $crumbs = array(), $profundidad = "1"){
				if(is_array($crumbs)):
				$thisMenu = array(
				$maxNivel--;
				if($row['num_hijos'] and $submenus and $maxNivel != 0):
	function printMenu($menu, $wrapper="li", $wrapperSubNivel="ul", $separador=""){
	function printMenuPrefix($menu, $prefix, $actual="", $wrapper="li", $wrapperSubNivel="ul", $separador=""){
					<?php
		if($result and mysql_num_rows($result)):
	function printFeaturedImages($imagenes, $opciones){
	function printGaleriaConThumbs($imagenes, $opciones){
		if(@is_array($imagenes) and count($imagenes) > 0):
				<div class="portrait">
	function getMetaInfo($slug){
	function get_post_custom($id){
		if($result and mysql_num_rows($result)):
	function getMultimedia($id, $tipo, $limite=""){
		if($result and $numItems):
	}

	function getFeaturesImage($id, $tipo, $limite=""){
	}
	function getBannerImage($limite=""){
	}

	function getNextProject($thisId, $orden, $fechaPublicacion){
		if($result and mysql_num_rows($result)):
	function add_post_views($id){
	function update_post_views($id){
		if($result and mysql_affected_rows()):