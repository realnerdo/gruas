<?php
	function calculaIncTasa($base, $tasa, $anios){
		$incTasa =  1 + ($tasa/100);
		$pow = $anios - 1;
		return $base * ( pow($incTasa, $pow) );
	}
	
	include("my-admin/configCalculadora.php");
	$configCalc = unserialize($configCalc);

	$maxAnios = 25;
	$numPeriodosAnual = 6;
	$tasaAnual = $configCalc['tasaAnual'];
	$wattsPanel = $configCalc['wattsPanel'];
	$precioWatt = $configCalc['precioWatt'];
	$gastosOperacion = $configCalc['gastosOperacion'];
	$contenidoNotaSin = $configCalc["contenidoNotaSin"];
	$contenidoNotaCon = $configCalc["contenidoNotaCon"];
	$produccionPanel = $configCalc["produccionPanel"];
	$tamanoPanel = $configCalc["tamanoPanel"];

	$estado = (isset($_POST['estado']))?$_POST['estado']:$_GET['estado'];
	$ahorro = (isset($_POST['ahorro']))?$_POST['ahorro']:$_GET['ahorro'];
	$pagoBimestral = (isset($_POST['pagoBimestral']))?$_POST['pagoBimestral']:$_GET['pagoBimestral'];
	$tipoTarifa = (isset($_POST['tipoTarifa']))?$_POST['tipoTarifa']:$_GET['tipoTarifa'];
	$tipoCalculadora = (isset($_POST['calcula']))?$_POST['calcula']:$_GET['calcula'];
	$metodo = (isset($_POST['metodo']))?$_POST['metodo']:"";

	if($tipoCalculadora=="con-recibo"):

		$tarifas = $configCalc['tarifasConRecibo'];
		$consumoBimestral = (isset($_POST['consumoBimestral']))?$_POST['consumoBimestral']:$_GET['consumoBimestral'];

	elseif($tipoCalculadora=="sin-recibo"):

		$tarifas = $configCalc['tarifasSinRecibo'];

		$tarifa = $tarifas[$tipoTarifa]['tarifa'];

		if($pagoBimestral > $tarifas[$tipoTarifa]['minimo']):
			$tarifa = $tarifas[$tipoTarifa]['TAC'];
		endif;

		$consumoBimestral = $pagoBimestral / $tarifa;
	else:
		header("Location:../calculadora/");
	endif;

	$precioTarifa = $tarifas[$tipoTarifa]['tarifa'];
	$precioTAC = $tarifas[$tipoTarifa]['TAC'];
	
	$consumoKwhAnual = $consumoBimestral * $numPeriodosAnual;
	$produccionRequerida = $consumoKwhAnual * ($ahorro/100);

	$numPaneles = ceil($produccionRequerida / $produccionPanel);

	$metrosRequeridos = $numPaneles * $tamanoPanel;
	$capacidadInstalada = $numPaneles * $wattsPanel;

	$emicionesCO2 = ceil(($produccionRequerida*.000392));
	$arbolesSalvados = ceil(($produccionRequerida/5000) * 100);
	$nuevoPagoBimestral = $pagoBimestral*((100-$ahorro)/100);

	$costoAprox = ($precioWatt * $capacidadInstalada) + $gastosOperacion;

	$ahorro25anios = $produccionRequerida * $precioTAC;

	for($i = 2; $i<=$maxAnios; $i++):
		$base = calculaIncTasa($precioTarifa, $tasaAnual, $i);
		$TAC =  calculaIncTasa($precioTAC, $tasaAnual, $i);
		
		$ahorro25anios += ($produccionRequerida * $TAC) + (($consumoKwhAnual - $produccionRequerida) *  ($TAC - $base));
	endfor;	
?>
<?php
	if($metodo != "ajax") {
		require("header.php");
	}
?>

<section id="cont-resultado-calculo" class="cont-resultado-calculo">
	<div class="container">
		<h2>Ahorrando el <strong><?php echo $ahorro?>%</strong> de tu recibo de luz:</h2>
		<h3>Invertirás aproximadamente $<?php echo number_format($costoAprox, 2)?></h3>
		
		<div class="resultadosCalculo">
		
			<div class="col-md-4">
				<figure>
					<img src="img/calculadora-ico-1.png">
					<figcaption>
						<p>Requieres <span class="number"><?php echo $metrosRequeridos?></span>m<sup>2</sup> de paneles</p>
					</figcaption>
				</figure>
			</div><!--.medidor-->
			
			<div class="col-md-4">
				<figure>
					<img src="img/calculadora-ico-2.png">
					<figcaption>
						<p><span class="number"><?php echo $numPaneles?></span> paneles necesarios</p>
					</figcaption>
				</figure>
			</div><!--.medidor-->
			
			<div class="col-md-4">
				<figure>
					<img src="img/calculadora-ico-3.png">
					<figcaption>
						<p>Ahorraras $<span class="number"><?php echo $pagoBimestral - $nuevoPagoBimestral?></span> bimestral</p>
					</figcaption>
				</figure>
			</div><!--.medidor-->
			
			<div class="col-md-4">
				<figure>
					<img src="img/calculadora-ico-4.png">
					<figcaption>
						<p><span class="number"><?php echo number_format($produccionRequerida)?></span>KWh energ&iacute;a producida anualmente</p>
					</figcaption>
				</figure>
			</div><!--.medidor-->
			
			<div class="col-md-4">
				<figure>
					<img src="img/calculadora-ico-5.png">
					<figcaption>
						<p>Evitarás <span class="number"><?php echo $emicionesCO2?></span> Toneladas de CO<sub>2</sub> anuales</p>
					</figcaption>
				</figure>
			</div><!--.medidor-->
			
			<div class="col-md-4">
				<figure>
					<img src="img/calculadora-ico-6.png">
					<figcaption>
						<p>Salvaras <span class="number"><?php echo $arbolesSalvados?></span> &aacute;rboles anualmente</p>
					</figcaption>
				</figure>
			</div><!--.medidor-->
			
			<div class="clearfix"></div>
		</div>

		<div class="nota">
			<?php
				if($tipoCalculadora=="sin-recibo"):
					echo $contenidoNotaSin;
				elseif($tipoCalculadora=="con-recibo"):
					echo $contenidoNotaCon;
				endif;?>
				
			<div class="clearfix"></div>
		</div>
	</div><!--.container_24-->
</section><!--.info-block-->

<?php
	if($metodo != "ajax") {
		require("footer.php");
	}
?>
