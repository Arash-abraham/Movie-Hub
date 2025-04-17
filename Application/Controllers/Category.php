<?php
    namespace Application\Controllers;
    use Application\Model\Category as CategoryModel;

    class Category extends Controller {
        public function index() {
            $category = new CategoryModel;
            $categories = $category->all();
            return $this->View('Panel.category.index',compact('categories'));
        }
        public function create() {
            $category = new CategoryModel;
            $categories = $category->all();
            return $this->View('Panel.category.create', compact('categories'));
        }
        public function store() {
            $category = new CategoryModel();
            $category->insert($_POST);
            return $this->redirect('category');
        }
        public function edit($id) {
            $category = new CategoryModel();
            $categories = $category->find($id);
            return $this->View('Panel.category.edit', compact('categories'));    
        }
        public function update() {
            $category = new CategoryModel();
            $category->update($_POST);
            // print_r($_POST);
            return $this->redirect('category');
        }
        public function delete($id) {
            $category = new CategoryModel();
            $category->delete($id,$_POST);
            return $this->redirect('category');
        }

    }
?>
