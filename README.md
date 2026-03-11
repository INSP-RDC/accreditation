## 🛠 Installation de la base de données

1. Localisez le script SQL dans le répertoire : `assets/docs/data.sql`.
2. **Importation :** - Exécutez `data.sql` via votre outil de gestion de base de données (MySQL Workbench, PHPMyAdmin, etc.).
   - *Note :* Si la base de données existe déjà, vous pouvez ignorer l'instruction `CREATE DATABASE`.
3. **Données de test :** Exécutez le fichier `fixtures.sql` situé dans le même répertoire pour peupler la base.

## ⚙️ Configuration

1. Ouvrez le fichier `config.php` à la racine du projet.
2. Modifiez les paramètres de connexion pour qu'ils correspondent à votre environnement local :
   ```php
   define('DB_HOST', 'localhost');
   define('DB_NAME', 'votre_base');
   define('DB_USER', 'root');
   define('DB_PASS', 'mot_de_passe');