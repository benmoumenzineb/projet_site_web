<html>

<head>
    <title>Inscription</title>
    <script language="JavaScript">
       
       function verification() {
            if (document.getElementById("nom").value == "") { alert("Veuillez taper votre nom!"); return false;}
       
    
            if (document.getElementById("eml").value == "") { alert("Veuillez entrer votre adresse e-mail!"); return false;}
           if (document.getElementById("eml").value.indexOf('@') == -1) { alert("Adresse e-mail incorrecte!"); return false; }    
        }
    </script>
</head>

<body>
    <h2><u>INSCRIPTION</u></h2><br>
   <form id="formulaire" action="inscription.php" method="post" onSubmit="verification()">
 <fieldset>
 <legend>Qui êtes vous&nbsp;?</legend>
 <table>
 <tr> <td><label for="nom">Nom :</label> </td>
<td> <input type="text" size= "30" id="nom" name="nom" /></td>
</tr>
<tr><td>
  <label for="eml">Adresse e-mail :</label></td>
<td> <input type="text" size="30" name="eml" id="eml"> </td></tr> </table>
 <input type="radio" id="choix_femme" name="genre" value="genre_femme" />
 <label for="choix_femme" >Femme</label>
 <input type="radio" id="choix_homme" name="genre" value="genre_homme" />
 <label for="choix_homme">Homme</label>
 <tr> <td><label for="nom">Nom :</label> </td>
<td> <input type="text" size= "30" id="nom" name="nom" /></td>
</tr>

 <button type="submit" value="ok" >Confirmer</button>
 <button type="reset" value="nok" >Annuler</button>
 </fieldset>
 </form>
 <?php

    
	if(isset($_POST['nom']) and isset($_POST['genre']) and isset($_POST['eml']))
	{
		if(!empty($_POST['nom']) and !empty($_POST['genre']) and !empty($_POST['eml']))
		{
			try
			{
				global $bdd;
				$bdd = new PDO('mysql:host=localhost;dbname=stock;charset=utf8', 'root', '');
				
			}
			catch (Exception $e)
			{
					die('Erreur : ' . $e->getMessage());
			}
		$sql1="select * from utilisateur where email='".$_POST['eml']."' and nom='".$_POST['nom']."'";
		$reponse = $bdd->query($sql1);
	    $donnees = $reponse->fetch();
	
			if(empty($donnees))
			{   
				$sql2="insert into utilisateur(nom, email, genre) values('".$_POST['nom']."','".$_POST['eml']."','".$_POST['genre']."')";
				$bdd->exec($sql2);
				echo"<center>Utilisateur ".$_POST['nom']." est ajouté avec succés</center>";
			}
			else
			echo "<center>Utilisateur existe déja !!!</center>";
		} 
	}
	?>
</body>

</html>