<?php
    namespace Application\Controllers;

    use Application\Model\Category;
    use Application\Model\Article;

    class Home extends Controller{
        public function index() {
            $category = new Category();
            $categories = $category->all();
            $article = new Article();
            $articles = $article->all();
            return $this->View('App.index' , compact('categories' , 'articles'));
        }
        public function category($id) {
            $ob_category = new Category();
            $categories = $ob_category->all();
            $ob_category = new Category();
            $category = $ob_category->find($id);
            $ob_category = new Category();
            $articles = $ob_category->articles($id);
            return $this->View('App.category' , compact('categories' , 'category' , 'articles'));

        }
        public function show($id) {
            $category = new Category();
            $categories = $category->all();
            $article = new Article();
            $articles = $article->find($id);
            return $this->View('App.show' , compact('categories' , 'articles'));
        }

    }
?>
