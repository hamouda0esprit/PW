<?php 
    class ClientC{
    public string $nom;
    public string $prenom;
    public string $numero;
    public string $email;
    public string $password;
    function __construct($nom,$prenom,$numero,$email,$password) {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->numero = $numero;
        $this->email = $email;
        $this->password = $password;
    }
    
}
?>