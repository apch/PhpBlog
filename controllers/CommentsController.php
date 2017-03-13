<?php

class CommentsController extends BaseController
{
    function onInit()
    {
        $this->authorize();
    }

    function index() 
    {
        $this->comments = $this->model->getAll();
    }

    public function delete(int $id)
    {
        if ($this->isPost){
            if ($this->model->delete($id)){
                $this->addInfoMessage("Comment deleted.");
            }
            else{
                $this->addErrorMessage("Error: cannot delete comment.");
            }
            $this->redirect("comments");
        }
        else{
            $comment = $this->model->getById($id);
            if (!$comment){
                $this->addErrorMessage("Comment does not exist.");
                $this->redirect("comments");
            }
            $this->comment = $comment;
        }
    }

    public function edit(int $id)
    {
        if ($this->isPost){
            $title = $_POST['comment_user'];
            if (strlen($title) < 1){
                $this->setValidationError("comment_user", "Username too short.");
            }

            $content = $_POST['comment_content'];
            if (strlen($content) < 1){
                $this->setValidationError("comment_content", "Comment content is empty.");
            }

            $date = $_POST['comment_date'];
            $dateRegex = '/^\d{2,4}-\d{1,2}-\d{1,2}( \d{1,2}:\d{1,2}(:\d{1,2})?)?$/';
            if (!preg_match($dateRegex, $date)){
                $this->setValidationError("comment_date", "Invalid date!");
            }

            if ($this->formValid()){
                if ($this->model->edit($id, $title, $content, $date)){
                    $this->addInfoMessage("Comment edited.");
                    $this->redirect("comments");
                }
                else{
                    $this->addErrorMessage("Error: cannot edit comment.");
                }
                $this->redirect('comments');
            }

        }
        $comment = $this->model->getById($id);
        if (!$comment){
            $this->addErrorMessage("Comment does not exist.");
            $this->redirect("comments");
        }
        $this->comment = $comment;
    }
}
