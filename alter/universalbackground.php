<?php

$altezza = $_GET['altezza'];
$larghezza = $_GET['larghezza'];
$pixelsize = $_GET['pixelsize'];
$ygap = $_GET['ygap'];
$ystart = $_GET['ystart'];
$xstart = $_GET['xstart'];
$colore = $_GET['colore'];
$sfondo = $_GET['sfondo'];
$probvuoto = $_GET['probvuoto'];
$probpieno = $_GET['probpieno'];
$counter = $_GET['counter'];
	
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
//VARIABILI 
/*
$altezza = 1280;
$larghezza = 256;
$pixelsize = 8; //deve essere un divisore sia dell'altezza che della larghezza
$ygap = 0;
$ystart = 0;
$xstart = 0;

$probvuoto = 50;
$probpieno = 60;
*/
//random seed

mt_srand();
//CREA "CANVAS"
$img = imagecreatetruecolor($larghezza, $altezza);
//COLORS
$colore0 = imagecolorallocate($img,$coloreR,$coloreG,$coloreB);
$sfondo0 = imagecolorallocate($img,$sfondoR,$sfondoG,$sfondoB);
$colore1 = imagecolorallocate($img,$coloreR,$coloreB,$coloreG);
$sfondo1 = imagecolorallocate($img,$sfondoR,$sfondoB,$sfondoG);
$colore2 = imagecolorallocate($img,$coloreG,$coloreR,$coloreB);
$sfondo2 = imagecolorallocate($img,$sfondoG,$sfondoR,$sfondoB);
$colore3 = imagecolorallocate($img,$coloreG,$coloreB,$coloreR);
$sfondo3 = imagecolorallocate($img,$sfondoG,$sfondoB,$sfondoR);
$colore4 = imagecolorallocate($img,$coloreB,$coloreR,$coloreG);
$sfondo4 = imagecolorallocate($img,$sfondoB,$sfondoR,$sfondoG);
$colore5 = imagecolorallocate($img,$coloreB,$coloreG,$coloreR);
$sfondo5 = imagecolorallocate($img,$sfondoB,$sfondoG,$sfondoR);
//SFONDO

//COSTRUZIONE STRINGA 0
$i=0;
for($y = 0; $y < $larghezza; $y++){
	for($x = 0; $x < $altezza; $x++){
		$s.='0';
		$i++;
	}
}
//GENERAZIONE IMMAGINE SIMMETRICA
$i=0;
for($y = $ystart; $y < $altezza/$pixelsize; $y++){
	for($x = $xstart; $x < $larghezza/($pixelsize*2); $x++){
		
		$r=mt_rand(0,100);
		$f=$larghezza/($pixelsize)-$x-1;
		
		$diff=intval(mt_rand(0,5));
	
		
		if($s[$i]=='1'){
			if($diff==0){
				imagefilledrectangle($img, $pixelsize*($x), $pixelsize*($y), $pixelsize+$pixelsize*($x), $pixelsize-1+$pixelsize*($y), $colore0);
				imagefilledrectangle($img, $pixelsize*($f), $pixelsize*($y), $pixelsize+$pixelsize*($f), $pixelsize-1+$pixelsize*($y), $colore0);
			}
			if($diff==1){
				imagefilledrectangle($img, $pixelsize*($x), $pixelsize*($y), $pixelsize+$pixelsize*($x), $pixelsize-1+$pixelsize*($y), $colore1);
				imagefilledrectangle($img, $pixelsize*($f), $pixelsize*($y), $pixelsize+$pixelsize*($f), $pixelsize-1+$pixelsize*($y), $colore1);
			}
			if($diff==2){
				imagefilledrectangle($img, $pixelsize*($x), $pixelsize*($y), $pixelsize+$pixelsize*($x), $pixelsize-1+$pixelsize*($y), $colore2);
				imagefilledrectangle($img, $pixelsize*($f), $pixelsize*($y), $pixelsize+$pixelsize*($f), $pixelsize-1+$pixelsize*($y), $colore2);
			}
			if($diff==3){
				imagefilledrectangle($img, $pixelsize*($x), $pixelsize*($y), $pixelsize+$pixelsize*($x), $pixelsize-1+$pixelsize*($y), $colore3);
				imagefilledrectangle($img, $pixelsize*($f), $pixelsize*($y), $pixelsize+$pixelsize*($f), $pixelsize-1+$pixelsize*($y), $colore3);
			}
			if($diff==4){
				imagefilledrectangle($img, $pixelsize*($x), $pixelsize*($y), $pixelsize+$pixelsize*($x), $pixelsize-1+$pixelsize*($y), $colore4);
				imagefilledrectangle($img, $pixelsize*($f), $pixelsize*($y), $pixelsize+$pixelsize*($f), $pixelsize-1+$pixelsize*($y), $colore4);
			}
			if($diff==5){
				imagefilledrectangle($img, $pixelsize*($x), $pixelsize*($y), $pixelsize+$pixelsize*($x), $pixelsize-1+$pixelsize*($y), $colore5);
				imagefilledrectangle($img, $pixelsize*($f), $pixelsize*($y), $pixelsize+$pixelsize*($f), $pixelsize-1+$pixelsize*($y), $colore5);
			}
		}
		if($s[$i]=='0'){
			if($diff==0){
				imagefilledrectangle($img, $pixelsize*($x), $pixelsize*($y), $pixelsize+$pixelsize*($x), $pixelsize-1+$pixelsize*($y), $sfondo0);
				imagefilledrectangle($img, $pixelsize*($f), $pixelsize*($y), $pixelsize+$pixelsize*($f), $pixelsize-1+$pixelsize*($y), $sfondo0);
			}
			if($diff==1){
				imagefilledrectangle($img, $pixelsize*($x), $pixelsize*($y), $pixelsize+$pixelsize*($x), $pixelsize-1+$pixelsize*($y), $sfondo1);
				imagefilledrectangle($img, $pixelsize*($f), $pixelsize*($y), $pixelsize+$pixelsize*($f), $pixelsize-1+$pixelsize*($y), $sfondo1);
			}
			if($diff==2){
				imagefilledrectangle($img, $pixelsize*($x), $pixelsize*($y), $pixelsize+$pixelsize*($x), $pixelsize-1+$pixelsize*($y), $sfondo2);
				imagefilledrectangle($img, $pixelsize*($f), $pixelsize*($y), $pixelsize+$pixelsize*($f), $pixelsize-1+$pixelsize*($y), $sfondo2);
			}
			if($diff==3){
				imagefilledrectangle($img, $pixelsize*($x), $pixelsize*($y), $pixelsize+$pixelsize*($x), $pixelsize-1+$pixelsize*($y), $sfondo3);
				imagefilledrectangle($img, $pixelsize*($f), $pixelsize*($y), $pixelsize+$pixelsize*($f), $pixelsize-1+$pixelsize*($y), $sfondo3);
			}
			if($diff==4){
				imagefilledrectangle($img, $pixelsize*($x), $pixelsize*($y), $pixelsize+$pixelsize*($x), $pixelsize-1+$pixelsize*($y), $sfondo4);
				imagefilledrectangle($img, $pixelsize*($f), $pixelsize*($y), $pixelsize+$pixelsize*($f), $pixelsize-1+$pixelsize*($y), $sfondo4);
			}
			if($diff==5){
				imagefilledrectangle($img, $pixelsize*($x), $pixelsize*($y), $pixelsize+$pixelsize*($x), $pixelsize-1+$pixelsize*($y), $sfondo5);
				imagefilledrectangle($img, $pixelsize*($f), $pixelsize*($y), $pixelsize+$pixelsize*($f), $pixelsize-1+$pixelsize*($y), $sfondo5);
			}
		}
		if($s[$i]=='0' && $r<$probvuoto)
			$s[++$i]='1';
		if($s[$i]=='0' && $r>$probvuoto)
			$s[++$i]='0';
		if($s[$i]==1 && $r<$probpieno)
			$s[++$i]='1';
		if($s[$i]==1 && $r>$probpieno)
			$s[++$i]='0';
	}
	$y = $y+$ygap;
}

$counter=$counter;

header("Content-type: image/png");
imagepng($img);
imagedestroy($img);
?>