<?php
<?php include("forms/form-link.php");?>
<?php
		<div class="filtro">
				$query = "SELECT DISTINCT ce.idEntrada id, ce.titulo_esp titulo, ce.estatus, ce.tipo, ce.slug, ce.opciones FROM ctlg_entradas ce LEFT JOIN (ctlg_cats_entradas cce) USING (idEntrada) WHERE ce.tipo='$tipo' $s $ic ORDER BY ce.estatus DESC, id DESC, titulo ASC";
					<?php include("widgets/paginacion.php");?>
                    <table class="tb_resultado" cellspacing="0">
				else:?>