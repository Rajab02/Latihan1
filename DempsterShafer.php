<?php
class DempsterShafer {
    //LIST GEJALA
    public $gejala = array(
        "Nafsu Makan Berkurang",
        "Layer mati dengan kebiru-biruan pada pial",
        "Layer mati dengan keungu-unguan pada jengger",
        "Keungu-unguan pada tungkai, jari dan telapak kaki",
        "Pendarahan pada Kulit dan akar bulu",
        "Ngorok",
        "Keluar lender dari hidung",
        "Radang pada mata",
        "Lemah",
        "Gangguan Pernafasan",
        "Kelumpuhan pada sayap",
        "Fases berwarna hijau",
        "Tortikolis",
        "Penurunan Kuantitas dan kualitas telur",
        "Telur ayam berwarna kerabang pucat, tipis, retak, dan lembek",
        "Yolk pucat, encer dan kecil",
        "Penurunan produksi telur",
        "Mata berbuih",
    );
        
    //LIST  PENYAKIT
    public $penyakit = array(
        "Flu Burung (Avian Influenza)",
        "Chronic Respiratory Disease (CRD)",
        "Newcastle Disease (ND)",
        "Egg Drop Syndrome-76 (EDS-76)"
    );

    //SOLUSI PENYAKIT
    public $solusi_penyakit = array(
        "Vaksinasi, Biosekuriti, dan manajemen pemeliharaan",
        "Sanitasi, desindeksi peralatan peternakan dan pisahkan ayam  muda dengan ayam tua",
        "Penerapan biosecurity, vaksinasi secara tepat dan pemberian vitamin rutin",
        "Vaksinasi, sanitasi kandang, desinfeksi kandang, desinfeksi air minum, pembatasan tamu yang masuk ke arena kandang dan melakukan dipping (pencelupan)"
    );
        
    //ARRAY GEJALA PENYAKIT & ARRAY BOBOT PENYAKIT
    public $gejala_penyakit= array(
        array(1,1,1,1),
        array(1,0,0,0),
        array(1,0,0,0),
        array(1,0,0,0),
        array(1,0,0,0),
        array(0,1,0,0),
        array(0,1,0,0),
        array(1,1,0,0),
        array(1,1,1,1),
        array(0,0,1,0),
        array(0,0,1,0),
        array(0,0,1,0),
        array(0,0,1,0),
        array(0,0,0,1),
        array(0,0,0,1),
        array(0,0,0,1),
        array(0,0,0,1),
        array(1,0,0,0)
    );
    
    //array bobot_gejala = m {penyakit} pada gejala G
    public $bobot_gejala= array(
        0.50,
        0.75,
        0.75,
        0.50,
        0.75,
        0.75,
        0.50,
        0.50,
        0.50,
        0.75,
        0.75,
        0.50,
        0.75,
        0.50,
        0.75,
        0.50,
        0.50,
        0.50
    );
    
    function hasilIrisan($gejalaPenyakitA,$gejalaPenyakitB){
        $result; 
        $lenA = count($gejalaPenyakitA);
        $lenB = count($gejalaPenyakitB);    
        if($lenA == $lenB){
            $result = new SplFixedArray($lenA);
            for($i=0;$i<$lenA;$i++){
                if($gejalaPenyakitA[$i]==1 && $gejalaPenyakitB[$i]==1 &&$gejalaPenyakitA[$i]==$gejalaPenyakitB[$i]){
                    $result[$i] = 1;
                }else{
                    $result[$i] = 0;
                }
            }
    
        }
        return $result;
    }
        
    function hitungNilaiDensitas($arrayDensitas1, $arrayDensitas2){
        $numRowDensitas1 = count($arrayDensitas1);
        $numRowDensitas2 = count($arrayDensitas2);
        $matriksHasilKali = new SplFixedArray ($numRowDensitas1);
        for($i=0;$i<$numRowDensitas1;$i++){
            $matriksHasilKali[$i]=new SplFixedArray ($numRowDensitas2);
            for($j=0;$j<$numRowDensitas2;$j++){
                $label1 = $arrayDensitas1[$i][0];//echo "M1 [".$label1[0].$label1[1].$label1[2].$label1[3]."], ";
                $bobot1 = $arrayDensitas1[$i][1];//echo "".$bobot1."<br>";
    
                $label2 = $arrayDensitas2[$j][0];//echo "M2 [".$label2[0].$label2[1].$label2[2].$label2[3]."], ";
                $bobot2 = $arrayDensitas2[$j][1];//echo "".$bobot2."<br>";
    
                $label3 = $this->hasilIrisan($label1,$label2);//echo "M3 [".$label3[0].$label3[1].$label3[2].$label3[3]."], ";
                $bobot3 = $bobot1 * $bobot2;//echo "".$bobot3."<br>";
    
                $matriksHasilKali[$i][$j] = array($label3,$bobot3);
                //echo "<br><br>";
            }
        }
        return $matriksHasilKali;
    }
    
    function isKosong($penyakit){
        $status = false;
        $len = count($penyakit);
        $kosong = 0;
        for($i=0;$i<$len;$i++){
            if($penyakit[$i]==0){
                $kosong++;
            }
        }
        if($kosong==$len){
            $status = true;
        }
        return $status;
    }
    
    function samakah($label1, $label2){
        $ada = false;
        $l1 = count($label1);
        $l2 = count($label2);
        if($l1=$l2){
            $ada = true;
            for($i=0;$i<$l1;$i++){
                if($label1[$i]!=$label2[$i]){
                    $ada = false;
                    break;
                }
            }
        }
        return $ada;
    }
    
    function rekonstruksiHasilKaliBobot($matrikshasilKaliDensitas){
        $l1 = count($matrikshasilKaliDensitas);
        $l2 = count($matrikshasilKaliDensitas[0]);
        $temp_result = new SplFixedArray ($l1*$l2);
        $pengurang = 0;
        $num_penyakit = count($matrikshasilKaliDensitas[0][0][0]);
        $pengurang = 0;
        for($i=0;$i<$num_penyakit;$i++){$kosong[$i]=0;}
        $n = 0;
        for($i=0;$i<$l1;$i++){
            for($j=0;$j<$l2;$j++){
                $label = $matrikshasilKaliDensitas[$i][$j][0];
                $bobot = $matrikshasilKaliDensitas[$i][$j][1];
                //cho "TRACE: "."M [".$label[0].$label[1].$label[2].$label[3]."], ";
                //echo "".$bobot."<br>";
                if($this->isKosong($label)){
                    $pengurang = $pengurang + $bobot;
                }else{
                    //cek kesamaan dengan label yang telah dimasukkan sebelumnya
                    $h = -1;
                    for($k=0;$k<$n;$k++){
                        $sama = $this->samakah($temp_result[$k][0], $label);
                        if($sama){
                            $h = $k;
                            break;
                        }                    
                    }
                    if($h>=0){
                        $temp_bobot = $temp_result[$h][1];
                        $temp_result[$h]=array($label,$temp_bobot+$bobot);
                    }else{
                        $temp_result[$n]=array($label,$bobot);
                        $n++;
                    }                
                }
            }
        }

        //SUSUN DESNSITAS BARU
        $result = new SplFixedArray ($n);
        $penyebut = 1 - $pengurang;
        for($i=0;$i<$n;$i++){
            $label = $temp_result[$i][0];
            $bobot = $temp_result[$i][1];
            $new_bobot = $bobot/$penyebut;
            $result[$i]=array($label, $new_bobot);
        }
        return $result;
    }
    
    function densitasTerbesar($densitas){
        $n = -1;
        $MAX_BOBOT = -9999;
        for($i=0;$i<count($densitas);$i++){
            if($densitas[$i][1]>$MAX_BOBOT){
                $MAX_BOBOT = $densitas[$i][1];
                $n = $i;
            }
        }
        $result = -1;
        if($n>=0){
            $result = $densitas[$n];
        }
        return $result;
    }
    
    function getPenyakit($label){
        $first = true;
        $labelPenyakit = "";
        for($i=0;$i<count($label);$i++){            
            if($label[$i]==1){
                if($first){
                    $labelPenyakit = $labelPenyakit .  $this->penyakit[$i];
                    $first = false;
                }else{
                    $labelPenyakit = $labelPenyakit ." | ".  $this->penyakit[$i];                    
                }
                
            }
        }
        $labelPenyakit = "[ ".$labelPenyakit ." ]";
        return $labelPenyakit;
    }
    
    function getSolusi($label){
        $first = true;
        $labelSolusi = "";
        for($i=0;$i<count($label);$i++){            
            if($label[$i]==1){
                if($first){
                    $labelSolusi = $labelSolusi .  $this->solusi_penyakit[$i];
                    $first = false;
                }else{
                    $labelSolusi = $labelSolusi ." | ".  $this->solusi_penyakit[$i];                    
                }
                
            }
        }
        $labelSolusi = "[ ".$labelSolusi ." ]";
        return $labelSolusi;
    }
    
    //Gejala = array(1, 4, 2, 7)
    //function proses($gejala_terdeteksi, $penyakit, $gejala_penyakit, $bobot_gejala){
    function proses($gejala_terdeteksi){
        $numGejalaTerdeteksi    = count($gejala_terdeteksi);
        $num_penyakit           = count($this->penyakit);
        $labelTeta              = new SplFixedArray($num_penyakit);
        for($i=0;$i<$num_penyakit;$i++){$labelTeta[$i]=1;}
    
        //Untuk gejala pertama
        $index1         = $gejala_terdeteksi[0];
        $M1_label       = $this->gejala_penyakit[$index1];
        $M1_bobot       = $this->bobot_gejala[$index1];
        $M1teta_label   = $labelTeta;
        $M1teta_bobot   = 1-$M1_bobot;
        $M1             = array(array($M1_label,$M1_bobot),array($M1teta_label,$M1teta_bobot));
    
        //inisialisasi $M menggunakan $M1
        $M = $M1;
    
        for($g=1;$g<$numGejalaTerdeteksi;$g++){
            //Untuk gejala berikutnya
            $index2         = $gejala_terdeteksi[$g];
            $M2_label       = $this->gejala_penyakit[$index2];
            $M2_bobot       = $this->bobot_gejala[$index2];
            $M2teta_label   = $labelTeta;
            $M2teta_bobot   = 1-$M2_bobot;
            $M2             = array(array($M2_label,$M2_bobot),array($M2teta_label,$M2teta_bobot));
    
            //Lakukan perkalian Densitas untuk mendapatkan Densitas yang baru selama masih ada gejala terdeteksi
            $M3= $this->hitungNilaiDensitas($M, $M2);
            $M = $this->rekonstruksiHasilKaliBobot($M3);
            //echo "BOSQ";
        }
    
        $densitas           = $M;
        $densitas_terbesar  = $this->densitasTerbesar($densitas);
    
        $penyakit_terdeteksi        = $densitas_terbesar[0];
        $bobot_penyakit_terdeteksi  = $densitas_terbesar[1];

        //echo "<br>PENYAKIT TERDETEKSI:<br>";
        $sPenyakit = $this->getPenyakit($penyakit_terdeteksi);           
        $sSolusi = $this->getSolusi($penyakit_terdeteksi);   
        //echo $sPenyakit;
        $info = array(
            "sPenyakit"=>$sPenyakit,
            "densitas"=>$bobot_penyakit_terdeteksi,
            "sSolusi"=>$sSolusi,
        );
        return $info;
    }
}
?>