<?php
	function subirArchivo($nom_campo, $carpeta, $prefijo = "", $posicion=0){
		$band = false;
		$nombre_archivo = utf8_decode($_FILES[$nom_campo]['name'][$posicion]);
		$tipo_archivo = $_FILES[$nom_campo]['type'][$posicion];
		$ruta_original = $carpeta.$prefijo.$nombre_archivo;
		$mimes = array('audio/mpeg','application/x-shockwave-flash','image/gif','image/jpeg','image/jpg','image/pjpeg','image/png','image/x-png','application/mspowerpoint','application/msword','application/pdf');

		if(in_array($tipo_archivo,$mimes)):
			if(move_uploaded_file($_FILES[$nom_campo]['tmp_name'][$posicion],$ruta_original)):
				chmod($ruta_original, 0666);
				$band = true;
			endif;
		endif;

		return $band;
	}

	//http://github.com/maxim/smart_resize_image/blob/3c122a8837015f4587219e05019005b13e0f032a/README.rdoc
	function smart_resize_image($file, $width = 0, $height = 0, $proportional = false, $output = 'file', $delete_original = true, $use_linux_commands = false ){
		if($height<=0 && $width<=0):
			return false;
		endif;

		# Setting defaults and meta
		$info = getimagesize($file);
		$image = '';
		$final_width = 0;
		$final_height = 0;
		list($width_old, $height_old) = $info;

	    # Calculating proportionality
    	if($proportional):
			if($width==0):
				$factor = $height/$height_old;
			elseif($height == 0):
				$factor = $width/$width_old;
			else:
				$factor = min( $width / $width_old, $height / $height_old );
			endif;

			$final_width = round( $width_old * $factor );
			$final_height = round( $height_old * $factor );
		else:
			$final_width = ( $width <= 0 ) ? $width_old : $width;
			$final_height = ( $height <= 0 ) ? $height_old : $height;
		endif;

		# Loading image to memory according to type
		switch($info[2]):
			case IMAGETYPE_GIF: $image = imagecreatefromgif($file); break;
			case IMAGETYPE_JPEG: $image = imagecreatefromjpeg($file); break;
			case IMAGETYPE_PNG: $image = imagecreatefrompng($file); break;
			default: return false;
		endswitch;

		# This is the resizing/resampling/transparency-preserving magic
		$image_resized = imagecreatetruecolor( $final_width, $final_height );
		if(($info[2]==IMAGETYPE_GIF) || ($info[2]==IMAGETYPE_PNG)):
			$transparency = imagecolortransparent($image);

			if($transparency>=0):
				$transparent_color = imagecolorsforindex($image, $trnprt_indx);
				$transparency = imagecolorallocate($image_resized, $trnprt_color['red'], $trnprt_color['green'], $trnprt_color['blue']);
				imagefill($image_resized, 0, 0, $transparency);

				imagecolortransparent($image_resized, $transparency);
			elseif($info[2]==IMAGETYPE_PNG):
				imagealphablending($image_resized, false);
				$color = imagecolorallocatealpha($image_resized, 0, 0, 0, 127);
				imagefill($image_resized, 0, 0, $color);
				imagesavealpha($image_resized, true);
			endif;
		endif;
		imagecopyresampled($image_resized, $image, 0, 0, 0, 0, $final_width, $final_height, $width_old, $height_old);

		# Taking care of original, if needed
		if($delete_original):

			if($use_linux_commands):
				exec('rm '.$file);
			else:
				@unlink($file);
			endif;
		endif;

		# Preparing a method of providing result
		switch(strtolower($output)):
			case 'browser':
				$mime = image_type_to_mime_type($info[2]);
				header("Content-type: $mime");
				$output = NULL;
			break;
			case 'file':
				$output = $file;
			break;
			case 'return':
				return $image_resized;
			break;
			default: break;
		endswitch;

		# Writing image according to type to the output destination
		switch($info[2]):
			case IMAGETYPE_GIF: imagegif($image_resized, $output, 100); break;
			case IMAGETYPE_JPEG: imagejpeg($image_resized, $output, 100); break;
			case IMAGETYPE_PNG: imagepng($image_resized, $output, 9); break;
			default: return false;
		endswitch;

		return true;
	}

	function cropImagen($origen, $destino = NULL, $modo = "pc", $ancho = 100, $alto = 100, $izq = 60, $alt = 70, $compresion = 100){
		// Receiving image.
		$image = $origen;
		// Creating temp image as a source image (original image).
		$info = getimagesize($image);
		switch ( $info[2] ):
			case IMAGETYPE_GIF: $src = imagecreatefromgif($image); break;
			case IMAGETYPE_JPEG: $src = imagecreatefromjpeg($image); break;
			case IMAGETYPE_PNG: $src = imagecreatefrompng($image); break;
			default: return false;
		endswitch;

		if($modo == "px"):
			$centroX = ceil(imagesx($src)/2);
			$centroY = ceil(imagesy($src)/2);
			$nx = ($centroX-(ceil($ancho/2)));
			$ny = ($centroY-(ceil($alto/2)));
		endif;

		if($modo == "pc"):
			$nx = imagesx($src) * (1 -($izq / 100));
			$ny = imagesy($src) * (1 -($alt / 100));
		endif;

		// Create new image with a new width and height.
		$dest = imagecreatetruecolor($ancho, $alto);

		// Copy new image to memory after cropping.
		imagecopy($dest, $src, 0, 0, $nx, $ny, $ancho, $alto);

		// Creating new image cropped image as JPG and save it to $dest
		switch ( $info[2] ) {
			case IMAGETYPE_GIF: imagegif($dest,$destino,$compresion); break;
			case IMAGETYPE_JPEG: imagejpeg($dest,$destino,$compresion); break;
			case IMAGETYPE_PNG: imagepng($dest,$destino,9); break;
			default: return false;
		}
		//imagejpeg($dest,$destino,$compresion);

		// Freeing up memory.
		imagedestroy($dest);
		imagedestroy($src);
	}

	function getDiayFecha($fecha){
		$mes = array("","Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep","Oct","Nov","Dic");
		$dia = array("Dom","Lun","Mar","Mie","Jue","Vie","Sab");

		$fecha_bd = split('-',$fecha);
		$fechats = strtotime($fecha);

		return $dia[date('w', $fechats)].' '.$fecha_bd[2].'/'.$mes[$fecha_bd[1]].'/'.$fecha_bd[0];
	}

	function random_color(){
		mt_srand((double)microtime()*1000000);
		$color = '';

		while(strlen($color)<6):
			$color .= sprintf("%02X", mt_rand(0, 255));
		endwhile;

		return '#'.$color;
	}

	function cortaTexto($string, $limit, $break=".", $pad="...") {
		// return with no change if string is shorter than $limit
		if(strlen($string)>$limit):
			// is $break present between $limit and the end of the string
			if(false!==($breakpoint = strpos($string, $break, $limit))):
				if($breakpoint < strlen($string)-1):
					$string = substr($string, 0, $breakpoint) . $pad;

				endif;
			endif;
		endif;

		return $string;
	}


	function quitarAcentos($text, $separador = '-'){
		$text = htmlentities($text, ENT_QUOTES, 'UTF-8');
		$text = strtolower($text);
		$patron = array (
			// Espacios, puntos y comas por guion
			'/[\., ]+/' => $separador,

			// Vocales
			'/&agrave;/' => 'a', '/&egrave;/' => 'e', '/&igrave;/' => 'i', '/&ograve;/' => 'o', '/&ugrave;/' => 'u',
			'/&aacute;/' => 'a', '/&eacute;/' => 'e', '/&iacute;/' => 'i', '/&oacute;/' => 'o', '/&uacute;/' => 'u',
			'/&acirc;/' => 'a', '/&ecirc;/' => 'e', '/&icirc;/' => 'i', '/&ocirc;/' => 'o', '/&ucirc;/' => 'u',
			'/&atilde;/' => 'a', '/&etilde;/' => 'e', '/&itilde;/' => 'i', '/&otilde;/' => 'o', '/&utilde;/' => 'u',
			'/&auml;/' => 'a', '/&euml;/' => 'e', '/&iuml;/' => 'i', '/&ouml;/' => 'o',	'/&uuml;/' => 'u',
			'/&auml;/' => 'a', '/&euml;/' => 'e', '/&iuml;/' => 'i', '/&ouml;/' => 'o', '/&uuml;/' => 'u',

			// Otras letras y caracteres especiales
			'/&aring;/' => 'a', '/&ntilde;/' => 'n', '/&acute;/' => '', '/&prime;/' => '', '/&quot;/' => '',

			// Agregar aqui mas caracteres si es necesario
			'/&iexcl;/' => '', '/&iquest;/' => '', '/\//' => '', '/\?/' => '', '/\&amp;/' => '', "/:/" => '', "/\"/" => '', "/&ldquo;/" => '', "/&rdquo;/" => ''
		);

		$text = preg_replace(array_keys($patron),array_values($patron),$text);

		return $text;
	}

	function startPost() {
		echo '<input type="hidden" name="postID" value="'.md5(uniqid(rand(), true)).'">';
	}

	function postBlock($postID) {
		if(isset($_SESSION['postID']) and $postID == $_SESSION['postID']):
			return false;
		else:
			$_SESSION['postID'] = $postID;
			return true;
		endif;
	}

	function GeneraPassword($longitud){
		/* Se valida la longitud proporcionada. Debe ser número y mayor de cero.
		Si es menor o igual a cero le asignamos la longitud por defecto.
		Si es mayor de 32 le asignamos 32.*/
	    if(!is_numeric($longitud) || $longitud <=0):
			$longitud = 8;
		elseif($longitud > 32):
			$longitud = 32;
		endif;

		/* Asignamos el juego de caracteres al array $caracteres para generar la contraseña.
		Podemos añadir más caracteres para hacer más segura la contraseña.*/
    	$caracteres = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789+-/*%&_';

		/* Introduce la semilla del generador de números aleatorios mejorado */
		mt_srand(microtime() * 1000000);

		/* Genera un valor aleatorio mejorado con mt_rand, entre 0 y el tamaño del array
		$caracteres menos 1. Posteríormente vamos concatenando en la cadena $password
		los caracteres que se van eligiendo aleatoriamente.*/
		for($i = 0; $i < $longitud; $i++):
		    $key = mt_rand(0,strlen($caracteres)-1);
		    $password = $password . $caracteres{$key};
    	endfor;

	    return $password;
    }

	function printMenu($categorias, $infoUser){
		foreach($categorias as $categoria):
			$basename = basename($_SERVER['PHP_SELF']);
			if(($categoria['permisos'] >= $infoUser['rol']) or ($categoria['permisos'] == "")):?>
				<div class="categoria">
					<?php
						if(count($categoria['paginas'])>1):
							$paginas = array();

							foreach($categoria['paginas'] as $elemento):
								$elemento['linkEdit'] = (isset($elemento['linkEdit'])) ? $elemento['linkEdit'] : "";
								$paginas[] = $elemento['link'];
								$paginas[] = $elemento['linkEdit'];
								$class = ($basename==$elemento['link'] or $basename==$elemento['linkEdit'])?"actual":"";
								$item = '<li><a href="'.$elemento['link'].'" class="'.$class.'">'.$elemento['titulo'].'</a></li>';
							endforeach;?>

							<span id="<?php echo $categoria['id']?>" class="tit_cat <?php if(in_array($basename, $paginas)):?>actual<?php endif?>"><?php echo $categoria['nombre']?></span>

							<ul class="menu">
								<?php
									foreach($categoria['paginas'] as $elemento):
										$elemento['permisos'] = (isset($elemento['permisos'])) ? $elemento['permisos'] : "";
										if(($elemento['permisos'] > $infoUser['rol']) or ($elemento['permisos'] == "")):?>
											<li><a href="<?php echo $elemento['link']?>" class="<?php if(in_array($basename,array($elemento['link'], $elemento['linkEdit']))) echo 'actual';?>"><?php echo $elemento['titulo']?></a></li>
								<?php
										endif;
									endforeach;?>
							</ul>
					<?php
						else:?>
							<span id="<?php echo $categoria['id']?>" class="tit_cat <?php if($basename==$categoria['paginas'][0]['link']):?>actual<?php endif?>"><a href="<?php echo $categoria['paginas'][0]['link']?>"><?php echo $categoria['nombre']?></a></span>
					<?php
						endif;?>
				</div><!--.categoria-->
	<?php
			endif;
		endforeach;
	}

	function getCats($padre, $tipo, $optiongroup=array(), $id_padre=0, $num_tabs = 0, $tab = "&nbsp;&nbsp;&nbsp;&nbsp;"){
		$query = "SELECT cc.idCat id, cc.titulo_esp titulo, tipo, (SELECT count(cc2.idCat) FROM ctlg_categorias cc2 WHERE cc2.idCatPadre = cc.idCat LIMIT 0,1) num_hijos FROM ctlg_categorias cc WHERE idCatPadre='$id_padre' AND tipo IN ($tipo) ORDER BY orden, titulo";
		$result = mysql_query($query);

		if($result and mysql_num_rows($result)):
			while($row = mysql_fetch_array($result)):
				if(!@in_array($row['tipo'], $optiongroup)):?>
					<option value="<?php echo $row['id']?>" <?php if($padre==$row['id']) echo 'selected="selected"'?>><?php for($i=0;$i<$num_tabs;$i++) echo $tab;?><?php echo $row['titulo']?></option>
			<?php
				else:?>
					<optgroup label="<?php echo $row['titulo']?>">&nbsp;</optgroup>
			<?php
				endif;

				($row['num_hijos'])?getCats($padre, $tipo, $optiongroup, $row['id'], $num_tabs+1):NULL;

			endwhile;
		else:
			return NULL;
		endif;
	}

	function getCatsTipo($padre, $tipo="", $id_padre=0, $num_tabs = 0, $tab = "&nbsp;&nbsp;&nbsp;&nbsp;"){
		$query_padres = "SELECT cc.idCat id, cc.titulo_esp titulo, (SELECT count(cc2.idCat) FROM ctlg_categorias cc2 WHERE cc2.idCatPadre = cc.idCat LIMIT 0,1) num_hijos FROM ctlg_categorias cc WHERE tipo in ($tipo) ORDER BY orden, titulo";
		$result_padres = mysql_query($query_padres);

		if($result_padres and mysql_num_rows($result_padres)):
			while($row = mysql_fetch_array($result_padres)):?>
				<option value="<?php echo $row['id']?>" <?php if($padre==$row['id']) echo 'selected="selected"'?>><?php for($i=0;$i<$num_tabs;$i++) echo $tab;?><?php echo $row['titulo']?></option>
		<?php
			endwhile;
		else:
			return NULL;
		endif;
	}

	function is_empty($value) {
	    return !empty($value);
	}

	function escribeBitacora($idUsuario, $operacion){
		$query = "INSERT INTO ctlg_bitacora(idUsuario, operacion, fecha) VALUES('$idUsuario', '$operacion', NOW())";
		mysql_query($query);
	}

	function getCatsId($id){
		$cats = array();

		$query = "SELECT idCat id FROM ctlg_cats_entradas WHERE idEntrada='$id'";
		$result = mysql_query($query);

		if($result):
			while($row = mysql_fetch_array($result)):
				$cats[] = $row;
			endwhile;
		endif;

		return $cats;
	}

	function getCatsCheck($padres, $tipo, $optiongroup=array(), $id_padre=0, $num_tabs = 0, $tab = "&nbsp;"){
		$query = "SELECT cc.idCat id, cc.titulo_esp, (SELECT count(cc2.idCat) FROM ctlg_categorias cc2 WHERE cc2.idCatPadre = cc.idCat LIMIT 0,1) num_hijos FROM ctlg_categorias cc WHERE idCatPadre='$id_padre' AND tipo IN ($tipo) ORDER BY orden, titulo";
		$result = mysql_query($query);

		if($result and mysql_num_rows($result)):
			while($row = mysql_fetch_array($result)):
				$selected = "";
				$checked = "";

				if(is_array($padres) and count($padres)):
					foreach($padres as $padre):
						if($padre['id'] == $row['id']):
							$checked = 'checked';
						endif;
					endforeach;
				elseif($row['id'] == 1):
					$checked = 'checked';
				endif;?>

				<p>
				<?php
					for($i=0; $i<$num_tabs; $i++):
						echo $tab;
					endfor;?>
				<label><input type="checkbox" name="idCat[]" value="<?php echo $row['id']?>" <?php echo $checked?>> <?php echo $row['titulo']?></label></p>
			<?php
				($row['num_hijos'])?getCatsCheck($padres, $tipo, $optiongroup, $row['id'], $num_tabs+1):NULL;
			endwhile;
		else:
			return NULL;
		endif;
	}

	function guardaCats($nid, $padres){
		if(is_array($padres)):
			foreach($padres as $padre):
				if(!empty($padre)){
					$query = "INSERT INTO ctlg_cats_entradas(idCat, idEntrada) VALUES('$padre', '$nid')";
					$result = mysql_query($query);
				}
			endforeach;
		endif;
	}

	function borraCats($nid){
		$query = "DELETE FROM ctlg_cats_entradas WHERE idEntrada='$nid'";
		$result = mysql_query($query);
	}

	function guardaTags($nid){
		if((array_key_exists('tag', $_POST) || array_key_exists('formdata', $_POST))):

			$result = array('new' => array(), 'deleted' => array(), 'changed' => array(), 'not changed' => array());
			$tags = array_key_exists('tag', $_POST)? $_POST['tag'] : $_POST['formdata']['tags'];

			foreach($tags as $key => $value):
				if(preg_match('/([0-9]*)-?(a|d)?$/', $key, $keyparts) === 1):
					if(isset($keyparts[2])):
						switch($keyparts[2]) {
							case 'a':
								$query = "INSERT INTO ctlg_cats_entradas(idCat, idEntrada) VALUES('{$keyparts[1]}', '$nid')";
								$result = mysql_query($query);
							case 'd':
								break;
						}
					else:
						$query = "INSERT INTO ctlg_categorias(titulo_esp, slug, tipo) VALUES('$value', '".quitarAcentos($value)."', 'tag')";
						$result = mysql_query($query);
						$nidTag = mysql_insert_id();

						$query = "INSERT INTO ctlg_cats_entradas(idCat, idEntrada) VALUES('$nidTag', '$nid')";
						$result = mysql_query($query);
					endif;
				endif;
			endforeach;
		endif;
	}

	function updateCatsTags($nid, $padres){
		borraCats($nid);
		guardaTags2($nid);
		guardaCats($nid, $padres);
	}

	/* Proceso de imagenes */
	function subirImagen($nom_campo, $carpeta, $prefijo = "", $posicion=0){
		$band = false;
		$nombre_archivo = utf8_decode($_FILES[$nom_campo]['name'][$posicion]);
		$tipo_archivo = $_FILES[$nom_campo]['type'][$posicion];
		$ruta_original = $carpeta.$prefijo.$nombre_archivo;
		$mimes = array('image/gif', 'image/jpeg', 'image/jpg', 'image/pjpeg', 'image/png', 'image/x-png');

		if(in_array($tipo_archivo,$mimes)):
			if(move_uploaded_file($_FILES[$nom_campo]['tmp_name'][$posicion], $ruta_original)):
				chmod($ruta_original, 0666);
				$band = true;
			endif;
		endif;

		return $band;
	}

	function guardaImagenes($setupUpload){

		$nid = $setupUpload["nid"];
		$tipoRegistro = $setupUpload["tipoRegistro"];
		$nameInput = $setupUpload["nameInput"];
		$numArchivos = count($_FILES[$nameInput]['name']);
		$carpetaUpload = $setupUpload["carpetaUpload"];
		$carpetas = $setupUpload["carpetas"];
		$mimes = array('image/gif', 'image/jpeg', 'image/jpg', 'image/pjpeg', 'image/png', 'image/x-png');

		if($numArchivos):
			for($i=0; $i<$numArchivos; $i++):
				$file = $_FILES[$nameInput]['name'][$i];
				$tipo_archivo = $_FILES[$nameInput]['type'][$i];

				if($file!='' and in_array($tipo_archivo, $mimes)):
					$opciones = serialize($_POST[$nameInput]['opciones']);

					$pie_esp = $_POST[$nameInput]['pie_esp'][$i];
					$pie_eng = $_POST[$nameInput]['pie_eng'][$i];
					$url = $_POST[$nameInput]['url'][$i];
					$contenido = $_POST[$nameInput]['contenido'][$i];
					$orden = $_POST[$nameInput]['orden'][$i];
					$titulo = $_POST[$nameInput]['titulo'][$i];

					$query_add_file = "INSERT INTO ctlg_imagenes(nomArchivo, tipo, idEntrada, estatus, pie_esp, pie_eng, url, opciones, contenido, orden, titulo) VALUES('{$file}', '{$tipoRegistro}', '{$nid}', '1', '{$pie_esp}', '{$pie_eng}', '{$url}', '{$opciones}', '{$contenido}', '{$orden}', '{$titulo}')";
					$result_add_file = mysql_query($query_add_file);
					$nid_file = mysql_insert_id();

					if($result_add_file):
						$pre = $nid_file."_image_";

						if(subirImagen($nameInput, $carpetaUpload, $pre, $i)):
							foreach($carpetas as $carpeta):
								smart_resize_image($carpeta["carpetaOrigen"].$pre.$file, $carpeta['ancho'], $carpeta['alto'], true, $carpeta["carpetaDestino"].$pre.$file, false, false);
							endforeach;
						else:
							$query = "DELETE FROM ctlg_imagenes WHERE id='{$nid_file}'";
							$reuslt = mysql_query($query);
							$mensaje .= "<p>La imagen $file no pudo guardarse en el servidor</p>";
							$clase = "alerta";
						endif;
					else:
						$mensaje .= "<p>La imagen $file no pudo guardarse en el servidor</p>";
						$clase = "alerta";
					endif;
				else:
					$mensaje .= "<p>El archivo $file no pudo guardarse en el servidor</p>";
					$clase = "alerta";
				endif;
			endfor;
		endif;

		return array("mensaje" => $mensaje, "clase" => $clase);
	}

	function guardaArchivos($setupUpload){
		$nid = $setupUpload["nid"];
		$tipoRegistro = $setupUpload["tipoRegistro"];
		$nameInput = $setupUpload["nameInput"];
		$numArchivos = count($_FILES[$nameInput]['name']);
		$carpetaUpload = $setupUpload["carpetaUpload"];

		if($numArchivos):
			for($i=0; $i<$numArchivos; $i++):
				$file = $_FILES[$nameInput]['name'][$i];
				$opciones = serialize($_POST[$nameInput]['opciones']);

				$pie_esp = $_POST[$nameInput]['pie_esp'][$i];
				$pie_eng = $_POST[$nameInput]['pie_eng'][$i];
				$url = $_POST[$nameInput]['url'][$i];
				$contenido = $_POST[$nameInput]['contenido'][$i];
				$orden = $_POST[$nameInput]['orden'][$i];
				$titulo = $_POST[$nameInput]['titulo'][$i];

				if($file!=''):
					$query_add_file = "INSERT INTO ctlg_imagenes(nomArchivo, tipo, idEntrada, estatus, pie_esp, pie_eng, url, opciones, contenido, orden, titulo) VALUES('{$file}', '{$tipoRegistro}', '{$nid}', '1', '{$pie_esp}', '{$pie_eng}', '{$url}', '{$opciones}', '{$contenido}', '{$orden}', '{$titulo}')";
					$result_add_file = mysql_query($query_add_file);
					$nid_file = mysql_insert_id();

					if($result_add_file):
						$pre = $nid_file."_";

						if(subirArchivo($nameInput, $carpetaUpload, $pre, $i)):
							$mensaje .= "<p>El archivo $file se guardo en el servidor</p>";
							$clase = "exito";
						else:
							$mensaje .= "<p>El archivo $file no pudo guardarse en el servidor</p>";
							$clase = "alerta";
						endif;
					else:
						$mensaje .= "<p>El archivo $file no pudo guardarse en el servidor</p>";
						$clase = "alerta";
					endif;
				endif;
			endfor;
		endif;

		return array("mensaje" => $mensaje, "clase" => $clase);
	}

	function actualizaImagenes($nameInput){
		$numArchivos = count($_POST[$nameInput]['edit']);
		if($numArchivos):
			foreach($_POST[$nameInput]['edit'] as $key=>$value):

				$opciones = serialize($value['opciones']);
				$pie_esp = $value['pie_esp'];
				$pie_eng = $value['pie_eng'];
				$url = $value['url'];
				$contenido = $value['contenido'];
				$orden = $value['orden'];
				$titulo = $value['titulo'];

				$query = "UPDATE ctlg_imagenes SET pie='{$pie_esp}', pie='{$pie_eng}', url='{$url}', opciones='{$opciones}', contenido='{$contenido}', orden='{$orden}', titulo='{$titulo}' WHERE idImagen='$key'";
				$result = mysql_query($query);

			endforeach;
		endif;
	}

	function procesaImagenes($nid = 0, $config){

		$default = array(
			"carpetaUpload" => "../../archivos/imagenes/",
			"carpetaThumbs" => "../../archivos/imagenes/thumbs/"
		);

		$default = array_replace_recursive($default, $config);
		$setupUpload = array(
			"nid" => $nid,
			"nameInput" => 'nomArchivoGaleria',
			"tipoRegistro" => 'galeriaPage',
			"carpetaUpload" => $default['carpetaUpload'],
			"carpetas" => array(
				array(
					"carpetaOrigen" => $default['carpetaUpload'],
					"carpetaDestino" => $default['carpetaUpload'],
					"ancho" => 1280,
					"alto" => 0
				),
				array(
					"carpetaOrigen" => $default['carpetaUpload'],
					"carpetaDestino" => $default['carpetaThumbs'],
					"ancho" => 310,
					"alto" => 0
				)
			)
		);

		guardaImagenes($setupUpload);

		$setupUpload = array(
			"nid" => $nid,
			"nameInput" => 'archivoFeat',
			"tipoRegistro" => 'featPage',
			"carpetaUpload" => $default['carpetaUpload'],
			"carpetas" => array(
				array(
					"carpetaOrigen" => $default['carpetaUpload'],
					"carpetaDestino" => $default['carpetaUpload'],
					"ancho" => 1280,
					"alto" => 0
				),
				array(
					"carpetaOrigen" => $default['carpetaUpload'],
					"carpetaDestino" => $default['carpetaThumbs'],
					"ancho" => 310,
					"alto" => 0
				)
			)
		);
		guardaImagenes($setupUpload);

		$setupUpload = array(
			"nid" => $nid,
			"nameInput" => 'nomArchivo',
			"tipoRegistro" => 'previewPage',
			"carpetaUpload" => $default['carpetaUpload'],
			"carpetas" => array(
				array(
					"carpetaOrigen" => $default['carpetaUpload'],
					"carpetaDestino" => $default['carpetaThumbs'],
					"ancho" => 310,
					"alto" => 0
				)
			)
		);
		guardaImagenes($setupUpload);

		$setupUpload = array(
			"nid" => $nid,
			"nameInput" => 'featureSeccion',
			"tipoRegistro" => 'featSeccion',
			"carpetaUpload" => $default['carpetaUpload'],
			"carpetas" => array(
				array(
					"carpetaOrigen" => $default['carpetaUpload'],
					"carpetaDestino" => $default['carpetaUpload'],
					"ancho" => 1280,
					"alto" => 0
				),
				array(
					"carpetaOrigen" => $default['carpetaUpload'],
					"carpetaDestino" => $default['carpetaThumbs'],
					"ancho" => 310,
					"alto" => 0
				)
			)
		);
		guardaImagenes($setupUpload);

		$setupUpload = array(
			"nid" => $nid,
			"nameInput" => 'previewSeccion',
			"tipoRegistro" => 'previewSeccion',
			"carpetaUpload" => $default['carpetaUpload'],
			"carpetas" => array(
				array(
					"carpetaOrigen" => $default['carpetaUpload'],
					"carpetaDestino" => $default['carpetaUpload'],
					"ancho" => 1280,
					"alto" => 0
				),
				array(

					"carpetaOrigen" => $default['carpetaUpload'],
					"carpetaDestino" => $default['carpetaThumbs'],
					"ancho" => 310,
					"alto" => 0
				)
			)
		);
		guardaImagenes($setupUpload);

		$setupUpload = array(
			"nid" => $nid,
			"nameInput" => 'fondoItem',
			"tipoRegistro" => 'fondoItem',
			"carpetaUpload" => $default['carpetaUpload'],
			"carpetas" => array(
				array(
					"carpetaOrigen" => $default['carpetaUpload'],
					"carpetaDestino" => $default['carpetaThumbs'],
					"ancho" => 310,
					"alto" => 0
				)
			)
		);
		guardaImagenes($setupUpload);

		$setupUpload = array(
			"nid" => $nid,
			"nameInput" => 'iconoSeccion',
			"tipoRegistro" => 'iconoSeccion',
			"carpetaUpload" => $default['carpetaUpload'],
			"carpetas" => array(
				array(
					"carpetaOrigen" => $default['carpetaUpload'],
					"carpetaDestino" => $default['carpetaUpload'],
					"ancho" => 32,
					"alto" => 0
				)
			)
		);
		guardaImagenes($setupUpload);

		$setupUpload = array(
			"nid" => $nid,
			"nameInput" => 'iconoServicio',
			"tipoRegistro" => 'iconoServicio',
			"carpetaUpload" => $default['carpetaUpload'],
			"carpetas" => array(
				array(
					"carpetaOrigen" => $default['carpetaUpload'],
					"carpetaDestino" => $default['carpetaThumbs'],
					"ancho" => 100,
					"alto" => 0
				)
			)
		);
		guardaImagenes($setupUpload);

		$setupUpload = array(
			"nid" => $nid,
			"nameInput" => 'iconoAlternoServ',
			"tipoRegistro" => 'iconoAlternoServ',
			"carpetaUpload" => $default['carpetaUpload'],
			"carpetas" => array(
				array(
					"carpetaOrigen" => $default['carpetaUpload'],
					"carpetaDestino" => $default['carpetaThumbs'],
					"ancho" => 100,
					"alto" => 0
				)
			)
		);
		guardaImagenes($setupUpload);

		$setupUpload = array(
			"nid" => $nid,
			"nameInput" => 'featPage',
			"tipoRegistro" => 'featPage',
			"carpetaUpload" => $default['carpetaUpload'],
			"carpetas" => array(
				array(
					"carpetaOrigen" => $default['carpetaUpload'],
					"carpetaDestino" => $default['carpetaUpload'],
					"ancho" => 1280,
					"alto" => 0
				),
				array(
					"carpetaOrigen" => $default['carpetaUpload'],
					"carpetaDestino" => $default['carpetaThumbs'],
					"ancho" => 310,
					"alto" => 0
				)
			)
		);
		guardaImagenes($setupUpload);

		$setupUpload = array(
			"nid" => $nid,
			"nameInput" => 'previewPage',
			"tipoRegistro" => 'previewPage',
			"carpetaUpload" => $default['carpetaUpload'],
			"carpetas" => array(
				array(
					"carpetaOrigen" => $default['carpetaUpload'],
					"carpetaDestino" => $default['carpetaThumbs'],
					"ancho" => 310,
					"alto" => 0
				)
			)
		);
		guardaImagenes($setupUpload);
	}

	function add_post_meta($id, $llave, $valor=""){
		$query = "INSERT INTO ctlg_meta_entradas(idEntrada, llave, valor) VALUES('{$id}', '{$llave}', '{$valor}')";
		$result = mysql_query($query);

		return  ($result and mysql_affected_rows()) ? true : false;
	}


	function update_post_meta($id, $llave, $valor=""){
		$query = "UPDATE ctlg_meta_entradas SET valor='{$valor}' WHERE idEntrada='{$id}' AND llave='{$llave}'";
		$result = mysql_query($query);

		if($result and mysql_affected_rows()):
			return true;
		else:
			return add_post_meta($id, $llave, $valor);
		endif;

		return false;
	}

	function delete_post_meta($id){
		$query = "DELETE FROM ctlg_meta_entradas WHERE idEntrada='{$id}'";
		$result = mysql_query($query);

		return ($result and mysql_affected_rows())? true : false;
	}

	function get_post_custom($id){
		$item = array();

		$query = "SELECT llave, valor FROM ctlg_meta_entradas WHERE idEntrada={$id}";
		$result = mysql_query($query);

		if($result and mysql_num_rows($result)):
			while($row = mysql_fetch_array($result)):
				$items[$row['llave']] = $row['valor'];
			endwhile;
		endif;

		return $items;
	}

	function get_post_meta($id, $llave = "", $single = false){
		$items = array();

		if($llave==""):
			return get_post_custom($id);
		endif;

		if($single):
			$limite = " LIMIT 0,1 ";
		endif;

		$query = "SELECT llave, valor FROM ctlg_meta_entradas WHERE idEntrada={$id} AND llave='{$llave}' $limite";
		$result = mysql_query($query);

		if($result and mysql_num_rows($result)):
			while($row = mysql_fetch_array($result)):
				$items[$row['llave']] = $row['valor'];
			endwhile;

			return $items;
		endif;

		return false;
	}

	function guardaTags2($nid){
		//borrar tags antiguas
		$query = "DELETE FROM ctlg_cats_entradas WHERE idEntrada = '$nid'";
		$result = mysql_query($query);

		//guarda nuevas tags
		$tags = $_POST['tag'];
		if(is_array($tags)):
			foreach($tags as $key => $value):
				$query = "INSERT INTO ctlg_cats_entradas(idCat, idEntrada) VALUES('{$value}', '$nid')";
				$result = mysql_query($query);
			endforeach;
		endif;
	}

	function getTags($id, $tipo="tag"){
		$tags = array();
		$query = "SELECT cte.idCat id, cc.titulo_esp titulo, cc.slug FROM ctlg_cats_entradas cte LEFT JOIN ctlg_categorias cc USING (idCat) WHERE cte.idEntrada='$id' cc.tipo='{$tipo}'";
		$result = mysql_query($query);

		if($result and mysql_num_rows($result)):
			while($row = mysql_fetch_array($result)):
				$tags[] = $row;
			endwhile;

			return $tags;
		else:
			return NULL;
		endif;
	}

	function getTagsId($id, $tipo='tag'){
		$tags = array();
		$query = "SELECT cte.idCat id FROM ctlg_cats_entradas cte LEFT JOIN ctlg_categorias cc USING (idCat) WHERE cte.idEntrada='$id' AND cc.tipo='{$tipo}'";
		$result = mysql_query($query);

		if($result and mysql_num_rows($result)):
			while($row = mysql_fetch_array($result)):
				$tags[] = $row['id'];
			endwhile;

			return $tags;
		else:
			return NULL;
		endif;
	}
?>
