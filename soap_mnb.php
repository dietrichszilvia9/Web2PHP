<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>SOAP MNB</title>
</head>
<body>
    <?= isset($result) ? $result : '' ?>
    <br>
    <h2>MNB napi árfolyam</h2>
    <form method="post">
        <div class="form-group">
            <label for="dropdown">Valutapár:</label>
            <select id="dropdown" name="dropdown">
                <option value="8">EUR - HUF</option>
                <option value="31">USD - HUF</option>
                <option value="0">AUD - HUF</option>
                <option value="4">CHF - HUF</option>
                <option value="6">CZK - HUF</option>
                <option value="7">DKK - HUF</option>
                <option value="9">GBP - HUF</option>
                <option value="12">ILS - HUF</option>
                <option value="15">JPY - HUF</option>
                <option value="29">TRY - HUF</option>
            </select>
        </div>
        <br>
        <input type="submit" value="Küldés">
    </form>
	
	 <h1>Árfolyam</h1>
    <p>A kiválasztott valutapár értéke:</p>
	
	<pre>
		<?php
		if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['dropdown'])) {
			try {
				$client = new SoapClient("http://www.mnb.hu/arfolyamok.asmx?WSDL");
				
				$tömb = (array)simplexml_load_string($client->GetCurrentExchangeRates()->GetCurrentExchangeRatesResult);
				
				$rate = (string) $tömb["Day"]->Rate[(int)$_POST['dropdown']];

				$ratearray = array((string) $tömb["Day"]->Rate[8], (string) $tömb["Day"]->Rate[31], (string) $tömb["Day"]->Rate[0]);
				array_push($ratearray, (string) $tömb["Day"]->Rate[4], (string) $tömb["Day"]->Rate[6], (string) $tömb["Day"]->Rate[7]);
				array_push($ratearray, (string) $tömb["Day"]->Rate[9], (string) $tömb["Day"]->Rate[12], (string) $tömb["Day"]->Rate[15], (string) $tömb["Day"]->Rate[29]);
				
				foreach ($ratearray as $r) {
				  $r = str_replace(",",".",$r);
				}
				
				echo "<span style='border: 1pt solid;font-size: 1.8rem;'><b>".$rate."</b></span>";

			} catch (SoapFault $e) {
				$rate = "Hiba történt: " . $e->getMessage();
			}
		}
		?>
	</pre>
	
	<div>
  <canvas id="myChart"></canvas>
</div>

	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
	
	<script>
	  const ctx = document.getElementById('myChart');
	  
		var js_rate = "<?php echo $rate; ?>";
		js_rate = js_rate.replace(",", ".");
		var numeric_rate = parseFloat(js_rate);
		
		var js_rate_array = <?php echo json_encode($ratearray); ?>;

		var numeric_rates = js_rate_array.map(rate => parseFloat(rate));

	  new Chart(ctx, {
		type: 'bar',
		data: {
		  labels: ['EUR - HUF', 'USD - HUF', 'AUD - HUF', 'CHF - HUF', 'CZK - HUF', 'DKK - HUF', 'GBP - HUF', 'ILS - HUF', 'JPY - HUF', 'TRY - HUF'],
		  datasets: [{
			label: 'árfolyam',
			data: numeric_rates,
			borderWidth: 1
		  }]
		},
		options: {
		  scales: {
			y: {
			  beginAtZero: true
			}
		  }
		}
	  });

	</script>
</body>
</html>