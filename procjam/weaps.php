<html>
    <head>
        <style>
            body{background:#111;color:#ddd;text-align: center;}
            .cerchio{background:#242424;display:inline-block;margin:6px;padding:6px;border:1px solid #333;transition-duration:1s;}
            .cerchio small{display:block;padding-bottom:3px;font-size:11px;}
            .cerchio img{display:inline-block;border:1px solid #161616;}
            a{color:#ddd;text-decoration: none;}
            a:hover .cerchio {border:1px solid #999;transition-duration:0s;}
            a:hover .cerchio small{color:#ddd;text-decoration:underline;}
            a:visited{color:#ddd;text-decoration:line-through;}
            a:visited .cerchio small{color:#ddd;text-decoration:line-through;}
.q0{border:solid 1px #999; border-radius: 4px;}
.q1{border:solid 1px #04A3E4; border-radius: 4px;}
.q2{border:solid 1px #cFcF14; border-radius: 4px;}
.q3{border:solid 1px #D107FF; border-radius: 4px;}
.q4{border:solid 1px #FF3C35; border-radius: 4px;}
.q5{border:solid 1px #FFA347; border-radius: 4px;}
        </style>
    </head>
    <body>
    <?php
        if(isset($_GET['size']))$size=$_GET['size'];else $size=1;
        if($size>8)$size=1;
        echo '<br><br><a href="./weaps.php?n='.$_GET['n'].'&size='.($size+1).'">BIGGER</a><br><br><br>';
$step=$_GET['step'];
        for ($i=0+$step; $i < $_GET['n']+$step; $i++) {
            //$id=$i;
            mt_srand();
            $id=mt_rand();
            echo '<a href="./weap.php?id='.convBase($i, '0123456789', 'ABCDEFGHIJKLMNOPQRSTUVWXYZ').'&size='.$size.'" target="_blank"><div class="cerchio"><small>#'.(convBase($i, '0123456789', 'ABCDEFGHIJKLMNOPQRSTUVWXYZ')).'</small><img src="./weap.php?id='.convBase($i, '0123456789', 'ABCDEFGHIJKLMNOPQRSTUVWXYZ').'&size='.$size.'"></div></a>';
        }




        function convBase($numberInput, $fromBaseInput, $toBaseInput)
        {
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


    ?>
    </body>
</html>
