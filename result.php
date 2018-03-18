<?php
  session_start();

  //get value from cookie
  $logic = $_COOKIE['logic'];
  $math = $_COOKIE['math'];
  $memory = 0;
  $focus = 0;
  $agility = 0;

  //database connection
  $db=mysqli_connect('localhost', 'root', '', 'fyp');
  //identify users
  $userid = $_SESSION['userid'];

  //extract record from database
  $query = "SELECT * FROM game_data WHERE userid = '$userid'";
  $run = mysqli_query($db,$query);
  $result = mysqli_fetch_array($run);

  $timeTotal = $result['timeTotal'];
  $timeSafe = $result['timeSafe'];
  $errorPwd = $result['errorPwd'];

  if($timeTotal<=300){
    $agility = 6;
  }
  elseif (300<$timeTotal && $timeTotal<=600) {
    $agility = 4;
  }
  else {
    $agility = 2;
  }

  if($timeSafe<=300){
    $focus = 6;
  }
  elseif (300<$timeTotal && $timeTotal<=480) {
    $focus = 4;
  }
  else {
    $focus = 2;
  }

  if($errorPwd<=3){
    $memory = 6;
  }
  elseif (3<$timeTotal && $timeTotal<=5) {
    $memory = 4;
  }
  else {
    $memory = 2;
  }

  $score = array($memory, $focus, $logic, $math, $agility);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="uft-8">
  <script src="echarts_radar.js"></script>
  <script src="echarts_radar.js"></script>
  <script type="text/javascript" src="jquery-3.2.1.min.js"></script>
  <script type="text/javascript" src="quiz_simply.js"></script>
  <title>radar chart</title>
</head>
</html>

<body>
  <div id="radar" style="width:800px; height:600px;"></div>

  <script type="text/javascript">
    var mychart = echarts.init(document.getElementById("radar"));
    var score = <?php echo json_encode($score)?>;
    var option = {
          title: {
              text: 'Result page'
          },
          radar: [
              {
                  indicator: [
                      { text: 'Memory', max: 6},
                      { text: 'Focus', max: 6},
                      { text: 'Logic', max: 7},
                      { text: 'Numbering', max: 4},
                      { text: 'Agility', max: 6}
                  ],
                  center: ['25%', '50%'],
                  radius: 120,
                  startAngle: 90,
                  splitNumber: 4,
                  shape: 'circle',
                  name: {
                      textStyle: {
                          color:'#72ACD1'
                      }
                  },
                  splitArea: {
                      areaStyle: {
                          color: ['rgba(114, 172, 209, 0.2)',
                          'rgba(114, 172, 209, 0.4)', 'rgba(114, 172, 209, 0.6)',
                          'rgba(114, 172, 209, 0.8)', 'rgba(114, 172, 209, 1)'],
                          shadowColor: 'rgba(0, 0, 0, 0.3)',
                          shadowBlur: 10
                      }
                  },
                  axisLine: {
                      lineStyle: {
                          color: 'rgba(255, 255, 255, 0.5)'
                      }
                  },
                  splitLine: {
                      lineStyle: {
                          color: 'rgba(255, 255, 255, 0.5)'
                      }
                  }
              }
          ],
          series: [
              {
                  name: 'radarmap1',
                  type: 'radar',
                  itemStyle: {
                      emphasis: {
                          // color: 各异,
                          lineStyle: {
                              width: 4
                          }
                      }
                  },
                  data: [

                      {
                          value: [score[0], score[1], score[2], score[3], score[4]],
                          name: 'item2',
                          areaStyle: {
                              normal: {
                                  color: 'rgba(255, 255, 255, 0.5)'
                              }
                          }
                      }
                  ]
              }

          ]


        }
      mychart.setOption(option);
  </script>
</body>
</html>
