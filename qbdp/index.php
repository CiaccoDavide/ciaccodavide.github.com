<?php
$altezza = '90';
$larghezza = '90';
$dim = 3;
$ygap = $_GET['ygap'];
$ystart = $_GET['ystart'];
$xstart = $_GET['xstart'];
$colore = '333333';
$sfondo = 'e3e3e3';

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


$xi=0;
$xf=$larghezza;
$ry=0+($dim/2);
$gy=$altezza/2;
$by=$altezza-($dim/2);
imagesetthickness($img, $dim);

$rnd=intval(mt_rand(1,3));
if($rnd==1)
	imageLine($img, $xi, $ry, $xf, $ry, $colore0);
else if($rnd==2)
	imageLine($img, $xi, $ry, $xf, $gy, $colore0);
else if($rnd==3)
	imageLine($img, $xi, $ry, $xf, $by, $colore0);

$rnd=intval(mt_rand(1,3));
if($rnd==1)
	imageLine($img, $xi, $gy, $xf, $ry, $colore0);
else if($rnd==2)
	imageLine($img, $xi, $gy, $xf, $gy, $colore0);
else if($rnd==3)
	imageLine($img, $xi, $gy, $xf, $by, $colore0);
	
$rnd=intval(mt_rand(1,3));
if($rnd==1)
	imageLine($img, $xi, $by, $xf, $ry, $colore0);
else if($rnd==2)
	imageLine($img, $xi, $by, $xf, $gy, $colore0);
else if($rnd==3)
	imageLine($img, $xi, $by, $xf, $by, $colore0);






header("Content-type: image/png");
imagepng($img);
imagedestroy($img);
?>