<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
  </head>
  <body>
    <h2>Bienvenue dans PROGES-PME</h2>
    <p>Votre demande de souscription sur proges-pme.com a été prise en compte avec succes :</p>
    <ul>
      <li><strong>Nom</strong> : {{ $contact['nom'] }}</li>
      <li><strong>Email</strong> : {{ $contact['email'] }}</li>
      <li><strong>Telephone </strong> : {{ $contact['tel'] }}</li>
      <li><strong>Message</strong> : {{ $contact['message'] }}</li>


    </ul>
  </body>
</html>