<?php

require_once "ciacco_twister.php";

use ciacco_PRNG\CiaccoPRNG;

if(isset($_GET['id'])){
	$id=$_GET['id'];
	$id=convBase($id, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ', '0123456789');
	$helm=$armor=$boots=$id;
}else{
	$helm=$_GET['h'];
	$helm=convBase($helm, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ', '0123456789');
	$armor=$_GET['a'];
	$armor=convBase($armor, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ', '0123456789');
	$boots=$_GET['b'];
	$boots=convBase($boots, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ', '0123456789');
}

//$id=RandomCiacco::getRand();
$ygap = 0;
$ystart = 0;
$xstart = 0;
	$pixelsize = $_GET['size'];
	$altezza = 32*$pixelsize;
	$larghezza = 32*$pixelsize;


		$minbkg=30;
		$maxbkg=30;
		$ncol=40;//$ncol=30;//min_colore 0
		$xcol=210;//$xcol=220;//max_colore 255

//CREA "CANVAS"
$img = imagecreatetruecolor($larghezza, $altezza);



//------------------------//
//          BOOTS         //
//------------------------//

//assegnacolori
CiaccoPRNG::seed($boots);
//sfondo=lama,colore=elsa
$sfondoR=CiaccoPRNG::getRand($ncol,$xcol);
$sfondoG=CiaccoPRNG::getRand($ncol,$xcol);
$sfondoB=CiaccoPRNG::getRand($ncol,$xcol);
$coloreR=CiaccoPRNG::getRand($ncol,$xcol);
$coloreG=CiaccoPRNG::getRand($ncol,$xcol);
$coloreB=CiaccoPRNG::getRand($ncol,$xcol);







//TRANSP
$coloresnf = imagecolorallocate($img,255-($sfondoR+$coloreR)/2,255-($sfondoG+$coloreG)/2,255-($sfondoB+$coloreB)/2);
imagefilledrectangle($img, 0, 0, $larghezza, $altezza, $coloresnf);
//imagecolortransparent($img, $coloresnf);









//COLORS
$colore[0][0]=$coloreR;
$colore[1][0]=$coloreG;
$colore[2][0]=$coloreB;
$colore[3][0]=$sfondoR;
$colore[4][0]=$sfondoG;
$colore[5][0]=$sfondoB;
for($c=0; $c<6; $c++){
	$colore[$c][1]=sfumatura(1,$colore[$c][0]);
	$colore[$c][2]=sfumatura(2,$colore[$c][0]);
}
$colore0 = imagecolorallocate($img,$colore[0][0],$colore[1][0],$colore[2][0]);
$sfondo0 = imagecolorallocate($img,$colore[3][0],$colore[4][0],$colore[5][0]);
$colore1 = imagecolorallocate($img,$colore[0][1],$colore[1][1],$colore[2][1]);
$sfondo1 = imagecolorallocate($img,$colore[3][1],$colore[4][1],$colore[5][1]);
$colore2 = imagecolorallocate($img,$colore[0][2],$colore[1][2],$colore[2][2]);
$sfondo2 = imagecolorallocate($img,$colore[3][2],$colore[4][2],$colore[5][2]);

// PANTS
$s='';
$s.='aaaaaaaaaaaaaaaa';
$s.='aaaaaaaaaaaaaaaa';
$s.='aaaaaaaaaaaaaaaa';
$s.='aaaaaaaaaaaaaaao';
$s.='aaaaaaaaaaaaaaoc';
$s.='aaaaaaaaaaaaffff';
$s.='aaaaaaaaaaaaffff';
$s.='aaaaaaaaaaaaffff';
$s.='aaaaaaaaaaaaffff';
$s.='aaaaaaaaaaaaffff';
$s.='aaaaaaaaaaaaffff';
$s.='aaaaaaaaaaaaffff';
$s.='aaaaaaaaaaaaffff';
$s.='aaaaaaaaaaaaffff';
$s.='aaaaaaaaaaaaffff';
$s.='aaaaaaaaaaaaffff';
$s.='aaaaaaaaaaaaffff';
$s.='aaaaaaaaaaaaffff';
$s.='aaaaaaaaaaaaffff';
$s.='aaaaaaaaaaaaffff';
$s.='aaaaaaaaaaaaaaoc';
$s.='aaaaaaaaaaoaaaoc';
$s.='aaaaaaaaaoboaocc';
$s.='aaaaaaaaaaobbbbc';
$s.='aaaaaaaaaaaoobbb';
$s.='aaaaaaaaaaaaaobb';
$s.='aaaaaaaaaaaaaaob';
$s.='aaaaaaaaaaaaaaob';
$s.='aaaaaaaaaaaaaaob';
$s.='aaaaaaaaaaaaaeee';
$s.='aaaaaaaaaaaaaaao';
$s.='aaaaaaaaaaaaaaaa';

//GENERAZIONE IMMAGINE SIMMETRICA
$i=0;
for ($zzz=0; $zzz < strlen($s); $zzz++) {
	if(strcmp($s[$zzz],'f')==0){
		$rnd=CiaccoPRNG::getRand(0,3);
	
		if($rnd==0){
			$s[$zzz]='o';
			$s[++$zzz]='c';
			if(CiaccoPRNG::getRand(0,1)==0) $s[++$zzz]='a';
			else $s[++$zzz]='c';
			if(CiaccoPRNG::getRand(0,1)==0) $s[++$zzz]='c';
			else $s[++$zzz]='o';
		}else if($rnd==1){
			$s[$zzz]='a';
			$s[++$zzz]='o';
			$s[++$zzz]='c';
			$s[++$zzz]='c';
		}else if($rnd==2){
			$s[$zzz]='a';
			$s[++$zzz]='a';
			$s[++$zzz]='o';
			$s[++$zzz]='c';
		}else{
			$s[$zzz]='a';
			$s[++$zzz]='o';
			$s[++$zzz]='c';
			$s[++$zzz]='a';
		}
	}else if(strcmp($s[$zzz],'e')==0){
		$rnd=CiaccoPRNG::getRand(0,2);
	
		if($rnd==0){
			$s[$zzz]='o';
			$s[++$zzz]='b';
			$s[++$zzz]='a';
		}else if($rnd==1){
			$s[$zzz]='a';
			$s[++$zzz]='o';
			$s[++$zzz]='b';
		}else{
			$s[$zzz]='o';
			$s[++$zzz]='a';
			$s[++$zzz]='b';
		}
	}
}
$glowcolor = imagecolorallocatealpha($img_sfondo_glow,$coloreR,$coloreG,$coloreB,0);
if($_GET['invert']==1) $glowcolor = imagecolorallocatealpha($img_sfondo_glow,$sfondoR,$sfondoG,$sfondoB,0);
/*if($_GET['q']==10)*/// vignette($img_sfondo_glow,$glowcolor,50-$asd,(($larghezza/2)+$pixelsize*2-$sinister));

$colorOmbra = imagecolorallocatealpha($img,($sfondoR/100)*40,($sfondoG/100)*40,($sfondoB/100)*40,0);

for($y = $ystart; $y < $altezza/$pixelsize; $y++){
	for($x = $xstart; $x < $larghezza/($pixelsize*2); $x++){
		if($s[$i]=='b'||$s[$i]=='c'||$s[$i]=='o'){
			$diff=intval(CiaccoPRNG::getRand(0,2));
			$f=$larghezza/($pixelsize)-$x-1;

			if($s[$i]=='b'){
				if($diff==0){
					imagefilledrectangle($img, $pixelsize*($x), $pixelsize*($y), $pixelsize+$pixelsize*($x), $pixelsize-1+$pixelsize*($y), $colore0);
					imagefilledrectangle($img, $pixelsize*($f), $pixelsize*($y), $pixelsize+$pixelsize*($f), $pixelsize-1+$pixelsize*($y), $colore0);
				}else if($diff==1){
					imagefilledrectangle($img, $pixelsize*($x), $pixelsize*($y), $pixelsize+$pixelsize*($x), $pixelsize-1+$pixelsize*($y), $colore1);
					imagefilledrectangle($img, $pixelsize*($f), $pixelsize*($y), $pixelsize+$pixelsize*($f), $pixelsize-1+$pixelsize*($y), $colore1);
				}else if($diff==2){
					imagefilledrectangle($img, $pixelsize*($x), $pixelsize*($y), $pixelsize+$pixelsize*($x), $pixelsize-1+$pixelsize*($y), $colore2);
					imagefilledrectangle($img, $pixelsize*($f), $pixelsize*($y), $pixelsize+$pixelsize*($f), $pixelsize-1+$pixelsize*($y), $colore2);
				}
			}
			elseif($s[$i]=='c'){
				if($diff==0){
					imagefilledrectangle($img, $pixelsize*($x), $pixelsize*($y), $pixelsize+$pixelsize*($x), $pixelsize-1+$pixelsize*($y), $sfondo0);
					imagefilledrectangle($img, $pixelsize*($f), $pixelsize*($y), $pixelsize+$pixelsize*($f), $pixelsize-1+$pixelsize*($y), $sfondo0);
				}else if($diff==1){
					imagefilledrectangle($img, $pixelsize*($x), $pixelsize*($y), $pixelsize+$pixelsize*($x), $pixelsize-1+$pixelsize*($y), $sfondo1);
					imagefilledrectangle($img, $pixelsize*($f), $pixelsize*($y), $pixelsize+$pixelsize*($f), $pixelsize-1+$pixelsize*($y), $sfondo1);
				}else if($diff==2){
					imagefilledrectangle($img, $pixelsize*($x), $pixelsize*($y), $pixelsize+$pixelsize*($x), $pixelsize-1+$pixelsize*($y), $sfondo2);
					imagefilledrectangle($img, $pixelsize*($f), $pixelsize*($y), $pixelsize+$pixelsize*($f), $pixelsize-1+$pixelsize*($y), $sfondo2);
				}
			}
			elseif($s[$i]=='o'){
					imagefilledrectangle($img, $pixelsize*($x), $pixelsize*($y), $pixelsize+$pixelsize*($x), $pixelsize-1+$pixelsize*($y), $colorOmbra);
					imagefilledrectangle($img, $pixelsize*($f), $pixelsize*($y), $pixelsize+$pixelsize*($f), $pixelsize-1+$pixelsize*($y), $colorOmbra);
			}
		}$i++;
	}$y = $y+$ygap;
}






// FUNZIONI UTILI //

function sfumatura($s,$val){// $s = sfumatura: 1-scura 2-chiara
		return $val+(30*pow(-1,$s));
}

function vignette($im,$glowcolor,$asd,$sinister) {
    $width = imagesx($im)+$sinister;
    $height = imagesy($im)+$asd*2;

    $effect = function ($x, $y, &$rgb) use($width, $height) {
        $sharp = 6; // 0 - 10 small is sharpnes,
        $level = 1; // 0 - 1 small is brighter
        $l = sin(M_PI/$width*$x)*sin(M_PI/$height*$y);
        $l = pow($l, $sharp);
        $l = 1 - $level * (1 - $l);
        $rgb['alpha'] = 127*(1-$l);
    };
    for($x = 0; $x < $width; ++ $x){
        for($y = 0; $y < $height; ++ $y){
            $rgb = imagecolorsforindex($im, $glowcolor);
            $effect($x, $y, $rgb);
            $color = imagecolorallocatealpha($im, $rgb['red'], $rgb['green'], $rgb['blue'], $rgb['alpha']);
            imagesetpixel($im, $x-$sinister/2, $y-$asd*1.5, $color);
        }
    }
    return (true);
}

function convBase($numberInput, $fromBaseInput, $toBaseInput){
    if ($fromBaseInput==$toBaseInput) return $numberInput;
    $fromBase = str_split($fromBaseInput,1);
    $toBase = str_split($toBaseInput,1);
    $number = str_split($numberInput,1);
    $fromLen=strlen($fromBaseInput);
    $toLen=strlen($toBaseInput);
    $numberLen=strlen($numberInput);
    $retval='';
    if ($toBaseInput == '0123456789')
    {
        $retval=0;
        for ($i = 1;$i <= $numberLen; $i++)
            $retval = bcadd($retval, bcmul(array_search($number[$i-1], $fromBase),bcpow($fromLen,$numberLen-$i)));
        return $retval;
    }
    if ($fromBaseInput != '0123456789')
        $base10=convBase($numberInput, $fromBaseInput, '0123456789');
    else
        $base10 = $numberInput;
    if ($base10<strlen($toBaseInput))
        return $toBase[$base10];
    while($base10 != '0')
    {
        $retval = $toBase[bcmod($base10,$toLen)].$retval;
        $base10 = bcdiv($base10,$toLen,0);
    }
    return $retval;
}



header("Content-type: image/png");
imagepng($img);
imagedestroy($img);
?>
