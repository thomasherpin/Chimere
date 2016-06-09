<?php
include_once '../helper/config.php';
include_once '../Model/DevisModel.php';
$projet = Devis::getAllByStatut(3);


?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../css/maquette_css.css" rel="stylesheet" style="text/css">
<title>Maquette</title>
</head>

<body id="body">
<div id="div">
    <img src="../Src/fondBandeau.jpg" id="banniere" />
    <img src="../Src/logo.png" id="logo"/>
<a id="contact">
<h1>Contacter nous</h1>
12 rue des camélites<br />
44000 Nantes<br />
02 28 01 17 18<br />
contacte@chimere-jewelry.com<br />
<img src="../Src/artisan.png" />
</a>
    <img src="../Src/UploadPhotoEtape/pierre.png" id="taillepierre"/>Nos bijoux en vente
<br />
<table id=table>
<tr>
<?php 
$i = 1;
if(isset($projet))
{
foreach ($projet as $item)
			{
				echo"<td><div id=\"listeproj\">";
				//echo "<img src=\"".$item->Urlphoto.".jpg\" id=\"image\"/></br>";
				echo "<div id=\"text\">";
				echo "<b><u><a href='FicheBijouSite.php?value=".$item->IDDevis."'>".Devis::getNom($item->IDDevis)."</a></u></b></br><i id=\"text\">Prix:</i></br>".$item->Cout."</div></a>";
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
	echo"Vous n'avez pas de projets du tout";
}
?>
</td>
</tr>
</table>
</div>
</body>
</html>