<?php
// require "INCLUDE/conn_db.php";
require "FONCTION/fonction.php";
$slides = getSliderpub();

// Connexion PDO
$conn = getPdoConnection();

// Extraction
echo extraireToutesLesImages($conn);

echo extraireToutesLesImagesProduit($conn);

$cheminsImages = glob('imgProduit/*.jpg'); // ou .jpeg/.png selon ton format

?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Accueil</title>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
  <!-- section du navbar -->
  <header class="header-fixed">
    <div class="navbar">
      <div class="logo-container">
        <img src="logo.png" alt="Logo" class="logo" id="logo">
      </div>
      <input type="text" placeholder="Barre de recherche" class="search-bar">
      <div class="icons">
        <i class="fas fa-user-circle"></i>
        <div class="cart-icon">
          <i class="fas fa-shopping-cart"></i>
          <span class="cart-count">0</span>
        </div>
      </div>
    </div>
  
    <nav class="menu">
      <a href="#">Maison</a>
      <a href="#">Meilleur vente</a>
      <a href="#">Devenir partenaire</a>
      <a href="#">A propos</a>
      <a href="#">Aide</a>
    </nav>
  </header>
  
  <!-- section du slider pub -->
  <?php
  $slides = []; // tableau vide

  $images = glob('image/*.jpg');
  foreach ($images as $imgPath) {
      $slides[] = [
          'image' => basename($imgPath),
          'alt_text' => pathinfo($imgPath, PATHINFO_FILENAME),
      ];
  }
?>
  <section class="slider">
    <div class="slider-elements">
      <?php foreach ($slides as $index => $slide): ?>
        <div class="slider-item fade">
          <div class="slider-image">
            <img src="image/<?=htmlspecialchars($slide['image'])?>" class="img-fluid" alt="<?= htmlspecialchars($slide['alt_text']) ?>">
          </div>
        </div>
      <?php endforeach; ?>

      <div class="slider-buttons">
        <button onclick="plusSlide(-1)">
          <i class="bi bi-chevron-left"></i>
        </button>
        <button onclick="plusSlide(1)">
          <i class="bi bi-chevron-right"></i>
        </button>
      </div>

      <div class="slider-dots">
        <?php foreach ($slides as $index => $slide): ?>
          <button class="slider-dot <?= $index === 0 ? 'active' : '' ?>" onclick="currentSlide(<?= $index + 1 ?>)">
            <span></span>
          </button>
        <?php endforeach; ?>
      </div>
    </div>
  </section>
  <!-- section du categories -->
  <section class="categories">
    
    <div class="carousel-container">
      <h2>Catégories</h2>
      <div class="carousel" id="carousel">
        <button id="prev">&#10094;</button>
        <div class="carousel-track" id="carousel-track">
          <div class="carousel-item">
            <img src="laptop.png" alt="Ordinateur">
            <p>Ordinateur</p>
          </div>
          <div class="carousel-item">
            <img src="rolex.png" alt="Montre">
            <p>Montre</p>
          </div>
          <div class="carousel-item">
            <img src="iphone.png" alt="Téléphone">
            <p>Téléphone</p>
          </div>
          <div class="carousel-item">
            <img src="laptop.png" alt="Imprimante">
            <p>Imprimante</p>
          </div>
          <div class="carousel-item">
            <img src="laptop.png" alt="Scanner">
            <p>Scanner</p>
          </div>
          <div class="carousel-item">
            <img src="laptop.png" alt="Tablette">
            <p>Tablette</p>
          </div>
        </div>
        <button id="next">&#10095;</button>
      </div>
    </div>

  </section> 
  <!-- section du Produit -->
  <section class="produit">
    <h3 style="text-align: center; margin: 1px 0;">Produits Récents</h3>
    <div class="container">
    <?php foreach ($cheminsImages as $index => $chemin): ?>
      <div class="product">
          <img src="<?= htmlspecialchars($chemin) ?>" alt="Produit <?= $index + 1 ?>">
          <div class="product-name">Nom du produit <?= $index + 1 ?></div>
          <div class="price"><?= rand(10000, 150000) ?> FCFA</div> <!-- prix fictif -->
          <div class="quantity-controls">
              <button onclick="updateQty(<?= $index ?>, -1)">-</button>
              <input type="text" id="qty_<?= $index ?>" value="1" readonly>
              <button onclick="updateQty(<?= $index ?>, 1)">+</button>
          </div>
          <button class="add-to-cart">Ajouter au panier</button>
        </div>
      <?php endforeach; ?>
<!-- 
      <div class="product">
          <img src="iphone.png" alt="Iphone 16 pro max">
          <div class="product-name">Iphone 16 pro max</div>
          <div class="price">610 000 FCFA</div>
          <div class="quantity-controls">
              <button onclick="updateQty(1, -1)">-</button>
              <input type="text" id="qty_1" value="1" readonly>
              <button onclick="updateQty(1, 1)">+</button>
          </div>
          <button class="add-to-cart">Ajouter au panier</button>
      </div>

      <div class="product">
          <img src="rolex.png" alt="Montre rolex">
          <div class="product-name">Montre rolex</div>
          <div class="price">50 000 FCFA</div>
          <div class="quantity-controls">
              <button onclick="updateQty(2, -1)">-</button>
              <input type="text" id="qty_2" value="1" readonly>
              <button onclick="updateQty(2, 1)">+</button>
          </div>
          <button class="add-to-cart">Ajouter au panier</button>
      </div>

      <div class="product">
          <img src="table.png" alt="Les fondements">
          <div class="product-name">La table</div>
          <div class="price">30 000 FCFA</div>
          <div class="quantity-controls">
              <button onclick="updateQty(3, -1)">-</button>
              <input type="text" id="qty_3" value="1" readonly>
              <button onclick="updateQty(3, 1)">+</button>
          </div>
          <button class="add-to-cart">Ajouter au panier</button>
      </div>

      <div class="product">
          <img src="Casque MT.png" alt="Casque MT">
          <div class="product-name">Casque MT</div>
          <div class="price">70 000 FCFA</div>
          <div class="quantity-controls">
              <button onclick="updateQty(4, -1)">-</button>
              <input type="text" id="qty_4" value="1" readonly>
              <button onclick="updateQty(4, 1)">+</button>
          </div>
          <button class="add-to-cart">Ajouter au panier</button>
      </div>

      <div class="product">
          <img src="Chaussure.png" alt="Chaussure Basket">
          <div class="product-name">Chaussure Basket</div>
          <div class="price">110 000 FCFA</div>
          <div class="quantity-controls">
              <button onclick="updateQty(5, -1)">-</button>
              <input type="text" id="qty_5" value="1" readonly>
              <button onclick="updateQty(5, 1)">+</button>
          </div>
          <button class="add-to-cart">Ajouter au panier</button>
      </div>

      <div class="product">
          <img src="Clavier.png" alt="Clavier">
          <div class="product-name">Clavier</div>
          <div class="price">20 000 FCFA</div>
          <div class="quantity-controls">
              <button onclick="updateQty(6, -1)">-</button>
              <input type="text" id="qty_6" value="1" readonly>
              <button onclick="updateQty(6, 1)">+</button>
          </div>
          <button class="add-to-cart">Ajouter au panier</button>
      </div>

      <div class="product">
          <img src="iphone.png" alt="iphone">
          <div class="product-name">iphone</div>
          <div class="price">650 000 FCFA</div>
          <div class="quantity-controls">
              <button onclick="updateQty(7, -1)">-</button>
              <input type="text" id="qty_7" value="1" readonly>
              <button onclick="updateQty(7, 1)">+</button>
          </div>
          <button class="add-to-cart">Ajouter au panier</button>
      </div> -->
  <!-- section du categories par marque -->  
  </section>
  <section class="slider-container">
    <div class="marques-container">
      <h2>Catégorie Par marque</h2>
      <div class="marques">
        <button class="nav prev">&#10094;</button>
        <div class="marques-track">
          <div class="marques-item"><img src="samsung.png" alt="Samsung"></div>
          <div class="marques-item"><img src="apple.png" alt="Apple"></div>
          <div class="marques-item"><img src="hp.png" alt="HP"></div>
          <div class="marques-item"><img src="adidas.png" alt="Adidas"></div>
          <div class="marques-item"><img src="tecno.png" alt="Nike"></div>
          <div class="marques-item"><img src="table.png" alt="Lenovo"></div>

          <!-- Duplication pour boucle fluide -->
          <div class="marques-item"><img src="samsung.png" alt="Samsung"></div>
          <div class="marques-item"><img src="apple.png" alt="Apple"></div>
          <div class="marques-item"><img src="hp.png" alt="HP"></div>
          <div class="marques-item"><img src="adidas.png" alt="Adidas"></div>
          <div class="marques-item"><img src="tecno.png" alt="Nike"></div>
          <div class="marques-item"><img src="iphone.png" alt="Lenovo"></div>
        </div>
        <button class="nav next">&#10095;</button>
      </div>
    </div>
  </section>
  <!-- section du contact -->
  <section id="contact">
    <h2>Contactez-nous</h2>
    <form action="phpmailer/send_mail.php" method="POST">
      <input type="text" name="nom" placeholder="Nom" required>
      <input type="text" name="prenom" placeholder="Prénom" required>
      <input type="tel" name="numero" placeholder="Téléphone" required>
      <input type="email" name="email" placeholder="Email" required>
      <textarea name="message" placeholder="Votre message" required></textarea>
      <button type="submit">Envoyer</button>
      </form>
      <iframe 
        src="https://www.google.com/maps?q=12.6604604,-8.0126706&hl=fr&z=15&output=embed" 
        width="600" 
        height="450" 
        style="border:0;" 
        allowfullscreen="" 
        loading="lazy">
      </iframe>
  </section>
    <!-- section du pide de la page -->
  <footer class="footer">
      <div class="footer-container">
        <div class="footer-box">
          <h3>Liens rapides</h3>
          <a href="#"><i class="fas fa-angle-right"></i> Maison</a>
          <a href="#"><i class="fas fa-angle-right"></i> Meilleur vente</a>
          <a href="#formations"><i class="fas fa-angle-right"></i> Devenir partenaire</a>
          <a href="#contact"><i class="fas fa-angle-right"></i> A propos</a>
          <a href="#contact"><i class="fas fa-angle-right"></i> Aide</a>
        </div>
    
        <div class="footer-box">
          <h3>Liens utiles</h3>
          <a href="#"><i class="fas fa-angle-right"></i> Posez vos questions</a>
          <a href="#"><i class="fas fa-angle-right"></i> À propos de nous</a>
          <a href="#"><i class="fas fa-angle-right"></i> Politique de confidentialité</a>
          <!-- <a href="#"><i class="fas fa-angle-right"></i> Nos termes</a> -->
        </div>
    
        <div class="footer-box">
          <h3>Infos contact</h3>
          <a href="#"><i class="fas fa-phone"></i> +223 XX XX XX XX</a>
          <a href="#"><i class="fas fa-phone"></i> +223 XX XX XX XX</a>
          <a href="#"><i class="fas fa-envelope"></i> exemple@gmail.com</a>
          <a href="#"><i class="fas fa-map-marker-alt"></i> Bamako - Mali</a>
        </div>
    
        <div class="footer-box">
          <h3>Suivez-nous</h3>
          <a href="#"><i class="fab fa-facebook"></i> Facebook</a>
          <a href="#"><i class="fab fa-twitter"></i> Twitter</a>
          <a href="#"><i class="fab fa-instagram"></i> Instagram</a>
          <a href="#"><i class="fab fa-linkedin"></i> LinkedIn</a>
        </div>
      </div>
    
      <div class="footer-credit">
        Réalisé par <span></span> | Tous droits réservés Ndo © 2025
      </div>
  </footer>
    
  <script>
    // Exemple pour modifier dynamiquement la taille du logo
    function setLogoSize(width) {
      document.getElementById('logo').style.width = width;
    }
    // setLogoSize('80px'); // Exemple d’utilisation
  </script>

  <script>
    function updateQty(index, delta) {
        const input = document.getElementById("qty_" + index);
        let current = parseInt(input.value);
        if (isNaN(current)) current = 1;
        current += delta;
        if (current < 1) current = 1;
        input.value = current;
    }
  </script>

  <script>
    let slideIndex = 1;
    showSlide(slideIndex);

    function plusSlide(n) {
      showSlide(slideIndex += n);
    }

    function currentSlide(n) {
      showSlide(slideIndex = n);
    }

    function showSlide(n) {
      const slides = document.getElementsByClassName("slider-item");
      const dots = document.getElementsByClassName("slider-dot");

      if (n > slides.length) slideIndex = 1;
      if (n < 1) slideIndex = slides.length;

      for (let i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
      }

      for (let i = 0; i < dots.length; i++) {
        dots[i].classList.remove("active");
      }

      slides[slideIndex - 1].style.display = "block";
      dots[slideIndex - 1].classList.add("active");
    }

    setInterval(() => {
      plusSlide(1);
    }, 5000);
  </script> 
  <script src="script.js"></script>
  <script src="sliderscript.js"></script>


</body>
</html>