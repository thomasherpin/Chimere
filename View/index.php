 <?php
        	include_once '../helper/config.php';
                include_once '../Model/ArtisanModel.php';
		$Artisan = Artisan::getAll();
		?>
<html>
	<head>
    <title>accueil</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                <link href="../css/pagecss.css" rel="stylesheet" style="">
	</head>
	<body id="pageacc">

            <img src="../Src/logo.png">

                <form method="GET" action="./View/OperateurView.php">
        <table id="tab1">
        </tr>
        </html>
        <?php
		$i = 1;
		if(isset($Artisan))
		{
		foreach ($Artisan as $item)
			{
                    $nomComplet = $item->prenom." ".$item->nom;
				if($item->metier != 5)
				{
					echo"<td>";
					echo"<a href=\"/Chimere/View/OperateurView.php?id=".$item->IDEmploye."&name=".$item->prenom."\"><input type=\"button\" name=\"Artisan\" value=".$item->nom." id=btn".$item->metier."></a>";
					 if(($i % 4) == 0)
					 {
						echo"</td>";
						echo"</tr>";
						echo"<tr>";				
					 }
					 else
					 {
						echo"</td>";
					 }
					 $i++;
				}
				else
				{
					echo"<td>";
					echo"<a href=\"/Chimere/View/ControleurView.php?id=".$item->IDEmploye."&name=".$item->prenom."\"><input type=\"button\" name=\"Artisan\" value=".$item->nom." id=btn".$item->metier."></a>";
					 if(($i % 4) == 0)
					 {
						echo"</td>";
						echo"</tr>";
						echo"<tr>";				
					 }
					 else
					 {	
						echo"</td>";
					 }
					 $i++;
				}
        	}
			
		}
		else
		{
		echo "Vous n'avez aucun employer";	
		}
		 
        ?>
		</tr> 
        </table>
		</form>
        <a href="BijoutierView.html" id="btn5">Bijoutier</a>
	<body>
<html>