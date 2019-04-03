<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Temperature, Humidity</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <!--For Humidity Gauge-->
    <script type="text/javascript">
      google.charts.load('current', {'packages':['gauge']});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Label', 'Value'],
          ['Humidity', 0],
          //['Temperature', 0]
         
        ]);

        var options = {
          width: 250, height: 250,
          redFrom: 70, redTo: 100,
          yellowFrom:40, yellowTo: 70,
          greenFrom:0, greenTo: 50,
          minorTicks: 5
        };

        var chart = new google.visualization.Gauge(document.getElementById('humidity'));

        chart.draw(data, options);

        setInterval(function() {
            var JSON=$.ajax({
                url:"http://localhost/gaugechart/DataSensores.php?q=1",
                dataType: 'json',
                async: false}).responseText;
            var Respuesta=jQuery.parseJSON(JSON);
            
          data.setValue(0, 1,Respuesta[0].humidity);
          //data.setValue(1, 1,Respuesta[0].temperature);
          chart.draw(data, options);
        }, 130);
        
      }
    </script>
<!--For Temperature-->
<script type="text/javascript">
      google.charts.load('current', {'packages':['gauge']});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Label', 'Value'],
          //['Humidity', 0],
          ['Temperature', 0]
         
        ]);

        var options = {
          width: 250, height: 250,
          redFrom: 70, redTo: 100,
          yellowFrom:40, yellowTo: 70,
          greenFrom:0, greenTo: 50,
          minorTicks: 5
        };

        var chart = new google.visualization.Gauge(document.getElementById('temperature'));

        chart.draw(data, options);

        setInterval(function() {
            var JSON=$.ajax({
                url:"http://localhost/gaugechart/Datatemperature.php?q=1",
                dataType: 'json',
                async: false}).responseText;
            var Respuesta=jQuery.parseJSON(JSON);
            
          //data.setValue(0, 1,Respuesta[0].humidity);
          data.setValue(0, 1,Respuesta[0].temperature);
          chart.draw(data, options);
        }, 130);
        
      }
    </script>

</head>
<body style="background-color: silver">
  <h1 style="text-align: center;color: blue"><b><u>Hmidity And Temperature Sensor</u></b></h1>
  <div class="container"><hr>
    <table border="0" align="center" width="600">
      <tr>
        <td>
          <h1 style="color: blue;padding: 20px"><b><u>Humidity</u></b></h1>
        </td>
        <td>
          <div id="humidity" style="color: blue;padding: 20px"</div>
        </td>
      </tr>

      <tr>
        <td>
          <h1 style="color: blue;padding: 20px"><b><u>Temperature</u></b></h1>
        </td>
        <td>
          <div id="temperature" style="color: blue;padding: 20px"></div>
        </td>
      </tr>
    </table>
    <hr>
  </div>
</body>
</html>