<form id="calculadoraSinRecibo" class="formCalculadora" action="resultado/" method="post" onsubmit="return validaCalculadoraSinRecibo()">
	<div id="msj_resultadoCalculadoraSinRecibo" class="infoProceso hidden"></div>

	<input type="hidden" name="calcula" value="sin-recibo">
	
	<div class="col-md-4">
		<p>
		<select id="tipoTarifaSinRecibo" name="tipoTarifa">
			<option value="">Tarifa</option>
			<option value="residencial">Residencial</option>
			<option value="comercial">Comercial</option>
			<option value="industrial">Industrial</option>
		</select>
		</p>
	</div>
	
	<div class="col-md-4">
		<p>
		<select id="pagoBimestralSinRecibo" name="pagoBimestral">
			<option value="">Pago bimestral</option>
			<option value="1750" class="residencial">$1,000 - $2,500</option>
			<option value="3250" class="residencial">$2,501 - $4,000</option>
			<option value="4750" class="residencial">$4,001 - $5,500</option>
			<option value="6250" class="residencial">$5,501 - $7,000</option>
			<option value="7750" class="residencial">$7,001 - $8,500</option>
			<option value="9250" class="residencial">$8,500 - $1,0000</option>
			<option value="11250" class="residencial">$10,001 - $12,500</option>
			<option value="13750" class="residencial">$12,500 - $15,000</option>
			<option value="16500" class="residencial">$15,001 - $18,000</option>
			<option value="19500" class="residencial">$18,001 - $21,000</option>
			<option value="23000" class="residencial">$21,001 - $25,000</option>
			<option value="27500" class="residencial">$25,001 - $30,000</option>
			<option value="35000" class="comercial">$30,001 - $40,000</option>
			<option value="45000" class="comercial">$40,001 - $50,000</option>
			<option value="55000" class="comercial">$50,001 - $60,000</option>
			<option value="65000" class="comercial">$60,001 - $70,000</option>
			<option value="75000" class="comercial">$70,001 - $80,000</option>
			<option value="90000" class="comercial">$80,001 - $100,000</option>
			<option value="110000" class="industrial">$100,000 - $120,000</option>
			<option value="130000" class="industrial">$120,001 - $140,000</option>
			<option value="160000" class="industrial">$140,001 - $180,000</option>
			<option value="200000" class="industrial">$180,001 - $220,000</option>
			<option value="260000" class="industrial">$220,001 - $300,000</option>					
		</select>
		</p>
	</div>
	
	<div class="col-md-4">
		<p><select id="ahorroSinRecibo" name="ahorro">
			<option value="">Cuanto quieres ahorrar</option>
			<option value="10" class="industrial">10 %</option>
			<option value="20" class="industrial">20 %</option>
			<option value="30" class="industrial">30 %</option>
			<option value="40" class="residencial comercial">40 %</option>
			<option value="50" class="residencial comercial ">50 %</option>
			<option value="60" class="residencial comercial l">60 %</option>
			<option value="70" class="residencial comercial ">70 %</option>
			<option value="80" class="residencial comercial ">80 %</option>
			<option value="90" class="residencial comercial ">90 %</option>
			<option value="100" class="residencial comercial">100 %</option>
		</select>
		</p>
	</div>
	
	<div class="clearfix"></div>
	
	<p align="center"><input class="btn-color" type="submit" value="Calcular"></p>
	
	
</form>