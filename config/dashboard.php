<?php include "db.php"; ?>

<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fetch and display data from database in charts and maps</title>
    <style>
  body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
  }

  header {
    background-color: #333;
    color: #fff;
    text-align: center;
    padding: 20px;
  }

  h1 {
    font-size: 36px;
  }

  h3 {
    font-size: 18px;
    margin-top: 10px;
  }

  #photo {
    display: inline-block;
    margin-left: 20px;
  }

 

  .chart {
    width: 100%;
    height: 400px;
  }

  .charts-row {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
  }

  .chart-item {
    width: 48%;
    margin-bottom: 20px;
    padding: 10px;
    background-color: #fff;
    box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.1);
    border-radius: 5px;
  }

 /* Style for the <nav> tag */
nav {
  background-color: #4d4c4c; /* Change the background color to a suitable color */
  text-align: center;
  padding: 10px 0;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

nav ul {
  list-style: none;
  padding: 0;
}

nav ul li {
  display: inline;
  margin-right: 20px;
}

nav ul li:last-child {
  margin-right: 0;
}

nav a {
  text-decoration: none;
  color: #fff;
  font-weight: bold;
  font-size: 16px;
}

nav a:hover {
  color: #FF5733;
}


</style>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages': ['bar', 'corechart']});
      google.charts.setOnLoadCallback(drawCharts);

      function drawCharts() {
        drawBarChart();
        drawPieCharts();
        drawAreaChart();
        drawLineChart();
      }

      function drawBarChart() {
        var data = google.visualization.arrayToDataTable([
          ['Candidate Name', 'CPI'],
          <?php
          $query = "select fname, CPI from form";
          $res = mysqli_query($con, $query);
          while ($data = mysqli_fetch_array($res)) {
            $fname = $data['fname'];
            $CPI = $data['CPI'];
            ?>
            ['<?php echo $fname; ?>', <?php echo $CPI; ?>],
            <?php
          }
          ?>
        ]);

        var options = {
          chart: {
            title: 'CPI of Candidates (Bar Chart)',
            subtitle: 'Names, CPI of applied',
          },
          bars: 'vertical',
          colors: ['#FF5733', '#FFC300', '#33FF57'],
        };

        var chart = new google.charts.Bar(document.getElementById('barchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }

      function drawPieCharts() {
        var data1 = google.visualization.arrayToDataTable([
          ['Degree', 'Count'],
          <?php
          $query = "SELECT degree, COUNT(*) as count FROM form GROUP BY degree";
          $res = mysqli_query($con, $query);
          while ($data = mysqli_fetch_array($res)) {
            $degreeType = $data['degree'];
            $count = $data['count'];
            ?>
            ['<?php echo $degreeType; ?>', <?php echo $count; ?>],
            <?php
          }
          ?>
        ]);

        var options1 = {
          title: 'Types of highest degrees by Candidates (Pie Chart)',
          is3D: true,
        };

        var chart1 = new google.visualization.PieChart(document.getElementById('piechart_3d_1'));

        chart1.draw(data1, options1);

        var data2 = google.visualization.arrayToDataTable([
          ['Gender', 'Count'],
          <?php
          $query = "SELECT Gender, COUNT(*) as count1 FROM form GROUP BY Gender";
          $res = mysqli_query($con, $query);
          while ($data = mysqli_fetch_array($res)) {
            $Gender = $data['Gender'];
            $count1 = $data['count1'];
            ?>
            ['<?php echo $Gender; ?>', <?php echo $count1; ?>],
            <?php
          }
          ?>
        ]);

        var options2 = {
          title: 'Gender Distribution (Pie Chart)',
          is3D: true,
        };

        var chart2 = new google.visualization.PieChart(document.getElementById('piechart_3d_2'));

        chart2.draw(data2, options2);
      }

      function drawAreaChart() {
        var data = google.visualization.arrayToDataTable([
          ['Year', 'Applications', 'Selected'],
          ['2016', 3200, 2400],
          ['2017', 1800, 1000],
          ['2018', 2500, 2000],
          ['2019', 3000, 2000],
          ['2020', 1670, 660],
          ['2021', 3660, 620],
          ['2022', 1030, 940],
        ]);

        var options = {
          title: 'Candidates Selected',
          hAxis: { title: 'Year', titleTextStyle: { color: '#333' } },
          vAxis: { minValue: 0 },
        };

        var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));

        chart.draw(data, options);
      }

      function drawLineChart() {
  var data = google.visualization.arrayToDataTable([
    ['Course', 'Count'],
    <?php
    $query = "SELECT course, COUNT(*) as count FROM form GROUP BY course";
    $res = mysqli_query($con, $query);
    while ($data = mysqli_fetch_array($res)) {
      $courseType = $data['course'];
      $count = $data['count'];
      ?>
      ['<?php echo $courseType; ?>', <?php echo $count; ?>],
      <?php
    }
    ?>
  ]);
  var options = {
    title: 'Number of applications per branch',
    curveType: 'none', // Change this to 'none' for straight lines
    legend: { position: 'bottom' }
  };

  var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

  chart.draw(data, options);
}

    </script>
  </head>
  <body>
  <header>
  <img src="VJTI_LOGO.png" id="photo" alt="Profile photo" height="80" width="80" style="filter: invert(1);">
  <h1>Dashboard for the Selection Process</h1>
  <h3>The live website for all the data regarding the selection process</h3>
</header>

<nav>
  <ul>
    <li><a href="/Assignment_3/home.html">Home</a></li>
    <li><a href="/Assignment_3/form.html">Registration Form</a></li>
    <li><a href="config/dashboard.php">Data Analytics Dashboard</a></li>
    <li><a href="/Assignment_3/WIM_Profile/index.html">My Profile</a></li>
    <li><a href="display.php">Registered Candidate's Data</a></li>
  </ul>
</nav>



  <div class="charts-row">
      <div class="chart-item">
        <h2>Locationwise map of candidates</h2>
      <iframe src="https://www.google.com/maps/d/u/0/embed?mid=1YF_-zFM5C8M6ar_g8quN7gUcyovbPy4&ehbc=2E312F" width="640" height="480"></iframe>

      </div>
      <div class="chart-item">
        <h2>Types of highest degrees by Candidates</h2>
        <div id="piechart_3d_1" class="chart"></div>
      </div>
      
  </div>



<div class="charts-row">
<div class="chart-item">
    <h2>CPI of Candidates</h2>
    <div id="barchart_material" class="chart"></div>
    </div>
  
  
  
  <div class="chart-item">
    <h2>Number of Applications per Branch</h2>
    <div id="curve_chart" class="chart"></div>
  </div>

</div>

<div class="charts-row">
<div class="chart-item">
        <h2>Gender Distribution</h2>
        <div id="piechart_3d_2" class="chart"></div>
  </div>
<div class="chart-item">
  <h2>Candidates Selected</h2>
  <div id="chart_div" class="chart"></div>
</div>
      </div>

    
    
  </body>
</html>
