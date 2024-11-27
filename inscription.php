<!-- 
1 Form avec un nom, un prenom, adresse mail et mot de passe
2 Bouton d'inscription que quand on appuie dessus ça vérifie si l'email et/ou le mdp n'existe pas déja
3 Si les deux sont nouveaux alors les inscrire dans la bdd table users
4 Role par défault visiteur -->

<?php
// On démarre la session PHP
session_start();

// Connexion à la base de données
require_once('connection.php');

// On vérifie si le formulaire a bien été envoyé
if (!empty($_POST)) {
    // Le formulaire a été envoyé
    // On vérifie que TOUS les champs requis sont remplis
    if (isset($_POST["name"], $_POST["firstname"], $_POST["email"], $_POST["pass"])
        && !empty($_POST["name"]) && !empty($_POST["firstname"])
        && !empty($_POST["email"]) && !empty($_POST["pass"])
    ) {
        // Le formulaire est complet
        // On récupère les données en les protégeant
        $name = strip_tags($_POST["name"]);
        $firstname = strip_tags($_POST["firstname"]);
        $email = strip_tags($_POST["email"]);

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            die("Adresse mail invalide");
        }

        // On vérifie si l'email existe déjà
        $checkEmail = $bdd->prepare("SELECT * FROM users WHERE email = :email");
        $checkEmail->bindValue(":email", $email, PDO::PARAM_STR);
        $checkEmail->execute();

        if ($checkEmail->rowCount() > 0) {
            die("L'email existe déjà");
        }

        // On va hasher le mdp
        $pass = password_hash($_POST["pass"], PASSWORD_DEFAULT);

        // On enregistre en BDD
        $sql = "INSERT INTO users(name, firstname, email, pass, role) VALUES (:name, :firstname, :email, :pass, 'visiteur')";

        $query = $bdd->prepare($sql);

        $query->bindValue(":name", $name, PDO::PARAM_STR);
        $query->bindValue(":firstname", $firstname, PDO::PARAM_STR);
        $query->bindValue(":email", $email, PDO::PARAM_STR);
        $query->bindValue(":pass", $pass, PDO::PARAM_STR);

        $query->execute();

        // On récupère l'id du nouvel utilisateur
        $id = $bdd->lastInsertId();

        // On stocke dans $_SESSION les informations de l'utilisateur
        $_SESSION["user"] = [
            "id" => $id,
            "name" => $name,
            "firstname" => $firstname,
            "email" => $email,
            "role" => "visiteur"
        ];

        // On peut rediriger vers ce que l'on veut
        header('Location: index.php');
    } else {
        die("Le formulaire est incomplet");
    }
}

include_once('header.php');
?>

<!--Formulaire-->
<div class="form">
    <form method="post">
    <h4>Inscription</h4>
<hr>
<div class="username-div">
    <!--Nom-->
    <div>
        <label for="name">Nom</label>
      <input type="text" name="name" 
id="name" placeholder="Nom">  
    </div>


   <!--Prénom-->
   <div>
    <label for="firstname">Prénom</label>
    <input type="text" name="firstname" 
id="firstname" placeholder="Prénom">
   </div>
</div>

  <!--Email-->
  <label for="email">Adresse mail</label>
    <input type="email" name="email" 
id="email" placeholder="Email">
 

<!--Mot de passe-->
<label for="pass">Mot de passe</label>
<input type="password" name="pass" 
id="pass" placeholder="Mot de passe"> 

<!--S'inscrire-->
<input type="submit" value="S'inscrire">

<!--Connexion-->
<p>Vous avez déja un compte? 
    <br>
    <a href="connexion.php">Se connecter</a>
</p>

</form>
</div>
<?php include_once('footer.php')?>

<!--Style-->
<style>
 @import url('https://fonts.googleapis.com/css2?family=Lobster&family=Open+Sans:wght@300;400&family=Pacifico&family=Roboto:wght@100&display=swap');
*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}

.form{
    margin-top: 100px;
    display: flex;
    justify-content: center;
    height: auto;
}
    
form{
    width: 50%;
    display: flex;
    flex-direction: column;
    background-color: #E7E3DA;
    padding: 10px;
    border-radius: 6px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
}
h4{
    text-align: center;
    font-size: 20px;

}
hr{
    margin: 10px 0;
    background-color: #ccc;
    border: 0;
    height: 1px;
    width: 100%;

}
.username-div{
    display: flex;
    width: 100%;
    justify-content: space-between;
}
.username-div div{
    display: flex;
    flex-direction: column;
    width: 49%;
}
label{
    margin-bottom: 6px;

}
input{
    margin-bottom: 5px;
    padding: 10px;
    outline: 0;
    border: 1px solid rgba(0, 0, 0, 0.4);
    border-radius: 6px;
}
input:focus{
    border: 1px solid #17a2b8;
}
input[type="submit"]{
    margin-top: 15px;
    background-color: #17a2b8;
    color: #fff;
    border: 1px solid #17a2b8;
    cursor: pointer;
}
p{
    text-align: center;
    margin: 5px 0;
    font-size: 14px;
}
p a{
    text-decoration: none;
    color: #17a2b8;
}
p > a:hover{
    text-decoration: underline;
}
@media only screen and (max-width: 768px){
    .form{
    margin-top: 50px;
    }
    form{
    width: 70%;}
}

</style>