<?php
class ArticleBuilder{
    private $data;
    private $error;
    public function __construct($data)
    {
        $this->data = $data;
        $this->error = [];
    }
    	/* Renvoie la valeur d'un champ en fonction de la référence passée en argument. */
    public function getData($ref){
        return (array_key_exists($ref, $this->data))?$this->data[$ref]:'';
    }
    /* renvoi l'erreur */
    public function getErorr(){
        return $this->error;
    }

    public function titreRef(){
        return "titre";
    }
    public function contenuRef(){
        return "contenu";
    }
    public function authorRef(){
        return "author";
    }
    //renvoie 
    public function dateRef(){
        return "date";
    }
    /* Crée une nouvelle instance d'article avec les données
	 * fournies */
    public function createArticle(){
        $titre = htmlspecialchars($this->data['titre']);
        $contenu = htmlspecialchars($this->data['contenu']);
        $author = htmlspecialchars($this->data['author']);
        $date = htmlspecialchars($this->data['date']);
        return new Article($titre, $contenu, $author, $date);
    }
    /* Vérifie la validitée des données envoyées par le client,
	 * et renvoie un tableau des erreurs à corriger. */
    public function isValid(){
        if(!key_exists('titre', $this->data) || $this->data['titre'] == ''){
            $this->error['titre'] = "<em>Veuillez mettre le titre de l'article</em>";
        }
        if(!key_exists('contenu', $this->data) || $this->data['contenu']==''){
            $this->error['contenu'] = "<em>Vuillez ajouter un contenu</em>";
        }
        if(!key_exists('author', $this->data) || $this->data['author']==''){
            $this->error['author'] = "<em> Ajouter un auteur SVP!!!</em>";
        }
        if(!key_exists('date', $this->data) || $this->data['date'] <= 0){
            $this->error['date'] ="<em>Veuilez mettre une date valide</em>";
        }
        return count($this->error) === 0;
    }
   /* Met à jour une instance d'un article avec les données*/
    public function updateArticle(Article $article){
    if(key_exists("titre", $this->data)){
        $article->setTitre($this->data['titre']);
    }
    if(key_exists("contenu", $this->data)){
        $article->setContenu($this->data['contenu']);
    }
    if(key_exists("author", $this->data)){
        $article->setAuthor($this->data['author']);
    }
    if(key_exists("date", $this->data)){
        $article->setDate($this->data['date']);
    }
    }
    /* Renvoie une nouvelle instance d'articleBuilder avec les données
 	 * modifiables de l'article passée en argument. */
    public static function  buildFormArticle(Article $article){
        return new ArticleBuilder(array(
            "titre" => $article->getTitre(),
            "contenu" => $article->getContenu(),
            "author" => $article->getAuthor(),
            "date"  => $article->getDate()
        ));
    }
}