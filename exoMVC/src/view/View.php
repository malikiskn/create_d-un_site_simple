<?php
class View{
    private $title;
    private $content;
    private $router;
    protected $feedback;
    
    
    public function __construct(Router $router, $feedback)
    {
        $this->router = $router;
        $this->feedback = $feedback;

    }
    public function render(){
        require_once("squelette.php");
    }
    
    public function makeArticlePage($id, Article $article){
       $this->title = " l'article de ".$article->getAuthor()."<br>";
        $this->content = $article->getContenu()."<br><br><br><br>";
        $this->content .= "<strong>".$article->getTitre(). " </strong><em>à été crée le ".$article->getDate()."</em><br>";
        $this->content.= '<ul><li><a href ="'.$this->router->getArticleAskDeletionURL($id).'">Supprimer l\' article</a><br></li>';
        $this->content.= '<li><a href ="'.$this->router->ArticleModfiedPage($id).'"> Modifier l\'article </a><li></ul>';


        }
        public function makeUnknownArticlePage(){
            $this->title = "Article inconnu";
            $this->content ="<strong>cet article n'a pas été crée ou à été supprimer!!</strong>";
        }
    
        
        public function makeListPage( $data){
            $this->title = "Les listes des articles crées";
            foreach($data as $value){
               $this->content.= '<a href="'.$this->router->getArticleURL($value['id']).'">'.$value['titre'].'</a><br><br><br>';
            }
        }
        
        public function makeArticleCreationPage(ArticleBuilder $ArticleBuilder){

            $titre = $ArticleBuilder->titreRef();
            $contenu = $ArticleBuilder->contenuRef() ;
            $author = $ArticleBuilder->authorRef();
            $date = $ArticleBuilder->dateRef();
            $titreError =isset($ArticleBuilder->getErorr()[$titre])?$ArticleBuilder->getErorr()[$titre]:'';
            $contenuError =isset($ArticleBuilder->getErorr()[$contenu])?$ArticleBuilder->getErorr()[$contenu]:'';
            $authorError =isset($ArticleBuilder->getErorr()[$author])?$ArticleBuilder->getErorr()[$author]:'';
            $dateError= isset($ArticleBuilder->getErorr()[$date])?$ArticleBuilder->getErorr()[$date]:'';
            $this->title ="Ajouter un article";
            $this->content = '<form action="'.$this->router->getArticleSaveURL().'" method="POST">'."\n";
            $this->content.= '<p><label> Titre :<input type="text" name="'.$$titre.'" value="'.$ArticleBuilder->getData($titre).'"><span>'.$titreError.'</span></label></p><br>';
            $this->content.= 'Contenu : <br><textarea name="'.$contenu.'" id="'.$ArticleBuilder->getData($contenu).'" cols="40" rows="5" ></textarea><span>'.$contenuError.'<br>';
            $this->content.= '<p><label> Auteur :<input type="text" name="'.$author.'" value="'.$ArticleBuilder->getData($author).'"><span>'.$authorError.'</span></label></p><br>';
            $this->content.= '<p><label>Date de création :<input type="date" name="'.$date.'" value="'.$ArticleBuilder->getData($date).'"><span>'.$dateError.'</span></label></p><br>';
            $this->content.= '<input type="submit" value="Ajouter">';    
            $this->content .= '</form>';
        }
        public function makeArticleDeletionPage($id, $article){
            $this->title = "page de Suppression";
            $this->content = 'voulez vous supprimer  '.$article->getTitre().'?<br><br>';
            $this->content .= '<a href="'.$this->router->getArticleDelectionURL($id).'">Confirmer?</a>';
        }
        public function displayArticleDelete($id){
            $this->title = 'votre article a été bien supprimer';
        }
        public function displayArtileCreationSuccess($id){
            $this->router->POSTredirect($this->router->getArticleURL($id), "Bravo ! vous avez créer un article");
        }
        public function displayArtileCreationFailure(){
            $this->router->POSTredirect($this->router->getArticleCreationURL(), "l'article n'a pas été créer");
        }

        public function getMenu(){
          return array( 
            
            "Accueil" => $this->router->getHomeURL(), 
            "Créer un article  " => $this->router->getArticleCreationURL(),
            "liste des articles crées   " => $this->router ->lisArticle(),
                
          ) ;      
        }
        public function makeArticleModifPage($id, ArticleBuilder $ArticleBuilder){
            $titre = $ArticleBuilder->titreRef();
            $contenu = $ArticleBuilder->contenuRef() ;
            $author = $ArticleBuilder->authorRef();
            $date = $ArticleBuilder->dateRef();
            $titreError =isset($ArticleBuilder->getErorr()[$titre])?$ArticleBuilder->getErorr()[$titre]:'';
            $contenuError =isset($ArticleBuilder->getErorr()[$contenu])?$ArticleBuilder->getErorr()[$contenu]:'';
            $authorError =isset($ArticleBuilder->getErorr()[$author])?$ArticleBuilder->getErorr()[$author]:'';
            $dateError= isset($ArticleBuilder->getErorr()[$date])?$ArticleBuilder->getErorr()[$date]:'';
            $this->title = "Modifier l'article";
            $this->content  = '<form action='.$this->router->updateModifiedArticle($id).' method="POST">';
            $this->content.= '<p><label> Titre :<input type="text" name="'.$$titre.'" value="'.$ArticleBuilder->getData($titre).'"><span>'.$titreError.'</span></label></p><br>';
            $this->content.= '<p><label> Contenu :<input type="text" size="30" [b]style="width:600px;"[/b] name="'.$contenu.'" value="'.$ArticleBuilder->getData($contenu).'"><span>'.$contenuError.'</span></label></p><br>';
            $this->content.= '<p><label> Auteur :<input type="text" name="'.$author.'" value="'.$ArticleBuilder->getData($author).'"><span>'.$authorError.'</span></label></p><br>';
            $this->content.= '<p><label>Date de création :<input type="date" name="'.$date.'" value="'.$ArticleBuilder->getData($date).'"><span>'.$dateError.'</span></label></p><br>';
            $this->content.= '<input type="submit" value="modifier">';    
            $this->content .= '</form>';  
        
               
         }  


        
        public function makeHomePage(){
            $this->title = "Bienvenue sur ma page de creation des articles";
            $this->content = "Bonjour vous pouvez ajouter, supprimer ou modifier un article<br> remplir le champs cela permet <strong>d'aider </strong>
            d'autre personne qui voudrait découvrir tout autre article sa date de création son contenu, le nom de l'auteur, et le nom de la personne .<br>  <em>ajouter autant d'article que vous voulez ça sera stocké dans la base de donnée</em><br>";

        }
}
?>
