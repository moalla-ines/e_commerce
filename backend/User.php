<?php
class User {
    private $db;
    private $id;
    private $name;
    private $email;
    private $passwrd; // Note: Il serait mieux de renommer en 'password' pour la cohérence
    private $numtel;
    private $pays;
    private $role;

    

    public function register(array $data): bool {
        // Validation des données
        if (empty($data['name']) || empty($data['email']) || empty($data['password'])) {
            throw new Exception('Name, email and password are required');
        }

        // Vérification email existant
        if ($this->findUserByEmail($data['email'])) {
            throw new Exception('Email already exists');
        }

        // Hash du mot de passe
        $hashedPassword = password_hash($data['passwrd'], PASSWORD_DEFAULT);

        // Requête d'insertion
        $this->db->query('INSERT INTO users 
                         (name, email, passwrd, numtel, pays, role) 
                         VALUES 
                         (:name, :email, :passwrd, :numtel, :pays, :role)');

        // Bind des valeurs
        $this->db->bind(':name', trim($data['name']));
        $this->db->bind(':email', trim($data['email']));
        $this->db->bind(':passwrd', $hashedPassword);
        $this->db->bind(':numtel', $data['numtel'] ?? null);
        $this->db->bind(':pays', $data['pays'] ?? null);
        $this->db->bind(':role', $data['role'] ?? 'user'); // Rôle par défaut

        // Exécution
        if ($this->db->execute()) {
            $this->id = $this->db->lastInsertId();
            $this->name = trim($data['name']);
            $this->email = trim($data['email']);
            $this->numtel = $data['numtel'] ?? null;
            $this->pays = $data['pays'] ?? null;
            $this->role = $data['role'] ?? 'user';
            
            return true;
        }
        return false;
    }

    /**
     * Trouver un utilisateur par email
     * @param string $email
     * @return bool - True si trouvé, false sinon
     */
    public function findUserByEmail(string $email): bool {
        $this->db->query('SELECT id FROM users WHERE email = :email');
        $this->db->bind(':email', trim($email));
        $this->db->execute();
        
        return $this->db->rowCount() > 0;
    }

    /**
     * Connexion utilisateur
     * @param string $email
     * @param string $passwrd
     * @return bool - True si succès
     * @throws Exception - Si échec connexion
     */
    public function login(string $email, string $passwrd): bool {
        $this->db->query('SELECT * FROM users WHERE email = :email');
        $this->db->bind(':email', trim($email));
        $row = $this->db->single();

        if (!$row) {
            throw new Exception('Email not found');
        }

        if (!password_verify($passwrd, $row->passwrd)) {
            throw new Exception('Incorrect password');
        }

        // Mise à jour des attributs
        $this->id = $row->id;
        $this->name = $row->name;
        $this->email = $row->email;
        $this->numtel = $row->numtel;
        $this->pays = $row->pays;
        $this->role = $row->role;

        return true;
    }

    /**
     * Obtenir un utilisateur par ID
     * @param int $id
     * @return object|null - Objet utilisateur ou null
     */
    public function getUserById(int $id): ?object {
        $this->db->query('SELECT * FROM users WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    /**
     * Mettre à jour le profil utilisateur
     * @param array $data - Nouvelles données
     * @return bool - True si succès
     */
    public function updateProfile(array $data): bool {
        $query = 'UPDATE users SET 
                 name = :name,
                 email = :email,
                 numtel = :numtel,
                 pays = :pays
                 WHERE id = :id';

        $this->db->query($query);
        $this->db->bind(':id', $this->id);
        $this->db->bind(':name', trim($data['name']));
        $this->db->bind(':email', trim($data['email']));
        $this->db->bind(':numtel', $data['numtel'] ?? null);
        $this->db->bind(':pays', $data['pays'] ?? null);

        if ($this->db->execute()) {
            $this->name = trim($data['name']);
            $this->email = trim($data['email']);
            $this->numtel = $data['numtel'] ?? null;
            $this->pays = $data['pays'] ?? null;
            return true;
        }
        return false;
    }

    // Getters
    public function getId(): ?int { return $this->id; }
    public function getName(): ?string { return $this->name; }
    public function getEmail(): ?string { return $this->email; }
    public function getNumtel(): ?string { return $this->numtel; }
    public function getPays(): ?string { return $this->pays; }
    public function getRole(): string { return $this->role; }
}