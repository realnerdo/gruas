<?php	
		if($result_edit and mysql_num_rows($result_edit)==1):
<div class="formulario">
    <h2><a id="toggleForm" href="#toggleForm"><?php echo $accion?> <?php echo $tituloAccion?></a></h2>  
			<div class="info-col">
					<?php include("widgets/orden.php")?>