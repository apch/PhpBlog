<?php

class HomeController extends BaseController
{
    function index() {
        $posts = $this->model->getLatestPosts(5);
        $categories = $this->model->getCategories();
        $this->postsSidebar = $posts;
        $this->posts = array_splice($posts, 0, 3);
        $this->categoriesSidebar = $categories;
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


        if ($this->isLoggedIn){

            $fullname = $this->model->getUsernameById($_SESSION['user_id']);
            $this->fullname = $fullname;
        }

        if ($this->isPost){
            $user = $_POST['comment_user'];
            if (strlen($user) < 1){
                $this->setValidationError("comment_user", "Username too short.");
            }
            $content = $_POST['comment_content'];
            if (strlen($content) < 1){
                $this->setValidationError("comment_content", "Comment content is empty.");
            }

            if ($this->formValid()){
                if ($this->model->createComment($user, $content, $id)){
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

    function category(int $id)
    {
        $category = $this->model->getCategoryById($id);
        $this->category = $category;
        $categoryPosts = $this->model->getPostsByCategory($id);
        if ($categoryPosts) {
            $this->categoryPosts = $categoryPosts;
        } else {
            $this->addErrorMessage('Error: There are no posts in selected category');
            $this->redirect('');
        }
    }

}
