
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="author" content="VotreSociété">
  <link rel="shortcut icon" href="favicon.png">

  <meta name="description" content="Créez votre compte sur notre site de fournitures professionnelles" />
  <meta name="keywords" content="fournitures, inscription, compte" />

  <!-- Bootstrap CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
  <title>Inscription | NomDuSite</title>

  <style>
    .register-section {
      background-color: #f8f9fa;
      min-height: 100vh;
      display: flex;
      align-items: center;
      padding: 2rem 0;
    }
    .register-card {
      border: none;
      border-radius: 10px;
      box-shadow: 0 5px 15px rgba(0,0,0,0.1);
      overflow: hidden;
    }
    .register-header {
      background-color: #343a40;
      color: white;
      padding: 1.5rem;
      text-align: center;
    }
    .register-body {
      padding: 2rem;
      background-color: white;
    }
    .form-control:focus {
      border-color: #343a40;
      box-shadow: 0 0 0 0.2rem rgba(52, 58, 64, 0.25);
    }
    .password-strength {
      height: 5px;
      margin-top: 5px;
      background-color: #e9ecef;
      border-radius: 3px;
      overflow: hidden;
    }
    .password-strength-bar {
      height: 100%;
      width: 0%;
      transition: width 0.3s ease;
    }
    .is-invalid {
      border-color: #dc3545;
    }
    .invalid-feedback {
      display: none;
      color: #dc3545;
      font-size: 0.875em;
    }
    .was-validated .form-control:invalid ~ .invalid-feedback,
    .form-control.is-invalid ~ .invalid-feedback {
      display: block;
    }
  </style>
</head>

<body>

  <!-- Start Header/Navigation -->
  <nav class="custom-navbar navbar navbar navbar-expand-md navbar-dark bg-dark" arial-label="Navigation">
    <div class="container">
      <a class="navbar-brand" href="index.php">Fournitures<span>Pro</span></a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsMain" aria-controls="navbarsMain" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsMain">
        <ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">
          <li><a class="nav-link" href="index.php">Accueil</a></li>
          <li><a class="nav-link" href="shop.php">Boutique</a></li>
          <li><a class="nav-link" href="about.php">À propos</a></li>
          <li><a class="nav-link" href="contact.php">Contact</a></li>
        </ul>

        <ul class="custom-navbar-cta navbar-nav mb-2 mb-md-0 ms-5">
          <li><a class="nav-link active" href="login.php"><img src="images/user.svg"></a></li>
          <li><a class="nav-link" href="cart.php"><img src="images/cart.svg"></a></li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- End Header/Navigation -->

  <!-- Start Register Section -->
  <div class="register-section">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
          <div class="register-card">
            <div class="register-header">
              <h3>Créez votre compte</h3>
              <p class="mb-0">Accédez à votre espace client et bénéficiez de nos services</p>
            </div>
            
            <div class="register-body">
              <?php if (isset($errors['general'])): ?>
                <div class="alert alert-danger"><?= $errors['general']; ?></div>
              <?php endif; ?>
              
              <form id="registerForm" method="POST" novalidate>
                <div class="mb-3">
                  <label for="name" class="form-label">Nom complet <span class="text-danger">*</span></label>
                  <input type="text" class="form-control <?= isset($errors['name']) ? 'is-invalid' : '' ?>" 
                         id="name" name="name" value="<?= htmlspecialchars($_POST['name'] ?? '') ?>" required>
                  <div class="invalid-feedback"><?= $errors['name'] ?? '' ?></div>
                </div>
                
                <div class="mb-3">
                  <label for="email" class="form-label">Adresse email <span class="text-danger">*</span></label>
                  <input type="email" class="form-control <?= isset($errors['email']) ? 'is-invalid' : '' ?>" 
                         id="email" name="email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required>
                  <div class="invalid-feedback"><?= $errors['email'] ?? '' ?></div>
                </div>
                
                <div class="mb-3">
                  <label for="password" class="form-label">Mot de passe <span class="text-danger">*</span></label>
                  <input type="password" class="form-control <?= isset($errors['password']) ? 'is-invalid' : '' ?>" 
                         id="password" name="password" required>
                  <div class="invalid-feedback"><?= $errors['password'] ?? '' ?></div>
                  <div class="password-strength mt-2">
                    <div class="password-strength-bar" id="passwordStrengthBar"></div>
                  </div>
                  <small class="text-muted">Minimum 8 caractères</small>
                </div>
                
                <div class="mb-4">
                  <label for="confirm_password" class="form-label">Confirmez le mot de passe <span class="text-danger">*</span></label>
                  <input type="password" class="form-control <?= isset($errors['confirm_password']) ? 'is-invalid' : '' ?>" 
                         id="confirm_password" name="confirm_password" required>
                  <div class="invalid-feedback"><?= $errors['confirm_password'] ?? '' ?></div>
                </div>
                
                <div class="d-grid mb-3">
                  <button type="submit" class="btn btn-dark btn-lg">S'inscrire</button>
                </div>
                
                <div class="text-center">
                  <p>Vous avez déjà un compte ? <a href="login.php">Connectez-vous</a></p>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- End Register Section -->

  <!-- Start Footer Section -->
  <footer class="footer-section">
    <div class="container relative">
      <div class="row g-5 mb-5">
        <div class="col-lg-4">
          <div class="mb-4 footer-logo-wrap"><a href="#" class="footer-logo">Fournitures<span>Pro</span></a></div>
          <p class="mb-4">Votre fournisseur de matériel professionnel de qualité depuis 2023.</p>
        </div>
        <div class="col-lg-8">
          <div class="row links-wrap">
            <div class="col-6 col-sm-6 col-md-3">
              <ul class="list-unstyled">
                <li><a href="#">À propos</a></li>
                <li><a href="#">Services</a></li>
                <li><a href="#">Blog</a></li>
              </ul>
            </div>
            <div class="col-6 col-sm-6 col-md-3">
              <ul class="list-unstyled">
                <li><a href="#">Support</a></li>
                <li><a href="#">FAQ</a></li>
                <li><a href="#">Contact</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>

      <div class="border-top copyright">
        <div class="row pt-4">
          <div class="col-lg-6">
            <p class="mb-2 text-center text-lg-start">&copy; <?= date('Y'); ?> FournituresPro. Tous droits réservés.</p>
          </div>
        </div>
      </div>
    </div>
  </footer>
  <!-- End Footer Section -->

  <script src="js/bootstrap.bundle.min.js"></script>
  
  <script>
    // Validation côté client et indicateur de force du mot de passe
    document.addEventListener('DOMContentLoaded', function() {
      const passwordInput = document.getElementById('password');
      const passwordStrengthBar = document.getElementById('passwordStrengthBar');
      const form = document.getElementById('registerForm');
      
      // Indicateur de force du mot de passe
      passwordInput.addEventListener('input', function() {
        const password = this.value;
        let strength = 0;
        
        // Longueur minimale
        if (password.length >= 8) strength += 1;
        
        // Contient des chiffres
        if (password.match(/\d/)) strength += 1;
        
        // Contient des lettres minuscules et majuscules
        if (password.match(/[a-z]/) && password.match(/[A-Z]/)) strength += 1;
        
        // Contient des caractères spéciaux
        if (password.match(/[^a-zA-Z0-9]/)) strength += 1;
        
        // Mise à jour de la barre de force
        const width = strength * 25;
        passwordStrengthBar.style.width = width + '%';
        
        // Couleur en fonction de la force
        if (strength < 2) {
          passwordStrengthBar.style.backgroundColor = '#dc3545'; // Rouge
        } else if (strength < 4) {
          passwordStrengthBar.style.backgroundColor = '#ffc107'; // Jaune
        } else {
          passwordStrengthBar.style.backgroundColor = '#28a745'; // Vert
        }
      });
      
      // Validation avant soumission
      form.addEventListener('submit', function(event) {
        if (!form.checkValidity()) {
          event.preventDefault();
          event.stopPropagation();
        }
        
        form.classList.add('was-validated');
      }, false);
    });
  </script>
</body>
</html>