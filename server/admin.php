<html>


<?php
$filename = 0;
$file = 0;
$data = array();
$size = 0;

function load()
{
		 $filename = "views.txt";
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
         
         $raw_data=preg_split("/((\r?\n)|(\r\n?))/", $filetext);
         global $data,$size;
         $size=$raw_data[0];
         $line=1;         
         for($i=0; $i<$size; ++$i)
         {
			 $data[$i]=array();
			 $len=$raw_data[$line];
			 $data[$i][-1]=$len;
			 ++$line;
			 $data[$i][-2]=$raw_data[$line];
			 ++$line;
			 //echo $len;
			 //echo $data[$i][-2];
			 for($j=0; $j<$len; ++$j)
			 {
				 $data[$i][$j]=$raw_data[$line];
				 ++$line;
			 }
		 }
		 /*for($i=0;$i<$size;++$i)
			echo $data[$i][-1];*/
			 
         

}

load();

function open()
{
   global $filename, $file;
   $filename = "admin.txt";
   $file = fopen( $filename, "w" );
   
   if( $file == false )
   {
      echo ( "Error in opening new file" );
      exit();
   }
}

function close()
{
	global $file;
	fclose( $file );	
}

function write($val)
{
   global $file;
   fwrite( $file, $val."\n" );
}
	
if(@$_POST)
{
	open();	
	
	$key=array_keys($_POST)[0];
	write($data[$key][-1]);
	for($j=0; $j<$data[$key][-1]; ++$j)
		write($data[$key][$j]);
	
	/*
	if(@$_POST['Colori'])
	{
		write(3);  //numero di elementi
		write("Rosso");
		write("Giallo");
		write("Verde");
	}
	else if (@$_POST['Blink']) 
	{
		write(3);  //numero di elementi
		write("Off");
		write("On");
		write("Blink");
	}*/
	
	close();
	
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
		echo 60/$size;
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
for($i=0; $i<$size; ++$i)
echo '<input type="submit" name="'.$i.'" Value="'.$data[$i][-2].'">'."\n"

?>

<!--
<input type="submit" name="Colori" Value="Colori">
<input type="submit" name="Blink" Value="On, Off, Blink">
-->
<?php echo @$a; ?>
</div>

</form>

</body>

</html>
