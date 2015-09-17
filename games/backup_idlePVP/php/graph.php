<?php
      $id=$_GET['id'];
      mt_srand($id);

	$pixelsize = 2;
	$height = 40*$pixelsize;
	$width = 40*$pixelsize;

      //create the "canvas"
      $img = imagecreatetruecolor($width, $height);

      $ncol=30;//min_colore 0
      $xcol=220;//max_colore 255

      //colors
      /*
      $sfondoR=mt_rand($ncol,$xcol);
      $sfondoG=mt_rand($ncol,$xcol);
      $sfondoB=mt_rand($ncol,$xcol);*/
      $coloreR=mt_rand($ncol,$xcol);
      $coloreG=mt_rand($ncol,$xcol);
      $coloreB=mt_rand($ncol,$xcol);

      $colore_lama = imagecolorallocate($img,$coloreR,$coloreG,$coloreB);


      //backround color
      $coloresnf = imagecolorallocate($img,30,30,30);
      imagefilledrectangle($img, 0, 0, $width, $height, $coloresnf);
      //imagecolortransparent($img, $coloresnf); //toggle transparent background

      //draw the hexagon:
      //hexagon's center coordinates and radius
      $hex_x=40;
      $hex_y=40;
      $radius=30;
      //draw the inner lines
      $white = imagecolorallocate($img,100,100,100);
      imageline($img, $hex_x, $hex_y, $hex_x+$radius, $hex_y, $white);
      imageline($img, $hex_x, $hex_y, $hex_x+$radius/2, $hex_y-($radius)*(sqrt(3)/2), $white);
      imageline($img, $hex_x, $hex_y, $hex_x-$radius/2, $hex_y-($radius)*(sqrt(3)/2), $white);
      imageline($img, $hex_x, $hex_y, $hex_x+$radius/2, $hex_y+($radius)*(sqrt(3)/2), $white);
      imageline($img, $hex_x, $hex_y, $hex_x-$radius/2, $hex_y+($radius)*(sqrt(3)/2), $white);
      imageline($img, $hex_x, $hex_y, $hex_x-$radius, $hex_y, $white);
      //draw the outer lines
      $white = imagecolorallocate($img,240,240,240);
      imageline($img, $hex_x+$radius, $hex_y, $hex_x+$radius/2, $hex_y-($radius)*(sqrt(3)/2), $white);
      imageline($img, $hex_x+$radius/2, $hex_y-($radius)*(sqrt(3)/2), $hex_x-$radius/2, $hex_y-($radius)*(sqrt(3)/2), $white);
      imageline($img, $hex_x-$radius/2, $hex_y-($radius)*(sqrt(3)/2), $hex_x-$radius, $hex_y, $white);
      imageline($img, $hex_x-$radius, $hex_y, $hex_x-$radius/2, $hex_y+($radius)*(sqrt(3)/2), $white);
      imageline($img, $hex_x-$radius/2, $hex_y+($radius)*(sqrt(3)/2), $hex_x+$radius/2, $hex_y+($radius)*(sqrt(3)/2), $white);
      imageline($img, $hex_x+$radius/2, $hex_y+($radius)*(sqrt(3)/2), $hex_x+$radius, $hex_y, $white);



      $coloreR=(($coloreR-$ncol)/($xcol-$ncol))*$radius;
      $coloreG=(($coloreG-$ncol)/($xcol-$ncol))*$radius;
      $coloreB=(($coloreB-$ncol)/($xcol-$ncol))*$radius;
      $coloreRn=$radius-$coloreR;
      $coloreGn=$radius-$coloreG;
      $coloreBn=$radius-$coloreB;

//echo " ".intval($coloreR).", ".intval($coloreG).", ".intval($coloreB).", ".intval($coloreRn).", ".intval($coloreGn).", ".intval($coloreBn);

      //data graph values
      $values = array(
            $hex_x-$coloreR/2, $hex_y-($coloreR)*(sqrt(3)/2),     //R
            $hex_x+$coloreG/2, $hex_y-($coloreG)*(sqrt(3)/2),     //G
            $hex_x+$coloreB, $hex_y,                              //B
            $hex_x+($coloreRn/2), $hex_y+($coloreRn)*(sqrt(3)/2),	//Rn
            $hex_x-($coloreGn/2), $hex_y+($coloreGn)*(sqrt(3)/2),	//Gn
            $hex_x-($coloreBn), $hex_y                            //Bn
      );
      //draw the data
      imagefilledpolygon($img, $values, 6, $colore_lama);
      imagepolygon($img, $values, 6, $white);

      //load the signets image
      $hover=imagecreatefrompng('./hover_smaller.png');
      imagecopy($img, $hover, 0, 0, 0, 0, 80, 80);

      header("Content-type: image/png");
      imagepng($img);
      imagedestroy($img);
?>
