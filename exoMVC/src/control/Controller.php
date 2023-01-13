<?php
/*** Contrôleur du site des articles. ***/
class Controller{
    private $view;
   private $ArticleStorage;
    public function __construct(View $veiw, ArticleStorage $articleStorage)
    {
        $this->view = $veiw;
        $this->ArticleStorage = $articleStorage;
    }
     public function showInformation($id){
   
    /* Un article est demandée, on la récupère en BD */
       $article = $this->ArticleStorage->read(htmlspecialchars ($id));
       if($article!==null){
        /* L'article existe, on prépare la page */
        $this->view->makeArticlePage($id, $article);
       }else{
        /* l'article n'existe pas*/
        return $this->view->makeUnknownArticlePage();
       }
    }
    //liste d'article
    public function showList(){
        $this->view->makeListPage($this->ArticleStorage->readAll());
    }
    public function saveNewArticle( $data){
       //on cree  l'instance d'article
        $articleBuilder = new ArticleBuilder($data);
        if($articleBuilder->isValid()){
            /* On construit le nouveau article */
        $newArticle = $articleBuilder->createArticle();
        /* On l'ajoute en BD */
        $id = $this->ArticleStorage->create($newArticle);
      
      			/* On affiche un message que l'article a été creer */
       $this->view->displayArtileCreationSuccess($id);
       			/* On supprime la session */
        unset($_SESSION['currentNewArticle']);
        }else{
            $_SESSION['currentNewArticle'] = $articleBuilder;
            $this->view->displayArtileCreationFailure();
        }
    }
    //cette fonction repond la suppression d'un article
    public function askArticleDeletion($id){
        $articleAsuprimer = $this->ArticleStorage->read($id);
        if($articleAsuprimer !== null){
            $this->view->makeArticleDeletionPage($id, $articleAsuprimer );
        }else {
            $this->view->makeUnknownArticlePage();
        }
    }
    
    public function delecteArticlele($id){
		/* On récupère l'article en BD */
        $article =  $this->ArticleStorage->read($id);
        if($article === null){
        /* L'article n'existe pas en BD */ 
            $this->view->makeUnknownArticlePage();
        }else{
            //on supprime l'article
       $this->ArticleStorage->delete($id);
       //on l'affiche un message que l'article a été creer
       $this->view->displayArticleDelete($id);
        }
       
    }
    
    public function NewArticle(){
        /* Affichage du formulaire de création
		* avec les données par défaut. */
        $articleBuilder = new articleBuilder([]);
        //on verifie si la session existe
        if(key_exists('currentNewArticle', $_SESSION)){
        $this->view->makeArticleCreationPage($_SESSION['currentNewArticle']);
        }else{
            $this->view->makeArticleCreationPage($articleBuilder);
        }
        
    }
    public function modifiedArticle($id){
        /* On récupère en BD l'article à modifier */
        $article = $this->ArticleStorage->read($id);
        if($article === null){
            /* L'article n'existe pas en BD */
            $this->view->makeUnknownArticlePage();
        }else{
            $cf = ArticleBuilder::buildFormArticle($article);
            /* Préparation de la page de formulaire */
            $this->view->makeArticleModifPage($id, $cf);
        }
        
    }
    public function saveArticleModifications($id, array $data){
        /* On récupère en BD l'article à modifier */
        $article = $this->ArticleStorage->read($id);
        if($article === null){
            $this->view->makeUnknownArticlePage();
        }else{
            $v = new ArticleBuilder($data);
			/* on valid  des données */
            if($v->isValid()){
                $v->updateArticle($article);
                //on le met à jour  dans la base de donne
                $valid = $this->ArticleStorage->update($id, $article);
                if(!$valid){
                    throw new Exception("cet article n'est pas valide");
                }
				/* Préparation de la page d'article */
                $this->view->makeArticlePage($id, $article);
            }else{
                $this->view->makeArticleModifPage($id, $v);
            }
            
        }
    }
}