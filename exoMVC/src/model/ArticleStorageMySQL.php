<?php
class ArticleStorageMySQL implements ArticleStorage
{
    protected $db;
    public function __construct($pdo)

    {


        $this->db = $pdo;
    }
    /* Renvoie l'article d'identifiant id, ou null
	 * si l'identifiant ne correspond à aucun article. */
    public function read($id)
     {
        //Preparation de la requete
        $requete = "SELECT * FROM article WHERE id=:id";
        $stmt = $this->db->prepare($requete);
        $data = array(
            ":id" => $id,

        );
        $stmt->execute($data);
        $res = $stmt->fetch();
        if($res == true){
            return new Article($res['titre'], $res['contenu'], $res['author'], $res['date']);
        }else{
            return null;
        }

     }
     /* Renvoie un tableau associatif id => article
    * contenant toutes les articles de la base. */
    public function readAll()
    {
        $stmt = $this->db->prepare('SELECT * FROM article');
        $stmt->execute();
        $tableu = $stmt->fetchAll();
        return $tableu;
    }
    /* Supprime un article. Renvoie
	 * true si la suppression a été effectuée, false
	 * si l'identifiant ne correspond à aucun de ce article. */
    public function delete($id)
    {
        $rq = "DELETE FROM article WHERE id = :id";
        $stmt = $this->db->prepare($rq);
        $data = array(
            ":id" => $id,
        );
        $stmt->execute($data);
        return true;
    
    }
    /* Insère un nouveau article dans la base. Renvoie l'identifiant
	 * du nouveau article. */
    public function create(Article $a)
    {
        $rq = "INSERT INTO article (titre, contenu, author, date)VALUES(:titre, :contenu, :author, :date)" or die (print_r($this->db->errorInfo()));
        $stmt = $this->db->prepare($rq);
        $data = array(
            ":titre" => $a->getTitre(),
            ":contenu" => $a->getContenu(),
            ":author" => $a->getAuthor(),
            ":date" => $a->getDate()
        );
        $stmt->execute($data);
        return $this->db->lastInsertId();
    }
        /* Met à jour un article dans la base*/
    public function update($id, Article $article){
        if($this->read($id)){
        $requete = "UPDATE article SET  titre = :titre, contenu = :contenu,  author = :author, date =:date WHERE id = :id";
        $stmt = $this->db->prepare($requete);
        $data = array(
            ":id" => $id,
            ":titre" =>  $article->getTitre(),
            ":contenu" => $article->getContenu(),
            ":author"  =>   $article->getAuthor(),
            ":date"  => $article->getDate()
        );    
        $stmt->execute($data) ; 
        return true;
        }
        return false;  
    }
}
