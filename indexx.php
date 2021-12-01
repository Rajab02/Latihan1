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
        Dempster Shafer
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
  <div class="page-header section-dark" style="background-image: url('./assets/img/antoine-barres.jpg')">
    <div class="filter"></div>
    <div class="content-center">
      <div class="container">
        <div class="title-brand">
          <h1 class="presentation-title" >SISTEM PAKAR</h1>
          <div class="fog-low">
            <img src="./assets/img/fog-low.png" alt="">
          </div>
          <div class="fog-low right">
            <img src="./assets/img/fog-low.png" alt="">
          </div>
        </div>
        <h2 class="presentation-subtitle text-center">PENYAKIT AYAM PETELUR MENGGUNAKAN ALGORITMA DEMPSTER SHAFER</h2>
      </div>
    </div>
    <div class="moving-clouds" style="background-image: url('./assets/img/clouds.png'); "></div>
  </div>
  <div class="main">
    <div class="section section-buttons">


      <div class="container">

        <div class="title">
          <h3>Gejala Terdeteksi</h3>
        </div>  
        <div class="row">
          <div class="col-sm-12 col-lg-12">           
            <form name="form1" id="mainForm" method="post"enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF'];?>">  
              <div class="form-check"><label class="form-check-label"><input class="form-check-input" type="checkbox" name="g0" value="ya">Nafsu Makan Berkurang<span class="form-check-sign"></span></label></div>
              <div class="form-check"><label class="form-check-label"><input class="form-check-input" type="checkbox" name="g1" value="ya">Layer mati dengan kebiru-biruan pada pial<span class="form-check-sign"></span></label></div>
              <div class="form-check"><label class="form-check-label"><input class="form-check-input" type="checkbox" name="g2" value="ya">Layer mati dengan keungu-unguan pada jengger<span class="form-check-sign"></span></label></div>
              <div class="form-check"><label class="form-check-label"><input class="form-check-input" type="checkbox" name="g3" value="ya">Keungu-unguan pada tungkai, jari dan telapak kaki<span class="form-check-sign"></span></label></div>
              <div class="form-check"><label class="form-check-label"><input class="form-check-input" type="checkbox" name="g4" value="ya">Pendarahan pada Kulit dan akar bulu<span class="form-check-sign"></span></label></div>
              <div class="form-check"><label class="form-check-label"><input class="form-check-input" type="checkbox" name="g5" value="ya">Ngorok<span class="form-check-sign"></span></label></div>
              <div class="form-check"><label class="form-check-label"><input class="form-check-input" type="checkbox" name="g6" value="ya">Keluar lendir dari hidung<span class="form-check-sign"></span></label></div>
              <div class="form-check"><label class="form-check-label"><input class="form-check-input" type="checkbox" name="g7" value="ya">Radang pada mata<span class="form-check-sign"></span></label></div>
              <div class="form-check"><label class="form-check-label"><input class="form-check-input" type="checkbox" name="g8" value="ya">Lemah<span class="form-check-sign"></span></label></div>
              <div class="form-check"><label class="form-check-label"><input class="form-check-input" type="checkbox" name="g9" value="ya">Gangguan Pernafasan<span class="form-check-sign"></span></label></div>
              <div class="form-check"><label class="form-check-label"><input class="form-check-input" type="checkbox" name="g10" value="ya">Kelumpuhan pada sayap<span class="form-check-sign"></span></label></div>
              <div class="form-check"><label class="form-check-label"><input class="form-check-input" type="checkbox" name="g11" value="ya">Fases berwarna hijau<span class="form-check-sign"></span></label></div>
              <div class="form-check"><label class="form-check-label"><input class="form-check-input" type="checkbox" name="g12" value="ya">Tortikolis<span class="form-check-sign"></span></label></div>
              <div class="form-check"><label class="form-check-label"><input class="form-check-input" type="checkbox" name="g13" value="ya">Penurunan Kuantitas dan kualitas telur<span class="form-check-sign"></span></label></div>
              <div class="form-check"><label class="form-check-label"><input class="form-check-input" type="checkbox" name="g14" value="ya">Telur ayam berwarna kerabang pucat, tipis, retak, dan lembek<span class="form-check-sign"></span></label></div>
              <div class="form-check"><label class="form-check-label"><input class="form-check-input" type="checkbox" name="g15" value="ya">Yolk pucat, encer dan kecil<span class="form-check-sign"></span></label></div>
              <div class="form-check"><label class="form-check-label"><input class="form-check-input" type="checkbox" name="g16" value="ya">Penurunan produksi telur<span class="form-check-sign"></span></label></div>
              <div class="form-check"><label class="form-check-label"><input class="form-check-input" type="checkbox" name="g17" value="ya">Mata berbuih<span class="form-check-sign"></span></label></div>
              <br/>
              <button type="submit" class="btn btn-info btn-round">Run Proses Dempster Shafer</button>
            </form>
              <br/>
              <div class="form-group">
                <label for="textarea01">Hasil Diagnosa Penyakit</label>
                <textarea class="form-control" id="textarea01" rows="3"><?= $sPenyakit ?></textarea>
              </div>
              <div class="form-group">
                <label for="textarea01">Bobot</label>
                <textarea class="form-control" id="textarea01" rows="1"><?= $densitas; ?></textarea>
              </div>
              <div class="form-group">
                <label for="textarea01">Solusi</label>
                <textarea class="form-control" id="textarea01" rows="3"><?= $sSolusi; ?></textarea>
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
