<?php

class HomeController extends BaseController
{
    function index() {
        $posts = $this->model->getLatestPosts(5);
        $categories = $this->model->getCategories();
        $tags = $this->model->getTags();
        $this->postsSidebar = $posts;
        $this->posts = array_splice($posts, 0, 3);
        $this->categoriesSidebar = $categories;
        $this->tagsSidebar = $tags;
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
            $user = $_SESSION['username'];
            if (strlen($user) < 1){
                $this->setValidationError("comment_user", "Username too short.");
            }
            $content = $_POST['comment_content'];
            $user_id = $_SESSION['user_id'];
            if (strlen($content) < 1){
                $this->setValidationError("comment_content", "Comment content is empty.");
            } elseif (strlen($content) < 10) {
                $this->setValidationError("comment_content", "Comment content is too short.");
            }

            if ($this->formValid()){
                if ($this->model->createComment($user, $content, $id, $user_id)){
                    $this->addInfoMessage("Comment created.");
                    $this->redirect("home", "view", $id);

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

    function tag(int $id)
{
    $tag = $this->model->getTagById($id);
    $this->tag = $tag;
    $tagPosts = $this->model->getPostsByTag($id);
    if ($tagPosts) {
        $this->tagPosts = $tagPosts;
    } else {
        $this->addErrorMessage('Error: There are no posts in selected category');
        $this->redirect('');
    }
}

}
