<?php
include_once '../helper/config.php';
include_once '../Model/DevisModel.php';
$DevisEnCours = Devis::getAllByStatut(1);
$DevisEnAttente = Devis::getAllByStatut(2);
$DevisEnStock = Devis::getAllByStatut(3);
$DevisVendu = Devis::getAllByStatut(4);

?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link href="../css/pagecss.css" rel="stylesheet" style="">
<title>Maquette</title>
</head>

<body id="pageacc">
<div id="div">
    <img src="../Src/logo.png">
    
<br />
<table id=table>
<tr>
<?php 
$i = 1;
    echo"<h1>Projet en cours: </h1>";
if(isset($DevisEnCours))
{
foreach ($DevisEnCours as $item)
			{
				echo"<td><div id=\"listeproj\">";
				//echo "<img src=\"".$item->Urlphoto.".jpg\" id=\"image\"/></br>";
				echo "<div id=\"text\">";
				echo "<b><u><a href='FicheBijouListe.php?value=".$item->IDDevis."'>".Devis::getNom($item->IDDevis)."</a></u></b></br><i id=\"text\">Prix:</i></br>".$item->Cout."</div></a>";
				echo "<a href='pagecontact.htm'><img src='".Devis::getDerniereUrlPhoto($item->IDDevis)."' id=\"image\"/></a></br>";
				echo"</div>";
				if(($i % 5) == 0)
					 {
						echo"</td>";
						echo"</tr>";
						echo"<tr>";				
					 }
					 else
					 {	
						echo"</td>";
					 }
				}
			//&client=".$item->client."
			}
else
{
	echo"Vous n'avez pas de projets actuellement travaillé";
}
?>
</td>
</tr>
</table>
<table id=table>
<tr>
<?php 
$i = 1;
        echo"<h1>Projet en attente: </h1>";
if(isset($DevisEnAttente))
{
foreach ($DevisEnAttente as $item)
			{
				echo"<td><div id=\"listeproj\">";
				//echo "<img src=\"".$item->Urlphoto.".jpg\" id=\"image\"/></br>";
				echo "<div id=\"text\">";
				echo "<b><u><a href='FicheBijouListe.php?value=".$item->IDDevis."'>".Devis::getNom($item->IDDevis)."</a></u></b></br><i id=\"text\">Prix:</i></br>".$item->Cout."</div></a>";
				echo "<a href='pagecontact.htm'><img src='".Devis::getDerniereUrlPhoto($item->IDDevis)."' id=\"image\"/></a></br>";
				echo"</div>";
				if(($i % 5) == 0)
					 {
						echo"</td>";
						echo"</tr>";
						echo"<tr>";				
					 }
					 else
					 {	
						echo"</td>";
					 }
				}
			//&client=".$item->client."
			}
else
{
	echo"Vous n'avez pas de projets en attente";
}
?>
</td>
</tr>
</table>
<table id=table>
<tr>
<?php 
$i = 1;
        echo"<h1>Bijoux en stock: </h1>";
if(isset($DevisEnStock))
{
foreach ($DevisEnStock as $item)
			{
				echo"<td><div id=\"listeproj\">";
				//echo "<img src=\"".$item->Urlphoto.".jpg\" id=\"image\"/></br>";
				echo "<div id=\"text\">";
				echo "<b><u><a href='FicheBijouListe.php?value=".$item->IDDevis."'>".Devis::getNom($item->IDDevis)."</a></u></b></br><i id=\"text\">Prix:</i></br>".$item->Cout."</div></a>";
				echo "<a href='pagecontact.htm'><img src='".Devis::getDerniereUrlPhoto($item->IDDevis)."' id=\"image\"/></a></br>";
				echo"</div>";
				if(($i % 5) == 0)
					 {
						echo"</td>";
						echo"</tr>";
						echo"<tr>";				
					 }
					 else
					 {	
						echo"</td>";
					 }
				}
			//&client=".$item->client."
			}
else
{
	echo"Vous n'avez pas de projets en stock";
}
?>
</td>
</tr>
</table>
<table id=table>
<tr>
<?php 
$i = 1;
        echo"<h1>Bijoux vendu: </h1>";
if(isset($DevisVendu))
{
foreach ($DevisVendu as $item)
			{
				echo"<td><div id=\"listeproj\">";
				//echo "<img src=\"".$item->Urlphoto.".jpg\" id=\"image\"/></br>";
				echo "<div id=\"text\">";
				echo "<b><u><a href='FicheBijouListe.php?value=".$item->IDDevis."'>".Devis::getNom($item->IDDevis)."</a></u></b></br><i id=\"text\">Prix:</i></br>".$item->Cout."</div></a>";
				echo "<a href='pagecontact.htm'><img src='".Devis::getDerniereUrlPhoto($item->IDDevis)."' id=\"image\"/></a></br>";
				echo"</div>";
				if(($i % 5) == 0)
					 {
						echo"</td>";
						echo"</tr>";
						echo"<tr>";				
					 }
					 else
					 {	
						echo"</td>";
					 }
				}
			//&client=".$item->client."
			}
else
{
	echo"Vous n'avez pas de projets vendus";
}
?>
</td>
</tr>
</table>
</div>
</body>
</html>