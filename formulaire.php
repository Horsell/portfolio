<?php 
$bdd = new PDO('mysql:host=127.0.0.1;dbname=formulaire','root', ''); // inserer le mot de passe de la bdd
if(isset($_POST['formulaire']))
{
    if(!empty($_POST['mail']) AND !empty($_POST['champ'])))
    {
        $pseudo = htmlspecialchars($_POST['pseudo']);
        $mail = htmlspecialchars($_POST['mail']);
        $mail2 = htmlspecialchars($_POST['mail2']);
        $mdp = sha1($_POST['mdp']);
        $mdp2 = sha1($_POST['mdp2']);
        $pseudolength = strlen($pseudo);
        if($pseudolength <= 15)
        {
                if($mail == $mail2)
                {
                    if($mdp == $mdp2)
                    {
                        $insertMembre = $bdd->prepare('INSERT INTO Personnage (pseudo, mail, mdp) VALUES(?, ?, ?)');
                        $insertMembre->execute(array($pseudo, $mail, $mdp));
                        $erreur = "Votre compte a bien été crée.";
                    }
                    else
                    {
                        $erreur = "Vos mots de passe ne correspondent pas.";
                    }
                }
            else
            {
                $erreur = "Vos adresses mail ne correspondent pas.";
            }
        }
        else
        {
            $erreur = "Votre pseudo ne doit pas depasser 15 caractere";
        }
    }
    else
    {
        $erreur = "Tous les champs doivent être remplis";
    }
}
?>


<section class="contain">
    <h3> Formulaire d'inscription </h3>
    <form action="" method="POST">
        
        <input type="email" placeholder="Email@exemple.com" name="mail" autocomplete="off" required> <br>

        <input type="textarea" placeholder="Votre message" name="champ" autocomplete="off" required> <br>
        <input type="submit" value="Valider" name="formaulaire"/>
    </form>
    </section>
            <!--    End Form    -->
    <section class="erreur">
    <?php
    if(isset($erreur))
    {
        echo "<font color='red'>" . $erreur . "</font>";
    }
    ?>
</section>