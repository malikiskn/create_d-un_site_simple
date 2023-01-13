<?php
class Router{
    private $articleStorage;
    protected $article ;
    public function __construct(ArticleStorage $articleStorage)
    {
        $this->articleStorage = $articleStorage;
       
    }
    public function main(){
        session_start();
        $feedback =key_exists('feedback', $_SESSION)?$_SESSION['feedback']:'';
       $_SESSION['feedback'] = '';
       $view = new View($this, $feedback);
       $controller = new Controller($view, $this->articleStorage);
		/* Analyse de l'URL*/
        /* Pas d'action demandée : par défaut on affiche
	 	 	 * la page d'accueil, sauf si article est demandé,
	 	 	 * auquel cas on affiche sa page. */
       if(array_key_exists('id', $_GET)){
        $controller ->showInformation($_GET['id']);
       }
       if(key_exists("liste", $_GET)){
        $controller ->showList();
       }
       if(key_exists('action', $_GET)){
        if($_GET['action'] == 'nouveau'){
        
          $controller->NewArticle();
        }
        if($_GET['action'] == 'sauverNouveau'){
            $controller->saveNewArticle($_POST);
        }
        if($_GET['action'] =='confirmDelecte' && !empty($_GET['id'])){
            $controller->askArticleDeletion($_GET['id']);
        }
        if($_GET['action'] == 'delecte' && !empty($_GET['id'])){
            $controller->delecteArticlele($_GET['id']);
        }
        if($_GET['action']=='modifier' && !empty($_GET['id'])){
            $controller->modifiedArticle($_GET['id']);
        }
        if($_GET['action'] == "sauverModifs"  && !empty($_GET['id'])){
            $controller->saveArticleModifications($_GET['id'], $_POST);
        }
       }
       /**on  affiche la page d'acueil */
       if(empty($_GET)){
        $view ->makeHomePage();
    
       }
       /* Enfin, on affiche la page préparée */
       $view ->render();

    }
    	/* URL de la page d'accueil */
    public function getHomeURL(){
        return "?";
    }
    /* URL pour la liste d'article  */
    public function lisArticle(){
        return "?liste";
    }
    /* URL de la page d'article d'identifiant $id */
    public function getArticleURL($id){
        return "?id=$id";
    }
    /* URL de la page de création d'un article */
    public function getArticleCreationURL(){
        return "?action=nouveau";
    }
    /* URL d'enregistrement d'un nouveau article
	 * (champ 'action' du formulaire) */
    public function getArticleSaveURL(){
        return "?action=sauverNouveau";
    }
    /* URL de suppression effective d'un article
	 * (champ 'action' du formulaire) */
    public function getArticleAskDeletionURL($id){
        return"?id=$id&amp;action=confirmDelecte";
    }
    /* URL de la page demandant la confirmation
	 * de la suppression d'un article */
    public function getArticleDelectionURL($id){
        return"?id=$id&amp;action=delecte";
    }
    /* feedback pour informer sur les resultats des actions*/
    public function POSTredirect($url, $feedback){
        $_SESSION['feedback'] = $feedback;
        header("Location: ".$url, true, 303);
    }
    	/* URL de la page d'édition d'un article existant */
    public function ArticleModfiedPage($id){
        return "?id=$id&amp;action=modifier";
        
    }
    /* URL d'enregistrement des modifications sur un
	 * article (champ 'action' du formulaire) */
    public function updateModifiedArticle($id){
        return "?id=$id&amp;action=sauverModifs";
    }
}