<?php
    namespace Application\Controllers;
    use Application\Model\Article as ArticleModel;
    use Application\Model\Category;

    class Article extends Controller {
        public function index() {
            $article = new ArticleModel();
            $articles = $article->all();
            return $this->View('Panel.article.index', compact('articles'));
        }
        public function create() {
            $category = new Category();
            $categories = $category->all();
            return $this->View('Panel.article.create', compact('categories'));
        }
        public function store() {
            $article = new ArticleModel();
            $article->insert($_POST);
            return $this->redirect('article');
        }

        public function edit($id) {
            $category = new Category();
            $categories = $category->all();
            $ob_article = new ArticleModel();
            $article = $ob_article->find($id);
            return $this->View('Panel.article.edit', compact('categories','article'));    
        }
        public function update() {
            $article = new ArticleModel();
            $article->update($_POST);
            // print_r($_POST);
            return $this->redirect('article');
        }
        public function delete($id) {
            $article = new ArticleModel();
            $article->delete($id,$_POST);
            return $this->redirectBack();
        }

    }
?>
