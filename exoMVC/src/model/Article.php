<?php 
/* Représente un article. */

class Article{
    private $titre, $contenu, $author, $date;
    public function __construct($titre, $contenu, $author, $date)
    {
        $this->titre = $titre;
        $this->contenu = $contenu;
        $this->author = $author;
        $this->date = $date;
    }  
    public function getTitre(){
        return $this->titre;
    }
    //renvoi le contenu
    public function getContenu(){
        return $this->contenu;
    }
    //renvoi l'auteur
    public function getAuthor(){
        return $this->author;
    }
    public function getDate(){
        return $this->date;
    }
    public function setTitre($titre){
        return $this->titre = $titre;
    }
    public function setContenu($contenu){
        return $this->contenu = $contenu;
    }
    public function setAuthor($author){
        return $this->author = $author;
    }
    public function setDate($date){
        return $this->date=$date;
    }
}