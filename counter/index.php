<?php

ob_start();
session_start();
$counterpage = $_GET['counterpage'];
$counterpage = stripslashes($counterpage);
$counterpage = mysql_real_escape_string($counterpage);
$host="localhost"; // Host name
$username="ciaccodavide"; // Mysql username
$password="ciakkor91"; // Mysql password
$db_name="my_ciaccodavide"; // Database name
$tbl_name0="counters"; // Table name
// Connect to server and select databse.
mysql_connect("$host", "$username", "$password")or die("cannot connect");
mysql_select_db("$db_name")or die("cannot select DB");
//DONWLOAD COUNT
$sql="SELECT * FROM $tbl_name0 WHERE counterpage LIKE '$counterpage'";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$count=$row['count'];
$count+=1;
//ADD
$sql="UPDATE $tbl_name0 SET count = '$count' WHERE counterpage LIKE '$counterpage'";
mysql_query($sql);

$countstr=strval($count);
//$countstr="0123456789";//TEST
$strlen=strlen($countstr);
$countarray=str_split($countstr);



$altezza = 7;
$larghezza = $strlen*5;
$pixelsize = $_GET['ps'];
$colore = $_GET['colore'];
$sfondo = $_GET['sfondo'];



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
	
//CREA "CANVAS"
$img = imagecreatetruecolor($larghezza*$pixelsize, $altezza*$pixelsize);
//COLORS
$colore = imagecolorallocate($img,$coloreR,$coloreG,$coloreB);
$sfondo = imagecolorallocate($img,$sfondoR,$sfondoG,$sfondoB);
//SFONDO
imagefilledrectangle($img, 0,0,$larghezza*$pixelsize, $altezza*$pixelsize, $sfondo);

for($i=0;$i<$strlen;$i++){
		if($countarray[$i]=='0'){
			imagefilledrectangle($img, (1+5*$i)*$pixelsize, 1*$pixelsize, (4+5*$i)*$pixelsize, 6*$pixelsize, $colore);
			imagefilledrectangle($img, (2+5*$i)*$pixelsize, 2*$pixelsize, (3+5*$i)*$pixelsize, 5*$pixelsize, $sfondo);
		}else if($countarray[$i]=='1'){
			imagefilledrectangle($img, (3+5*$i)*$pixelsize, 1*$pixelsize, (4+5*$i)*$pixelsize, 6*$pixelsize, $colore);
		}else if($countarray[$i]=='2'){
			imagefilledrectangle($img, (1+5*$i)*$pixelsize, 1*$pixelsize, (4+5*$i)*$pixelsize, 6*$pixelsize, $colore);
			imagefilledrectangle($img, (1+5*$i)*$pixelsize, 2*$pixelsize, (3+5*$i)*$pixelsize, 3*$pixelsize, $sfondo);
			imagefilledrectangle($img, (2+5*$i)*$pixelsize, 4*$pixelsize, (4+5*$i)*$pixelsize, 5*$pixelsize, $sfondo);
		}else if($countarray[$i]=='3'){
			imagefilledrectangle($img, (1+5*$i)*$pixelsize, 1*$pixelsize, (4+5*$i)*$pixelsize, 6*$pixelsize, $colore);
			imagefilledrectangle($img, (1+5*$i)*$pixelsize, 2*$pixelsize, (3+5*$i)*$pixelsize, 3*$pixelsize, $sfondo);
			imagefilledrectangle($img, (1+5*$i)*$pixelsize, 4*$pixelsize, (3+5*$i)*$pixelsize, 5*$pixelsize, $sfondo);
		}else if($countarray[$i]=='4'){
			imagefilledrectangle($img, (1+5*$i)*$pixelsize, 1*$pixelsize, (4+5*$i)*$pixelsize, 6*$pixelsize, $colore);
			imagefilledrectangle($img, (2+5*$i)*$pixelsize, 1*$pixelsize, (3+5*$i)*$pixelsize, 3*$pixelsize, $sfondo);
			imagefilledrectangle($img, (1+5*$i)*$pixelsize, 4*$pixelsize, (3+5*$i)*$pixelsize, 6*$pixelsize, $sfondo);
		}else if($countarray[$i]=='5'){
			imagefilledrectangle($img, (1+5*$i)*$pixelsize, 1*$pixelsize, (4+5*$i)*$pixelsize, 6*$pixelsize, $colore);
			imagefilledrectangle($img, (2+5*$i)*$pixelsize, 2*$pixelsize, (4+5*$i)*$pixelsize, 3*$pixelsize, $sfondo);
			imagefilledrectangle($img, (1+5*$i)*$pixelsize, 4*$pixelsize, (3+5*$i)*$pixelsize, 5*$pixelsize, $sfondo);
		}else if($countarray[$i]=='6'){
			imagefilledrectangle($img, (1+5*$i)*$pixelsize, 1*$pixelsize, (4+5*$i)*$pixelsize, 6*$pixelsize, $colore);
			imagefilledrectangle($img, (2+5*$i)*$pixelsize, 2*$pixelsize, (4+5*$i)*$pixelsize, 3*$pixelsize, $sfondo);
			imagefilledrectangle($img, (2+5*$i)*$pixelsize, 4*$pixelsize, (3+5*$i)*$pixelsize, 5*$pixelsize, $sfondo);
		}else if($countarray[$i]=='7'){
			imagefilledrectangle($img, (1+5*$i)*$pixelsize, 1*$pixelsize, (4+5*$i)*$pixelsize, 6*$pixelsize, $colore);
			imagefilledrectangle($img, (1+5*$i)*$pixelsize, 2*$pixelsize, (3+5*$i)*$pixelsize, 6*$pixelsize, $sfondo);
		}else if($countarray[$i]=='8'){
			imagefilledrectangle($img, (1+5*$i)*$pixelsize, 1*$pixelsize, (4+5*$i)*$pixelsize, 6*$pixelsize, $colore);
			imagefilledrectangle($img, (2+5*$i)*$pixelsize, 2*$pixelsize, (3+5*$i)*$pixelsize, 3*$pixelsize, $sfondo);
			imagefilledrectangle($img, (2+5*$i)*$pixelsize, 4*$pixelsize, (3+5*$i)*$pixelsize, 5*$pixelsize, $sfondo);
		}else if($countarray[$i]=='9'){
			imagefilledrectangle($img, (1+5*$i)*$pixelsize, 1*$pixelsize, (4+5*$i)*$pixelsize, 6*$pixelsize, $colore);
			imagefilledrectangle($img, (2+5*$i)*$pixelsize, 2*$pixelsize, (3+5*$i)*$pixelsize, 3*$pixelsize, $sfondo);
			imagefilledrectangle($img, (1+5*$i)*$pixelsize, 4*$pixelsize, (3+5*$i)*$pixelsize, 5*$pixelsize, $sfondo);
		}
}		

header("Content-type: image/png");
imagepng($img);
imagedestroy($img);

ob_end_flush()
?>