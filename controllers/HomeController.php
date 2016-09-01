<?php

class HomeController extends BaseController
{
    function index() {
        $posts = $this->model->getLatestPosts(5);
        $this->postsSidebar = $posts;
        $this->posts = array_splice($posts, 0, 3);
    }
	
	function view(int $id) {
        $post = $this->model->getPostById($id);
        if ($post){
            $this->post = $post;
        }
        else{
            $this->addErrorMessage('Error: This post does not exist');
            $this->redirect('');
        }

        $comments = $this->model->getCommentsByPost($id);
        $this->commentsByPost = $comments;

        if ($this->isPost){
            $title = $_POST['comment_title'];
            if (strlen($title) < 1){
                $this->setValidationError("comment_title", "Title too short.");
            }
            $content = $_POST['comment_content'];
            if (strlen($content) < 1){
                $this->setValidationError("comment_content", "Comment content is empty.");
            }

            if ($this->formValid()){
                $userId = $_SESSION['user_id'];
                if ($this->model->createComment($title, $content, $userId, $id)){
                    $this->addInfoMessage("Comment created.");

                    $comments = $this->model->getCommentsByPost($id);
                    $this->commentsByPost = $comments;
                }
                else{
                    $this->addErrorMessage("Error: cannot create comment.");
                }
            }
        }
    }

}
