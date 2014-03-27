<?php
$altezza = $_GET['a'];
$larghezza = $_GET['l'];
$dim = $_GET['d'];
$counter = $_GET['counter'];
$colore = $_GET['c'];
$sfondo = $_GET['s'];

	$colore = preg_replace(' /[^0-9A-Fa-f]/ ', '', $colore); // Gets a proper hex string
    if (strlen($colore) == 6) { //If a proper hex code, convert using bitwise operation. No overhead... faster
        $coloreVal = hexdec($colore);
        $coloreR = 0xFF & ($coloreVal >> 0x10);
        $coloreG = 0xFF & ($coloreVal >> 0x8);
        $coloreB = 0xFF & $coloreVal;
    } if (strlen($colore) == 3) { //if shorthand notation, need some string manipulations
        $coloreR = hexdec(str_repeat(substr($colore, 0, 1), 2));
        $coloreG = hexdec(str_repeat(substr($colore, 1, 1), 2));
        $coloreB = hexdec(str_repeat(substr($colore, 2, 1), 2));
    }

	$sfondo = preg_replace("/[^0-9A-Fa-f]/", '', $sfondo); // Gets a proper hex string
	if (strlen($sfondo) == 6) { //If a proper hex code, convert using bitwise operation. No overhead... faster
		$sfondoVal = hexdec($sfondo);
		$sfondoR = 0xFF & ($sfondoVal >> 0x10);
		$sfondoG = 0xFF & ($sfondoVal >> 0x8);
		$sfondoB = 0xFF & $sfondoVal;
	} if (strlen($sfondo) == 3) { //if shorthand notation, need some string manipulations
		$sfondoR = hexdec(str_repeat(substr($sfondo, 0, 1), 2));
		$sfondoG = hexdec(str_repeat(substr($sfondo, 1, 1), 2));
		$sfondoB = hexdec(str_repeat(substr($sfondo, 2, 1), 2));
	}
//random seed
mt_srand();
//CREA "CANVAS"
$img = imagecreatetruecolor($larghezza, $altezza);
//crea sfondo
$sfondo0 = imagecolorallocate($img,$sfondoR,$sfondoG,$sfondoB);
imagefilledrectangle($img, 0, 0, $larghezza, $altezza, $sfondo0);
//colore "pennello"
$colore0 = imagecolorallocate($img,$coloreR,$coloreG,$coloreB);


$r=1;
$g=1;
$b=1;
$rt=0;
$gt=0;
$bt=0;

$xi=0;
$xf=$altezza;
$ry=0+($dim/2);
$gy=$altezza/2;
$by=$altezza-($dim/2);
imagesetthickness($img, $dim);

for($i=0;$i<floor($larghezza/$altezza)+1;$i++){

	while($r>0){
		$rnd=intval(mt_rand(1,3));
		if($rnd==1){
			imageLine($img, $xi+$altezza*$i, $ry, $xf+$altezza*$i, $ry, $colore0);
			$rt++;
		}
		else if($rnd==2){
			imageLine($img, $xi+$altezza*$i, $ry, $xf+$altezza*$i, $gy, $colore0);
			$gt++;
		}
		else if($rnd==3){
			imageLine($img, $xi+$altezza*$i, $ry, $xf+$altezza*$i, $by, $colore0);
			$bt++;
		}
		$r--;
	}
	
	while($g>0){
		$rnd=intval(mt_rand(1,3));
		if($rnd==1){
			imageLine($img, $xi+$altezza*$i, $gy, $xf+$altezza*$i, $ry, $colore0);
			$rt++;
		}
		else if($rnd==2){
			imageLine($img, $xi+$altezza*$i, $gy, $xf+$altezza*$i, $gy, $colore0);
			$gt++;
		}
		else if($rnd==3){
			imageLine($img, $xi+$altezza*$i, $gy, $xf+$altezza*$i, $by, $colore0);
			$bt++;
		}
		$g--;
	}
	while($b>0){
		$rnd=intval(mt_rand(1,3));
		if($rnd==1){
			imageLine($img, $xi+$altezza*$i, $by, $xf+$altezza*$i, $ry, $colore0);
			$rt++;
		}
		else if($rnd==2){
			imageLine($img, $xi+$altezza*$i, $by, $xf+$altezza*$i, $gy, $colore0);
			$gt++;
		}
		else if($rnd==3){
			imageLine($img, $xi+$altezza*$i, $by, $xf+$altezza*$i, $by, $colore0);
			$bt++;
		}
		$b--;
	}

	$r=$rt;
	$g=$gt;
	$b=$bt;
	$rt=0;
	$gt=0;
	$bt=0;

}

$counter=$counter;

header("Content-type: image/png");
imagepng($img);
imagedestroy($img);
?>