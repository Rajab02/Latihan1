<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="./assets/img//logo_unsulbar.png">
  <link rel="icon" type="image/png" href="./assets/img//logo_unsulbar.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Dempster Shafer
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
  <!-- CSS Files -->
  <link href="./assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="./assets/css/paper-kit.css?v=2.2.0" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="./assets/demo/demo.css" rel="stylesheet" />
</head>

<body class="index-page sidebar-collapse">

<?php
  $sPenyakit = "UNDEFINED";
  $sSolusi = "";
  $densitas = "";
  if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $numGejala = 18;
    $arrayGejalaCheck = new SplFixedArray ($numGejala);

    $numChecked = 0;
    for($i=0;$i<$numGejala;$i++){
      if(isset($_POST['g'.$i.'']) &&  $_POST['g'.$i.''] == 'ya') {
        //echo "Gejala $i = ya<br>";
        $arrayGejalaCheck[$i] = 1;
        $numChecked++;
      }else{
        //echo "Gejala $i = tidak<br>";
        $arrayGejalaCheck[$i] = 0;
      }
    }

    $gejala_terdeteksi = new SplFixedArray ($numChecked);
    $n = 0;
    for($i=0;$i<$numGejala;$i++){
      if($arrayGejalaCheck[$i] == 1){
        $gejala_terdeteksi[$n]=$i;
        $n++;
      }
    }
    
    //Jalankan Dempster Shafer
    if($n>0){
      require 'DempsterShafer.php';
      $ds = new DempsterShafer();
      $info = $ds->proses($gejala_terdeteksi);

      $sPenyakit = $info["sPenyakit"];
      $densitas = $info["densitas"];
      $sSolusi = $info["sSolusi"];

    }    

  }
?>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg fixed-top navbar-transparent " color-on-scroll="300">
    <div class="container">
      <div class="navbar-translate">
        <a class="navbar-brand" href="" rel="tooltip" data-placement="bottom" target="_blank">
        </a>
      </div>
          <li class="nav-item">
            <a href="indexx.php" class="btn btn-danger btn-round">HOME</a>
            <a href="hasil.php" class="btn btn-danger btn-round">JENIS GEJALA</a>
            <a href="logout.php" class="btn btn-danger btn-round">KONTAK</a>
            <a href="index.php" class="btn btn-danger btn-round">Log Out</a>
          </li>

    </div>
  </nav>
  <!-- End Navbar -->
  <div>
    <div class="filter"></div>
    <div class="content-center">
      <div class="container">
        <div class="title-brand">
          <div class="fog-low">
            <img src="./assets/img/fog-low.png" alt="">
          </div>
          <div class="fog-low right">
            <img src="./assets/img/fog-low.png" alt="">
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="main">
    <div class="section section-buttons">


      <div class="container">

        <div class="title">
          <h1>JENIS - JENIS GEJALA PADA AYAM PETELUR</h1>
          <h3>1.  Nafsu Makan Berkurang</h3>
          <h3>2.  Layer mati dengan kebiru-biruan pada pial</h3>
          <h3>3.  Layer mati dengan keungu-unguan pada jengger</h3>
          <h3>4.  Keungu-unguan pada tungkai, jari dan telapak kaki</h3>
          <h3>5.  Pendarahan pada Kulit dan akar bulu</h3>
          <h3>6.  Ngorok</h3>
          <h3>7.  Keluar lendir dari hidung</h3>
          <h3>8.  Radang pada mata</h3>
          <h3>9.  Lemah</h3>
          <h3>10. Gangguan Pernafasan</h3>
          <h3>11. Kelumpuhan pada sayap</h3>
          <h3>12. Fases berwarna hijau</h3>
          <h3>13. Tortikolis</h3>
          <h3>14. Penurunan Kuantitas dan kualitas telur</h3>
          <h3>15. Telur ayam berwarna kerabang pucat, tipis, retak, dan lembek</h3>
          <h3>16. Yolk pucat, encer dan kecil</h3>
          <h3>17. Penurunan produksi telur</h3>
          <h3>18. Mata berbuih</h3>
        </div>  
        
          </div>
        </div>
      </div>
    </div>

    <footer class="footer footer-black  footer-white ">
      <div class="container">
        <div class="row">
          <nav class="footer-nav">
            <ul>
              <li>
                <a href="" target="_blank">Program Studi Informatika</a>
              </li>
              <li>
                <a href="" target="_blank">Fakultas Teknik</a>
              </li>
              <li>
                <a href="" target="_blank">Universitas Sulawesi barat</a>
              </li>
            </ul>
          </nav>
          <div class="credits ml-auto">
            <span class="copyright">
              ©
              <script>
                document.write(new Date().getFullYear())
              </script>, SISTEM<i class="fa fa-heart heart"></i> BY ILHAM
            </span>
          </div>
        </div>
      </div>
    </footer>
    <!--   Core JS Files   -->
    <script src="./assets/js/core/jquery.min.js" type="text/javascript"></script>
    <script src="./assets/js/core/popper.min.js" type="text/javascript"></script>
    <script src="./assets/js/core/bootstrap.min.js" type="text/javascript"></script>
    <!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
    <script src="./assets/js/plugins/bootstrap-switch.js"></script>
    <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
    <script src="./assets/js/plugins/nouislider.min.js" type="text/javascript"></script>
    <!--  Plugin for the DatePicker, full documentation here: https://github.com/uxsolutions/bootstrap-datepicker -->
    <script src="./assets/js/plugins/moment.min.js"></script>
    <script src="./assets/js/plugins/bootstrap-datepicker.js" type="text/javascript"></script>
    <!-- Control Center for Paper Kit: parallax effects, scripts for the example pages etc -->
    <script src="./assets/js/paper-kit.js?v=2.2.0" type="text/javascript"></script>
    <!--  Google Maps Plugin    -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
    <script>
      $(document).ready(function() {

        if ($("#datetimepicker").length != 0) {
          $('#datetimepicker').datetimepicker({
            icons: {
              time: "fa fa-clock-o",
              date: "fa fa-calendar",
              up: "fa fa-chevron-up",
              down: "fa fa-chevron-down",
              previous: 'fa fa-chevron-left',
              next: 'fa fa-chevron-right',
              today: 'fa fa-screenshot',
              clear: 'fa fa-trash',
              close: 'fa fa-remove'
            }
          });
        }

        function scrollToDownload() {

          if ($('.section-download').length != 0) {
            $("html, body").animate({
              scrollTop: $('.section-download').offset().top
            }, 1000);
          }
        }
      });
    </script>
</body>

</html>
