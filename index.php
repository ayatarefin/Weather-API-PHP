<?php
$status="";
if(isset($_POST['submit'])){
  $city=$_POST['city'];
  $url="https://api.openweathermap.org/data/2.5/forecast?q=$city,&appid=e80cdfc514efe33416a30734b0b2a109";
  $ch=curl_init();
  curl_setopt($ch,CURLOPT_URL,$url);
  curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
  $result=curl_exec($ch);
  curl_close($ch);
  $result=json_decode($result,true);
  $current_data = $result['list'][0];
  $selected_data = [$current_data];

  for ($i = 8; $i < 40; $i += 8) {
    $selected_data[] = $result['list'][$i];
  }
  // Select data for Friday and Saturday
  $friday_data = $selected_data[1];
  $saturday_data = $selected_data[2];
  $status="yes";
// echo '<pre>';
// print_r($result);
// die();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
<div class="container">
  <div class="row justify-content-center mt-5">
    <div class="col-xl-12 mt-5 mb-3">
      <form method="POST">
        <div class="input-group mb-3">
          <input class="mb-3" type="text" name="city" class="form" placeholder="Enter City Name" aria-label="Another location">
          <div class="input-group-append">
            <button type="submit" name="submit" class="btn btn-secondary mb-3"><i>Search</i></button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<?php if($status=="yes"){?>
<div class="container-fluid px-1 px-sm-3 py-2 mx-auto">
    <div class="row d-flex justify-content-center">
        <div class="row card0">
            <div class="card1 col-sm-4 col-sm-5 mb-5 mt-5 py-3">
                <small>OpenWeatherMap</small>
                <div class="text-center">
                    <img class="image mt-5" src="sidewall.jpg">
                </div>
                <div class="row px-3 mt-5 mb-3">
  <h1 class="large-font mr-3"><?php echo round($result['list'][0]['main']['temp']-273.15)?>&deg;</h1>
  <div class="d-flex flex-column mr-3">
    <h2 class="mt-3 mb-0"><?php echo $result['city']['name']?></h2>
    <?php
      $current_time = strtotime($result['list'][0]['dt_txt']);
      $next_time = strtotime('+3 hours', $current_time);
    ?>
    <strong><?php echo date('h:i A', $next_time) ?> - <?php
      $dateString = date('l, d M', $next_time);
      echo $dateString; ?>
    </strong>
  </div>
  <div class="d-flex flex-row">
    <div class="weatherIcon">
      <img src="http://openweathermap.org/img/wn/<?php echo $result['list'][0]['weather'][0]['icon']?>@2x.png"/>
    </div>
    <div class="large-font mr-3">
      <?php echo $result['list'][0]['weather'][0]['main']?>
    </div>
  </div>
</div>

            </div>
            <div class="card2 col-md-7 col-sm-7 mt-5">

            <div class="container">
    <div class="card" style="border-radius: 25px; border-color: #E5BA73;">
        <div class="card-body my-2">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="row justify-content-center text-center small">
                        <div class="col">
                            <p class=""><strong>
                                    <?php echo round($saturday_data['main']['temp'] - 273.15) ?>&deg;
                                </strong></p>
                            <div class="weatherIcon mb-3">
                                <img
                                    src="http://openweathermap.org/img/wn/<?php echo $saturday_data['weather'][0]['icon'] ?>@2x.png" />
                            </div>
                            <p class="mb-0"><strong>
                                    Saturday
                                </strong></p>
                        </div>
                        <div class="col">
                            <p class=""><strong>
                                    <?php echo round($result['list'][0]['main']['temp']-273.15)?>&deg;
                                </strong></p>
                            <div class="weatherIcon mb-3">
                                <img
                                    src="http://openweathermap.org/img/wn/<?php echo $result['list'][0]['weather'][0]['icon']?>@2x.png" />
                            </div>
                            <p class="mb-0"><strong>
                                    <?php
                                          $dateString = date('l', $result['list'][0]['dt']);
                                          echo $dateString; ?>
                                </strong></p>
                        </div>
                        <div class="col">
                            <p class=""><strong>
                                    <?php echo round($result['list'][9]['main']['temp']-273.15)?>&deg;
                                </strong></p>
                            <div class="weatherIcon mb-3">
                                <img
                                    src="http://openweathermap.org/img/wn/<?php echo $result['list'][9]['weather'][0]['icon']?>@2x.png" />
                            </div>
                            <p class="mb-0"><strong>
                                    <?php
                                          $dateString = date('l', $result['list'][9]['dt']);
                                          echo $dateString; ?>
                                </strong></p>
                        </div>
                        <div class="col">
                            <p class=""><strong>
                                    <?php echo round($result['list'][17]['main']['temp']-273.15)?>&deg;
                                </strong></p>
                            <div class="weatherIcon mb-3">
                                <img
                                    src="http://openweathermap.org/img/wn/<?php echo $result['list'][17]['weather'][0]['icon']?>@2x.png" />
                            </div>
                            <p class="mb-0"><strong>
                                    <?php
                                          $dateString = date('l', $result['list'][17]['dt']);
                                          echo $dateString; ?>
                                </strong></p>
                        </div>
                        <div class="col">
                            <p class=""><strong>
                                    <?php echo round($result['list'][25]['main']['temp']-273.15)?>&deg;
                                </strong></p>
                            <div class="weatherIcon mb-3">
                                <img
                                    src="http://openweathermap.org/img/wn/<?php echo $result['list'][25]['weather'][0]['icon']?>@2x.png" />
                            </div>
                            <p class="mb-0"><strong>
                                    <?php
                                          $dateString = date('l', $result['list'][25]['dt']);
                                          echo $dateString; ?>
                                </strong></p>
                        </div>
                        <div class="col">
                            <p class=""><strong>
                                    <?php echo round($result['list'][33]['main']['temp']-273.15)?>&deg;
                                </strong></p>
                            <div class="weatherIcon mb-3">
                                <img
                                    src="http://openweathermap.org/img/wn/<?php echo $result['list'][33]['weather'][0]['icon']?>@2x.png" />
                            </div>
                            <p class="mb-0"><strong>
                                    <?php
                                          $dateString = date('l', $result['list'][33]['dt']);
                                          echo $dateString; ?>
                                </strong></p>
                        </div>
                        <div class="col">
                            <p class=""><strong>
                                    <?php echo round($friday_data['main']['temp'] - 273.15) ?>&deg;
                                </strong></p>
                            <div class="weatherIcon mb-3">
                                <img
                                    src="http://openweathermap.org/img/wn/<?php echo $friday_data['weather'][0]['icon'] ?>@2x.png" />
                            </div>
                            <p class="mb-0"><strong>
                                    Friday
                                </strong></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
                      <div class="line my-5"></div>

                      <p><strong>Weather Details</strong></p>
                      <div class="row px-3">
                        <!-- <i class="fas fa-cloud light-text-icon"></i> -->
                        <p class="light-text"><strong>Cloudy</strong></p>
                        <p class="ml-auto"><?php echo $result['list'][1]['clouds']['all']?>%</p>
                    </div>
                      <div class="row px-3">
                          <p class="light-text"><strong>Humidity</strong></p>
                          <p class="ml-auto"><?php echo round($result['list'][1]['main']['humidity'])?>%</p>
                      </div>
                      <div class="row px-3">
                          <p class="light-text"><strong>Wind</strong></p>
                          <p class="ml-auto"><?php echo $result['list'][1]['wind']['speed']?> Km/h</p>
                      </div>
                      <div class="row px-3">
                          <p class="light-text"><strong>Rain</strong></p>
                          <p class="ml-auto"><?php echo $result['list'][1]['pop']?> mm</p></p>
                      </div>
  
                      <div class="line mt-3"></div>
            </div>
        </div>
    </div>
</div>
<?php }?>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</body>
</html>