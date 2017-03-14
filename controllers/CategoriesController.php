<?php

class CategoriesController extends BaseController
{
    function onInit()
    {
        $this->authorize();
    }

    function index() 
    {
        $this->categories = $this->model->getAll();
    }

    function create() 
    {
        if ($this->isPost){
            $category = $_POST['category_title'];
            if (strlen($category) < 1){
                $this->setValidationError("category_title", "Category title too short.");
            }
            
            if ($this->formValid()){
                if ($this->model->create($category)){
                    $this->addInfoMessage("Category created.");
                    $this->redirect("categories");
                }
                else{
                    $this->addErrorMessage("Error: cannot create category.");
                }
            }
        }
    }

    public function delete(int $id)
    {
        if ($this->isPost){
            if ($this->model->delete($id)){
                $this->addInfoMessage("Category deleted.");
            }
            else{
                $this->addErrorMessage("Error: cannot delete category.");
            }
            $this->redirect("categories");
        }
        else{
            $category = $this->model->getById($id);
            if (!$category){
                $this->addErrorMessage("Category does not exist.");
                $this->redirect("categories");
            }
            $this->category = $category;
        }
    }

    public function edit(int $id)
    {
        if ($this->isPost){
            $category = $_POST['category_title'];
            if (strlen($category) < 1){
                $this->setValidationError("category_title", "Category too short.");
            }

            if ($this->formValid()){
                if ($this->model->edit($id, $category)){
                    $this->addInfoMessage("Category edited.");
                    $this->redirect("categories");
                }
                else{
                    $this->addErrorMessage("Error: cannot edit category.");
                }
                $this->redirect('categories');
            }

        }
        $category = $this->model->getById($id);
        if (!$category){
            $this->addErrorMessage("Category does not exist.");
            $this->redirect("categories");
        }
        $this->category = $category;
    }
}
