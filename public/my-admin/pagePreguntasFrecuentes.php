<?php
	$preNomSitio = "Preguntas Frecuentes &lsaquo; ";
	$accion = "Agregar";
	$tituloAccion = "Pregunta Frecuente";
	$tipo = 'faq';

	if(isset($_GET['haccion']) and $_GET['haccion']=="editar"):
		$accion = "Editar";
		$preNomSitio = $accion." " . $tituloAccion . " &lsaquo; ";
	endif;
?>
<?php include("header.php");?>

<?php include("forms/form-faq.php");?>

<?php
	if($accion == "Agregar"):?>

		<?php include("forms/form-busca.php");?>

        <div id="resultado">
            <?php
                $s = (isset($_GET['s']) and isset($_GET['s'])!='')?" AND (e.titulo_esp LIKE '%".$_GET['s']."%' OR e.titulo_eng LIKE '%".$_GET['s']."%' OR e.contenido_esp LIKE '%".$_GET['s']."%' OR e.contenido_eng LIKE '%".$_GET['s']."%')":"";

				$query = "SELECT e.idEntrada id, e.titulo_esp titulo, e.estatus FROM ctlg_entradas e WHERE tipo='$tipo' $s ORDER BY fechaPublicacion DESC";
                $paging = new PHPPaging;
                $paging->agregarConsulta($query);

				if($paging->ejecutar() and $paging->numTotalRegistros()>0):?>

                    <?php include("widgets/paginacion.php");?>

                    <table class="tb_resultado" cellpadding="0" cellspacing="0">
                        <tr>
                            <th>T&iacute;tulo</th>
                            <th>Estatus</th>
                        </tr>
                        <?php
						$i=0;
                            while($row = $paging->fetchResultado()):
                                $clase = ($i%2==0)?'blanco':'gris'; $i++;?>
                                <tr class="<?php echo $clase?>">
                                    <td>
                                        <p><?php echo $row["titulo"];?></p>
                                        <p class="acciones">
                                            <a class="btn-edit" href="?hid=<?php echo $row['id']?>&haccion=editar" title="Editar"><img alt="Editar" src="img/24-tag-manager.png" /></a>
                                            <a class="btn-del" href="procesos/proc-contenido.php?hid=<?php echo $row['id']?>&haccion=eliminar" title="Eliminar"><img alt="Eliminar" src="img/24-em-cross.png" /></a>
                                        </p>
                                    </td>
                                    <td>
                                        <p><?php echo ($row["estatus"]==0)?"No":"" ?> Publicado</p>
                                    </td>
                                </tr>
                        <?php
                            endwhile;?>
                        <tr>
                            <th>T&iacute;tulo</th>
                            <th>Estatus</th>
                        </tr>
                    </table>

					<?php include("widgets/paginacion.php");?>

            <?php
                else:?>
                    <p class="noItems">No hay contenido registrado</p>
            <?php
                endif;?>
        </div><!--fin resultado-->
<?php
	endif;?>

<?php include("footer.php");?>
