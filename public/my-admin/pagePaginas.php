<?php
<?php include("forms/form-pagina.php");?>
<?php
				$query = "SELECT DISTINCT ce.idEntrada id, ce.titulo_esp titulo, ce.estatus, ce.tipo, ce.slug FROM ctlg_entradas ce LEFT JOIN (ctlg_cats_entradas cce) USING (idEntrada) WHERE ce.tipo='$tipo' $s $ic ORDER BY ce.estatus DESC, id DESC, titulo ASC";
                    <table class="tb_resultado" cellspacing="0">