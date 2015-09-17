<?php
$id=$_GET['id'];
$ygap = 0;
$ystart = 0;
$xstart = 0;
	$pixelsize = 2;
	$altezza = 100*$pixelsize;
	$larghezza = 40*$pixelsize;

mt_srand($id);

		$minbkg=30;
		$maxbkg=30;
		$ncol=40;//$ncol=30;//min_colore 0
		$xcol=210;//$xcol=220;//max_colore 255

//CREA "CANVAS"
$img_sfondo_glow = imagecreatetruecolor($larghezza, $altezza);
$img_sfondo = imagecreatetruecolor($larghezza, $altezza);
$img_mid = imagecreatetruecolor($larghezza, $altezza);
$img = imagecreatetruecolor($larghezza, $altezza);

//assegnacolori
//sfondo=lama,colore=elsa
$sfondoR=mt_rand($ncol,$xcol);
$sfondoG=mt_rand($ncol,$xcol);
$sfondoB=mt_rand($ncol,$xcol);
$coloreR=mt_rand($ncol,$xcol);
$coloreG=mt_rand($ncol,$xcol);
$coloreB=mt_rand($ncol,$xcol);

//TRANSP
$coloresnf = imagecolorallocate($img_sfondo,30,30,30);
imagefilledrectangle($img_sfondo_glow, 0, 0, $larghezza, $altezza, $coloresnf);
imagecolortransparent($img_sfondo_glow, $coloresnf);

$coloresnf = imagecolorallocate($img_sfondo,30,30,30);
imagefilledrectangle($img_sfondo, 0, 0, $larghezza, $altezza, $coloresnf);
//imagecolortransparent($img_sfondo, $coloresnf);
$coloresnf = imagecolorallocate($img_mid,100,100,100);
imagefilledrectangle($img_mid, 0, 0, $larghezza, $altezza, $coloresnf);
imagecolortransparent($img_mid, $coloresnf);
$coloresnf = imagecolorallocate($img,100,100,100);
imagefilledrectangle($img, 0, 0, $larghezza, $altezza, $coloresnf);
imagecolortransparent($img, $coloresnf);




$cinvR=mt_rand($minbkg,$maxbkg);
$cinvG=mt_rand($minbkg,$maxbkg);
$cinvB=mt_rand($minbkg,$maxbkg);
$coloreinv = imagecolorallocate($img_sfondo,$cinvR,$cinvG,$cinvB);
//imagefilledrectangle($img_sfondo, 0, 0, $larghezza, $altezza, $coloreinv);
$cinvR=mt_rand($minbkg,$maxbkg);
$cinvG=mt_rand($minbkg,$maxbkg);
$cinvB=mt_rand($minbkg,$maxbkg);
$coloreinv = imagecolorallocate($img_sfondo,$cinvR,$cinvG,$cinvB);
//imagefilledrectangle($img_sfondo, 0, 71*$pixelsize, $larghezza, $altezza, $coloreinv);

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
function sfumatura($s,$val){// $s = sfumatura: 1-scura 2-chiara
		return $val+(30*pow(-1,$s));
}
$black = imagecolorallocate($img_sfondo_glow,0,0,0);
$white = imagecolorallocate($img_mid,255,255,255);
$white_text = imagecolorallocate($img,255,255,255);
$colore0 = imagecolorallocate($img,$colore[0][0],$colore[1][0],$colore[2][0]);
$sfondo0 = imagecolorallocate($img,$colore[3][0],$colore[4][0],$colore[5][0]);
$colore1 = imagecolorallocate($img,$colore[0][1],$colore[1][1],$colore[2][1]);
$sfondo1 = imagecolorallocate($img,$colore[3][1],$colore[4][1],$colore[5][1]);
$colore2 = imagecolorallocate($img,$colore[0][2],$colore[1][2],$colore[2][2]);
$sfondo2 = imagecolorallocate($img,$colore[3][2],$colore[4][2],$colore[5][2]);

//mt_srand($id);
$s='';
//COSTRUZIONE STRINGA 0
for($bs=0;$bs<$larghezza*$altezza;$bs++)$s.='a';
//GENERAZIONE IMMAGINE SIMMETRICA
$i=0;
		//GENERAZIONE ELSA
		$tx=$larghezza/($pixelsize*2)-1;
		$ty=($altezza/$pixelsize)-mt_rand(2,20);
		while($ty>70){
			$s[$tx+($larghezza/($pixelsize*2))*$ty]='b';
			$dis=100;
			$div=4;
			$r=mt_rand(0,$dis);
			if($r<($dis/$div)){//destra
				if($tx<$larghezza/($pixelsize*2)-1) $tx++;
			}else if($r>40&&$r<($dis/$div)*2){//sinistra
				if($tx>0) $tx--;
			}else if($r<($dis/$div)*4){//su
				if($ty>0) $ty--;
			}
		}//LAMA
		$asd=mt_rand(0,36);
		$sinister=$larghezza/2;
		while($ty>$asd){
			$f=$tx+($larghezza/($pixelsize*2))*$ty;
			$s[$f]='c';
			if($tx<$larghezza/4-3){$f+=2;$s[$f]='c';}

			while($f-($larghezza/($pixelsize*2))*$ty<$larghezza/(2*$pixelsize)-1){$f++;$s[$f]='c';}//riempie

			$dis=100;
			$div=4;
			$r=mt_rand(0,$dis);
			if($r<($dis/$div)){//destra
				if($tx<$larghezza/($pixelsize*2)-1) $tx++;
			}else if($r<($dis/$div)*2&&$r>30&&$ty>8+$asd){//sinistra
				if($tx>3&&$ty>$asd+10) $tx--;
			}else if($r<($dis/$div)*4){//su
				if($ty>$asd+10) $ty--; else if($tx>5)$ty--;
			}
			//get max width
			if($tx*$pixelsize<$sinister)$sinister=$tx*$pixelsize;
		}
//disegna




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
$glowcolor = imagecolorallocatealpha($img_sfondo_glow,$coloreR,$coloreG,$coloreB,0);
if($_GET['invert']==1) $glowcolor = imagecolorallocatealpha($img_sfondo_glow,$sfondoR,$sfondoG,$sfondoB,0);
/*if($_GET['q']==10)*/ vignette($img_sfondo_glow,$glowcolor,50-$asd,(($larghezza/2)+$pixelsize*2-$sinister));







for($y = $ystart; $y < $altezza/$pixelsize; $y++){
	for($x = $xstart; $x < $larghezza/($pixelsize*2); $x++){
		if($s[$i]=='b'||$s[$i]=='c'){
			$diff=intval(mt_rand(0,2));
			$f=$larghezza/($pixelsize)-$x-1;
			//contorno nero
			imagefilledrectangle($img_sfondo_glow, $pixelsize*($x)-2, $pixelsize*($y)-2, $pixelsize+$pixelsize*($x)+2, $pixelsize-1+$pixelsize*($y)+2, $black);
			imagefilledrectangle($img_sfondo_glow, $pixelsize*($f)-2, $pixelsize*($y)-2, $pixelsize+$pixelsize*($f)+2, $pixelsize-1+$pixelsize*($y)+2, $black);
			//contorno bianco
			imagefilledrectangle($img_mid, $pixelsize*($x)-1, $pixelsize*($y)-1, $pixelsize+$pixelsize*($x)+1, $pixelsize-1+$pixelsize*($y)+1, $white);
			imagefilledrectangle($img_mid, $pixelsize*($f)-1, $pixelsize*($y)-1, $pixelsize+$pixelsize*($f)+1, $pixelsize-1+$pixelsize*($y)+1, $white);
			//disegno
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
			if($s[$i]=='c'){
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
		}$i++;
	}$y = $y+$ygap;
}



//overlap
imagecopy($img_sfondo, $img_sfondo_glow, 0, 0, 0, 0, $larghezza, $altezza);
imagecopy($img_sfondo, $img_mid, 0, 0, 0, 0, $larghezza, $altezza);
imagecopy($img_sfondo, $img, 0, 0, 0, 0, $larghezza, $altezza);


header("Content-type: image/png");
imagepng($img_sfondo);
imagedestroy($img_sfondo_glow);
imagedestroy($img_sfondo);
imagedestroy($img_mid);
imagedestroy($img);


?>
