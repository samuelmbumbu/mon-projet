<?php
$sent = false;
$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name    = htmlspecialchars(trim($_POST["name"]));
    $email   = htmlspecialchars(trim($_POST["email"]));
    $phone   = htmlspecialchars(trim($_POST["phone"]));
    $date    = htmlspecialchars(trim($_POST["date"]));
    $time    = htmlspecialchars(trim($_POST["time"]));
    $guests  = htmlspecialchars(trim($_POST["guests"]));
    $message = htmlspecialchars(trim($_POST["message"]));

    if ($name && $email && $phone && $date && $time && $guests) {
        $to = "elsambumbu@gmail.com"; // ✏ À remplacer par l'adresse réelle
        $subject = "Nouvelle réservation - ChezFlore";
        $body = "Nom: $name\nTéléphone: $phone\nEmail: $email\nDate: $date\nHeure: $time\nPersonnes: $guests\nMessage: $message";
        $headers = "From: $email";

        if (mail($to, $subject, $body, $headers)) {
            $sent = true;
        } else {
            $error = "Erreur lors de l'envoi. Veuillez réessayer plus tard.";
        }
    } else {
        $error = "Tous les champs obligatoires doivent être remplis.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Réservation - Chez Flore</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Réservez votre table chez ChezFlore à Kinshasa. Formulaire de réservation en ligne.">

  <link rel="stylesheet" href="style.css">
  <link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>

  <header>
    <a href="accueil.html" class="logo"><span>CHEZ</span>FLORE</a>
    <div class="menu-toggle"></div>
    <nav aria-label="Navigation principale">
      <ul class="navbar">
        <li><a href="accueil.html">Accueil</a></li>
        <li><a href="menu.html">Menu</a></li>
        <li><a href="temoignages.html">Témoignages</a></li>
        <li><a href="adresse.html">Adresse</a></li>
        <li><a href="reservation.php" class="btn-reserve active">Réservation</a></li>
      </ul>
    </nav>
  </header>

  <main>
    <section class="reservation-section">
      <div class="overlay">
        <h1 class="titre-principal">Réservez votre table</h1>
        <p class="sous-titre">Venez vivre l’expérience ChezFlore</p>

        <?php if ($sent): ?>
          <div class="confirmation">Merci pour votre réservation ! Nous vous contacterons très vite.</div>
        <?php elseif ($error): ?>
          <div class="erreur"><?= $error ?></div>
        <?php endif; ?>

        <form method="POST" action="reservation.php" class="formulaire-reservation">
          <input type="text" name="name" placeholder="Nom complet *" required>
          <input type="tel" name="phone" placeholder="Téléphone *" required>
          <input type="email" name="email" placeholder="Email *" required>
          <input type="date" name="date" required>
          <input type="time" name="time" required>
          <input type="number" name="guests" placeholder="Nombre de personnes *" min="1" required>
          <textarea name="message" rows="4" placeholder="Message (optionnel)"></textarea>
          <button type="submit" class="btn-reserve">Réserver maintenant</button>
        </form>
      </div>
    </section>
  </main>

  <footer>
    <div class="footer-content">
      <p>&copy; 2025 ChezFlore - Tous droits réservés - Fait par Samuel MBUMBU Ig.</p>
      <div class="social-icons">
        <a href="https://wa.me/243840071513" target="_blank" title="WhatsApp">
          <img src="./img/WhatsApp Image 2025-06-16 à 15.09.05_8fa6fbf1.jpg" alt="Icône WhatsApp de ChezFlore">
        </a>
        <a href="https://www.instagram.com/m.b.u.m.b.u" target="_blank" title="Instagram">
          <img src="./img/WhatsApp Image 2025-05-29 à 21.48.19_b2ad9a9e.jpg" alt="Icône Instagram de ChezFlore">
        </a>
      </div>
    </div>
  </footer>

  <script>
    const menuToggle = document.querySelector('.menu-toggle');
    const navbar = document.querySelector('.navbar');
    menuToggle.addEventListener('click', () => {
      navbar.classList.toggle('show');
    });
  </script>

</body>
</html>