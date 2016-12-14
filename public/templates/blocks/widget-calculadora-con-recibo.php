<form id="calculadoraConRecibo" class="formCalculadora" action="resultado/" method="post" onsubmit="return validaCalculadoraConRecibo()">
	<div id="msj_resultadoCalculadoraConRecibo" class="infoProceso hidden"></div>
	
	<input type="hidden" name="calcula" value="con-recibo">

	<div class="col-md-3">
		<p>
		<select id="tipoTarifaConRecibo" name="tipoTarifa">
			<option value="">Tarifa</option>
			<option value="1">1</option>
			<option value="1A">1A</option>
			<option value="1B">1B</option>
			<option value="1C">1C</option>
			<option value="1D">1D</option>
			<option value="1E">1E</option>
			<option value="1F">1F</option>
			<option value="2">2</option>
			<option value="3">3</option>
			<option value="OM">OM</option>
			<option value="HM">HM</option>
		</select>
		</p>
	</div>

	<div class="col-md-3">
		<p><input type="text" id="consumoBimestral" name="consumoBimestral" placeholder="Consumo bimestral (Kw/h)"></p>
	</div>

	<div class="col-md-3">
		<p><input type="text" id="pagoBimestral" name="pagoBimestral" placeholder="Pago bimestral"></p>
	</div>

	<div class="col-md-3">
		<p><select id="ahorroConRecibo" name="ahorro" class="oculta-campos select-calc">
			<option value="">Cuanto quieres ahorrar</option>
			<option value="40" class="DAC DAC-1A DAC-1B DAC-1C DAC-1D DAC-1E DAC-1F 1 1A 1B 1C 1D 1E 1F">40 %</option>
			<option value="50" class="DAC DAC-1A DAC-1B DAC-1C DAC-1D DAC-1E DAC-1F 1 1A 1B 1C 1D 1E 1F">50 %</option>
			<option value="60" class="DAC DAC-1A DAC-1B DAC-1C DAC-1D DAC-1E DAC-1F 1 1A 1B 1C 1D 1E 1F 2 3 OM HM">60 %</option>
			<option value="70" class="DAC DAC-1A DAC-1B DAC-1C DAC-1D DAC-1E DAC-1F 1 1A 1B 1C 1D 1E 1F 2 3 OM HM">70 %</option>
			<option value="80" class="DAC DAC-1A DAC-1B DAC-1C DAC-1D DAC-1E DAC-1F 1 1A 1B 1C 1D 1E 1F 2 3 OM HM">80 %</option>
			<option value="90" class="DAC DAC-1A DAC-1B DAC-1C DAC-1D DAC-1E DAC-1F 1 1A 1B 1C 1D 1E 1F 2 3 OM HM">90 %</option>
			<option value="100" class="DAC DAC-1A DAC-1B DAC-1C DAC-1D DAC-1E DAC-1F 1 1A 1B 1C 1D 1E 1F 2 3 OM HM">100 %</option>
		</select>
		</p>
	</div>

	<div class="clearfix"></div>

	<p align="center"><input class="btn-color" type="submit" value="Calcular"></p>
</form>
