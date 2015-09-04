<html>


<?php

function load_data()
{
     $filename = "admin.txt";
	 $file = fopen( $filename, "r" );
	 
	 if( $file == false )
	 {
		echo ( "Error in opening file" );
		exit();
	 }
	 
	 $filesize = filesize( $filename );
	 $filetext = fread( $file, $filesize );
	 fclose( $file );
	 
	 //echo ( "File size : $filesize bytes" );
	 //echo ( "<pre>$filetext</pre>" );
	
	global $data,$len;
	
	$data=preg_split("/((\r?\n)|(\r\n?))/", $filetext);
	//echo $data;
	$len=(int)$data[0];
	//echo $len;
	
	
}

load_data();

function write($val)
{
   $filename = "mode.txt";
   $file = fopen( $filename, "w" );
   
   if( $file == false )
   {
      echo ( "Error in opening new file" );
      exit();
   }
   fwrite( $file, $val );
   fclose( $file );
}
	
if(@$_POST)
{
	/*
	echo $_POST;
	if(@$_POST['Rosso'])
	write(1);
	else if (@$_POST['Giallo']) 
	write(2);
	else if (@$_POST['Verde']) 
	write(3);
	*/
	//echo array_keys($_POST)[0];
	write(array_keys($_POST)[0]);
	
	//post redirect get
	header("Location: " . $_SERVER['REQUEST_URI']);
	exit();
}

?>


<style>

body {
	text-align: center;
	/*position: absolute;
	top: 50%;
	left: 50%;
	transform: translate(-50%, -50%);*/
}

h1 {
	font-family: helvetica;
	font-size: 60px;
}

#tasti {
	position: absolute;
	top: 50%;
	left: 50%;
	transform: translate(-50%, -50%);
	width: 90%;
	height: 90%;
}


#tasti input[type=submit] {
	textalign: center;
	font-size: 30px;
    width: 100%;
    height: <?php 
		echo 60/$len;
    ?>%;
    margin-top: 1%;
    margin-bottom: 1%;
}

#tasti h1 {
	margin-bottom: 5%;
}

</style>
	

<body>



<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">

<div id="tasti" align="center">

<h1>Scegli il colore</h1>
	
<?php
for($i=1; $i<=$len; ++$i)
echo '<input type="submit" name="'.$i.'" Value="'.$data[$i].'">'."\n"
?>
	
<!--
<input type="submit" name="Rosso" Value="Rosso">
<input type="submit" name="Giallo" Value="Giallo">
<input type="submit" name="Verde" Value="Verde">
-->
<?php echo @$a; ?>
</div>

</form>

</body>

</html>
