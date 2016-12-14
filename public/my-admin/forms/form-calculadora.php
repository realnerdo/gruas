<?php
	include("configCalculadora.php");
	$configCalc = unserialize($configCalc);
	$contenidoNotaSin = htmlspecialchars(stripslashes($configCalc["contenidoNotaSin"]));
	$contenidoNotaCon = htmlspecialchars(stripslashes($configCalc["contenidoNotaCon"]));

	$tarifasRecibo = array(
		"1" => array(
			"periodo" => "Bimestral",
			"numPeriodo" => 6
		),
		"1A" => array(
			"periodo" => "Bimestral",
			"numPeriodo" => 6
		),
		"1B" => array(
			"periodo" => "Bimestral",
			"numPeriodo" => 6
		),
		"1C" => array(
			"periodo" => "Bimestral",
			"numPeriodo" => 6
		),
		"1D" => array(
			"periodo" => "Bimestral",
			"numPeriodo" => 6
		),
		"1E" => array(
			"periodo" => "Bimestral",
			"numPeriodo" => 6
		),
		"1F" => array(
			"periodo" => "Bimestral",
			"numPeriodo" => 6
		),
		"2" => array(
			"periodo" => "Mensual",
			"numPeriodo" => 12
		),
		"3" => array(
			"periodo" => "Mensual",
			"numPeriodo" => 12
		),
		"OM" => array(
			"periodo" => "Mensual",
			"numPeriodo" => 12
		),
		"HM" => array(
			"periodo" => "Mensual",
			"numPeriodo" => 12
		)
	);

	$tarifasNoRecibo = array(
		"residencial" => array(
			"periodo" => "Bimestral",
			"numPeriodo" => 6
		),
		"comercial" => array(
			"periodo" => "Mensual",
			"numPeriodo" => 12
		),
		"industrial" => array(
			"periodo" => "Mensual",
			"numPeriodo" => 12
		)
	);
?>

<div id="formulario">
    <h2><a id="toggleForm" href="#toggleForm"><?php echo $accion?> Configuraci&oacute;n Calculadora</a></h2>
    
    <div id="form_addup">
        <form id="form-config" action="procesos/proc-calculadora.php" method="post" enctype="multipart/form-data">
            <?php startPost(); ?>
            <div id="info-col">
                <div id="info-col-cont">
					<table class="form-table">
						<tr>
							<th>
								<p><label>Tasa anual:</label></p>
							</th>
							<td>
								<p><input type="text" name="tasaAnual" value="<?php echo $configCalc['tasaAnual']?>"></p>
							</td>
						</tr>
						<tr>
							<th>
								<p><label>Potencia por panel (w):</label></p>
							</th>
							<td>
								<p><input type="text" name="wattsPanel" value="<?php echo $configCalc['wattsPanel']?>"></p>
							</td>
						</tr>
						<tr>
							<th>
								<p><label>Produccion por panel (w):</label></p>
							</th>
							<td>
								<p><input type="text" name="produccionPanel" value="<?php echo $configCalc['produccionPanel']?>"></p>
							</td>
						</tr>
						<tr>
							<th>
								<p><label>Tama&ntilde;o panel (m<sup>2</sup>):</label></p>
							</th>
							<td>
								<p><input type="text" name="tamanoPanel" value="<?php echo $configCalc['tamanoPanel']?>"></p>
							</td>
						</tr>
						<tr>
							<th>
								<p><label>Gastos de operaci&oacute;n:</label></p>
							</th>
							<td>
								<p><input type="text" name="gastosOperacion" value="<?php echo $configCalc['gastosOperacion']?>"></p>
							</td>
						</tr>
						
						<tr>
							<th>
								<p><label>Precios por Watt:</label></p>
							</th>
							<td>
								<p><input type="text" name="precioWatt" value="<?php echo $configCalc['precioWatt']?>"></p>
							</td>
						</tr>
					</table>
					
					<h2>Nota</h2>
					
					<h3>Sin recibo</h3>
					<p><textarea class="jquery_ckeditor" name="contenidoNotaSin" cols="" rows=""><?php echo $contenidoNotaSin?></textarea></p>
					
					<h3>Con recibo</h3>
					<p><textarea class="jquery_ckeditor" name="contenidoNotaCon" cols="" rows=""><?php echo $contenidoNotaCon?></textarea></p>
					
					<h2>Tarifas con recibo</h2>
					
                    <table class="form-table">
						<tr>
							<td></td>
							<td>Tarifa</td>
							<td>Tarifa Alto consumo</td>
						</tr>
						
						<?php 
							foreach($tarifasRecibo as $key => $value):?>
								<tr>
									<th><label><?php echo $key?></label></th>
									<td><input name="tarifasConRecibo[<?php echo $key?>][tarifa]" type="text" value="<?php echo $configCalc['tarifasConRecibo']["{$key}"]['tarifa']?>"/>
										<input name="tarifasConRecibo[<?php echo $key?>][periodo]" type="hidden" value="<?php echo $value['periodo']?>"/>
										<input name="tarifasConRecibo[<?php echo $key?>][numPeriodo]" type="hidden" value="<?php echo $value['numPeriodo']?>"/>
									</td>
									<td>
										<input name="tarifasConRecibo[<?php echo $key?>][TAC]" type="text" value="<?php echo $configCalc['tarifasConRecibo']["{$key}"]['TAC']?>"/>
									</td>
								</tr>
						<?php
							endforeach;?>
                    </table>
					
					<h2>Tarifas sin recibo</h2>
					
					 <table class="form-table">
						<tr>
							<td></td>
							<td>Tarifa</td>
							<td>Tarifa Alto consumo</td>
							<td>Aplicar cuando exceda</td>
						</tr>
						
						<?php							
							foreach($tarifasNoRecibo as $key => $value):?>
						
								<tr>
									<th><label><?php echo $key?></label></th>
									<td><input name="tarifasSinRecibo[<?php echo $key?>][tarifa]" type="text" value="<?php echo $configCalc['tarifasSinRecibo']["{$key}"]['tarifa']?>"/>
										<input name="tarifasSinRecibo[<?php echo $key?>][periodo]" type="hidden" value="<?php echo $value['periodo']?>"/>
										<input name="tarifasSinRecibo[<?php echo $key?>][numPeriodo]" type="hidden" value="<?php echo $value['numPeriodo']?>"/>
									</td>
									<td>
										<input name="tarifasSinRecibo[<?php echo $key?>][TAC]" type="text" value="<?php echo $configCalc['tarifasSinRecibo']["{$key}"]['TAC']?>"/>
									</td>
									<td>
										<input type="text" name="tarifasSinRecibo[<?php echo $key?>][minimo]" value="<?php echo $configCalc['tarifasSinRecibo']["{$key}"]['minimo']?>" />
									</td>
								</tr>
						<?php
							endforeach;?>
                    </table>
					
                    <p><input class="btn_submit" type="submit" name="saveChanges" value="Guardar cambios" /></p>
                </div>
            </div>
            <div class="fix"></div>
        </form>
    </div><!--fin form_addup-->
</div><!--fin formulario-->

<?php
	$estadoForm = "muestraForm();";
	$scriptFooter = "
		<script src=\"js/ckeditor/ckeditor.js\"></script>
		<script src=\"js/ckeditor/adapters/jquery.js\"></script>
		<script src=\"js/ckfinder/ckfinder.js\"></script>
		<script>$(function(){ $estadoForm });</script>";
?>
