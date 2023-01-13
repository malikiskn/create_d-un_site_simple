<?php
interface ArticleStorage{
 /* Renvoie l'article d'identifiant $id, ou null
	 * si l'identifiant ne correspond à aucun article. */

    public function read($id);

    /* Renvoie un tableau associatif id => article
    * contenant toutes les articles de la base. */

    public function readAll();

    /* Insère un nouveau article dans la base. Renvoie l'identifiant
	 * du nouveau article. */
    public  function create(Article $a);

    /* Supprime un article. Renvoie
	 * true si la suppression a été effectuée, false
	 * si l'identifiant ne correspond à aucun de ce article. */

    public function delete($id);
    
    /* Met à jour un article dans la base*/
    public function update($id, Article $v);
}