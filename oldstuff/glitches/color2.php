<?php

$gapDefault = 100;
$gap=$_GET['gap'];
$file=$_GET['file'];
$file=stripslashes($file);
$file=mysql_real_escape_string($file);
// open an image
$img0 = imagecreatefrompng($file);
$img = imagecreatefrompng($file);

$width = imagesx($img0);
$height = imagesy($img0);


for($y=0;$y<$height;$y++){
      for($x=0;$x<$width;$x++){
          $rgb = imagecolorat($img0, $x, $y);
          // make it human readable
          $r = ($rgb >> 16) & 0xFF;
          $g = ($rgb >> 8) & 0xFF;
          $b = $rgb & 0xFF;
		  
		  if($r>$g){
			  if($r>$b){
				  if($g>$b){//rgb
					  if($r-$g>$gap){//R
					  		$colore = imagecolorallocate($img,$r,$g,$g);
					  }else if($g-$b>$gap){//R+G
					  		$colore = imagecolorallocate($img,$b,$b,0);
					  }else{//WorB
						  if($r+$b+$g>382.5){//W
						 	 	$colore = imagecolorallocate($img,255,255,255);
						  }else{//B
						  		$colore = imagecolorallocate($img,$r,$g,$g);
						  }
					  }
				  }else{//rbg
					  if($r-$b>$gap){//R
					  		$colore = imagecolorallocate($img,$r,$b,$b);
					  }else if($b-$g>$gap){//R+B
					  		$colore = imagecolorallocate($img,$g,0,$g);
					  }else{//WorB
						  if($r+$b+$g>382.5){//W
						 	 	$colore = imagecolorallocate($img,255,255,255);
						  }else{//B
						  		$colore = imagecolorallocate($img,$r,$b,$b);
						  }
					  }
				  }
			  }else{//brg
				  if($b-$r>$gap){//B
				  		$colore = imagecolorallocate($img,$r,$r,$b);
				  }else if($r-$g>$gap){//B+R
				  		$colore = imagecolorallocate($img,$g,0,$g);
				  }else{//WorB
					  if($r+$b+$g>382.5){//W
					 	 	$colore = imagecolorallocate($img,255,255,255);
					  }else{//B
					  		$colore = imagecolorallocate($img,$r,$r,$b);
					  }
				  }
			  }
		  }else if($g>$b){
			  if($r>$b){//grb
				  if($g-$r>$gap){//G
				  		$colore = imagecolorallocate($img,$r,$g,$r);
				  }else if($r-$b>$gap){//G+R
				  		$colore = imagecolorallocate($img,$b,$b,0);
				  }else{//WorB
					  if($r+$b+$g>382.5){//W
					 	 	$colore = imagecolorallocate($img,255,255,255);
					  }else{//B
					  		$colore = imagecolorallocate($img,$r,$g,$r);
					  }
				  }
			  }else{//gbr
				  if($g-$b>$gap){//G
				  		$colore = imagecolorallocate($img,$b,$g,$b);
				  }else if($b-$r>$gap){//G+B
				  		$colore = imagecolorallocate($img,0,$r,$r);
				  }else{//WorB
					  if($r+$b+$g>382.5){//W
					 	 	$colore = imagecolorallocate($img,255,255,255);
					  }else{//B
					  		$colore = imagecolorallocate($img,$b,$g,$b);
					  }
				 }
			  }
		  }else {//bgr
			  if($b-$g>$gap){//B
			  		$colore = imagecolorallocate($img,$g,$b,$g);
			  }else if($g-$r>$gap){//B+G
			  		$colore = imagecolorallocate($img,0,$r,$r);
			  }else{//WorB
				  if($r+$b+$g>382.5){//W
				 	 	$colore = imagecolorallocate($img,255,255,255);
				  }else{//B
				  		$colore = imagecolorallocate($img,$g,$b,$g);
				  }
			 }
		  }

		  imagefilledrectangle($img, $x, $y, $x+1, $y+1, $colore);
      }
}
header("Content-type: image/png");
	imagepng($img);
	imagedestroy($img);

?>