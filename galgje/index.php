<html>
<head>
<style>
body  {
  background-image: url("paperc.jpg");

  font color: blue;
}
.galgje{
  margin: 0 auto;
  border: solid 5px;
  height: auto;
  width: 20%;
  background-color:  #999999;
}
.img{
  background-color:  #0d0d0d;
  height: 33,3%;
}
.text{
  margin: 20%;
}
</style>
</head>
<body>

<div class="galgje">
<?php
$foutmelding=NULL;


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "6letterwoorden";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";

$sql = "SELECT * FROM `woordenlijst`";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
       
    }
} else {
    echo "0 results";
}
mysqli_close($conn);


$woordenlijst=$sql = array
("olielamp", "contract", "krokodil", "tuinkers", "uitdelen", "rituelen", "ritselen", "vakantie", "uitkeren", "studeren", "struiken", "postbode","afvalbak", "stadhuis", "probleem", "strekken", "boeketje", "computer", "weekblad", "minister", "contract", "schilder", "tekening", "laminaat", "iedereen", "mercedes","apennoot", "kerstmis", "gewapend", "afzuiger", "aquarium", "naaldhak", "stekkers", "uiterste", "flitsers", "nagellak", "luchtbel", "aanrecht", "proberen", "kastdeur");



  
if(isset($_POST["gecodwoord"]))
{
    $gecod_woord=$_POST["gecodwoord"];
    foreach($woordenlijst as $w)
    {
         if (md5($w)==$gecod_woord)
         {
              $woord=$w;
         }
    }
}
else
{
    $woord=$woordenlijst[array_rand($woordenlijst,1)];
    $gecod_woord=md5($woord);
}

if(isset($_POST["geproblet"]))
{
    $geproblet=$_POST["geproblet"];
}
else
{
    $geproblet=NULL;
}

if(isset($_POST["pogingen"]))
{
    $poging=$_POST["pogingen"];
}
else
{
    $poging=0;
}

// genereert de punten aan het begin
if(isset($_POST["bezig"]))
{
    $punten=$_POST["bezig"];
}
else
{
    $lengte=strlen($woord);
    $x=0;

    if(!isset($punten))
    {
         $punten=NULL;
         while(($x < $lengte))
         {
              $punten .= ".";
              $x++;
         }
    }
}

//hieronder het script dat de punten vervangt door letters

if(isset($_POST["letter"]) and ($_POST["letter"]!=NULL))
{
    $letter=$_POST["letter"];

    $offset=0;
    $positie = 0;
    $positie = strpos($woord,$letter,$offset);

    while($positie!== false)
    {
         $positie = strpos($woord,$letter,$offset);
         $offset=$positie+1;
         if($positie != '0')
         {
              $punten = substr_replace($punten,$letter,$positie,1);
         }
         else
         {
              if(strpos($woord,$letter,0)=='0')
              {
                   $punten = substr_replace($punten,$letter,0,1);
              }
         }
    }

    if((strpos($woord,$letter)===false) and (isset($letter)))
    {
        $foutmelding="<font color=red>Niet voorkomende letter:</font> ";
        $poging++;
    }
}
else
{
    if(isset($_POST["gecodwoord"]))
    {
         echo "<font color=red>Fout!, je hebt geen letter ingevuld</font>";
    }
    $letter=NULL;
}

?>
<div class="img" style="height:100px">
  <?php

//genereert image's galgje per poging
if($poging==0)
{
echo '<img src="galg_0.png">';
}
if($poging==1)
{
echo '<img src="galg_1.png"<br><br>';
}
if($poging==2)
{
echo '<img src="galg_2.png"<br><br>';
}
if($poging==3)
{
echo '<img src="galg_3.png"<br><br>';
}
if($poging==4)
{
echo '<img src="galg_4.png"<br><br>';
}
if($poging==5)
{
echo '<img src="galg_5.png"<br><br>';
}
if($poging==6)
{
echo '<img src="galg_6.png"<br><br>';
}
if($poging==7)
{
echo '<img src="galg_7.png"<br><br>';
}

if($poging==7)
{
    echo "<font color=red>Je hebt verloren! het woord was: </font><b>".$woord."</b>";
    exit;
}

?>
</div>
<?php

echo "<br>";
echo '<div class="text">';
echo $foutmelding;
unset($foutmelding);

$geproblet .= " ". $letter;
echo "<br>";echo "<br>";
echo "<font color=blue><b>".$letter."</b></font>";
echo "<font color=blue><h2>".$punten."</h2>";
echo "<font color=blue><b>fouten:</b></font> <font color=red>".$poging."</font>";
echo "<br>";
echo "<font color=blue><b>geprobeerde letters:</b></font> <font color=red>".$geproblet."</font>";

$zelf = $_SERVER['PHP_SELF'];

if($punten==$woord)
{
    echo "<br><br><b>Gefeliciteerd, je hebt het woord gevonden! </b>";
    exit;
}


echo '<br>
<FORM ACTION="'.$zelf.'" width="150" METHOD="POST">
<b>Probeer de letter:<br>
<INPUT TYPE="text" NAME="letter" SIZE="1" MAXLENGTH="1">
<INPUT TYPE="hidden" NAME="gecodwoord" VALUE="'.$gecod_woord.'">
<INPUT TYPE="hidden" NAME="bezig" VALUE="'.$punten.'">
<INPUT TYPE="hidden" NAME="pogingen" VALUE="'.$poging.'">
<INPUT TYPE="hidden" NAME="geproblet" VALUE="'.$geproblet.'">
<INPUT TYPE="submit" VALUE="Probeer"></b>';
echo '</div>';
echo "<br><br><br>".$woord;

?>
</div>
</body>
</html>
