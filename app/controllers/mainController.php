<?php
class MainController extends Controller
{

/**
 * alert types
 * 1 - primary
 * 2 - secondary
 * 3 - success
 * 4 - danger
 * 5 - warning
 * 6 - info
 * 7 - light
 * 8 - dark
 * 
 */

    public function loginActionPostRequest ($params = [])
    {
        if (isset($params['is_entered'])) {
            
            if ($params['is_entered'] != true) {
                $userService = $this->service('User');
                $data = [];
                if (isset($_POST['email']) && isset($_POST['password'])){
                    
                    $data = $userService->isCorrectEmailAndPassword($_POST['email'], $_POST['password']);
                }

                if ($data != null) {
                    $_SESSION['username'] = $data['email'];
                    $_SESSION['password'] = $data['password'];
                    $_SESSION['user_level'] = $data['user_level'];
                    $this->redirect('main/index');
                }else {
                    $this->alertReturn($params, 
                    'danger', 
                    'Kullanici yok', 
                    'Lutfen bir daha deneyin', 
                    $this->config['root_url'].'main/index', 
                    'Anasayfaya gidin.' );
                }

            } else {
                $this->redirect('main/index');
            }
        }
        //$this->redirect('main/index');
    }

    public function logoutActionGetRequest ($params = [])
    {
        if ($params['is_entered'] == true) {
            $params['is_entered'] = false;
            session_destroy();
            $this->redirect('main/index');
        } else {
            $this->alertReturn($params, 'warning', 'Yetkisiz erisim istegi', 'Bu sayfaya erisiminiz yok',
                                $this->config['root_url'].'main/index', 'Anasayfaya gidin...');
        }
    }

    public function signupActionPostRequest ($params = [])
    {
        $userService = $this->service('User');

        $params = $userService->addUser($params);

        $this->render('returnAlert', $params);
        
    }


    public function indexActionGetRequest ($params = [])
    {

        $articleService = $this->service("Article");
        
        $params = $articleService->getArticles($params);

        $categoryService = $this->service("Category");
        
        $params['categories'] = $categoryService->getCategoryList();
        
        $this->render("index", $params);

    }

    public function readActionGetRequest ($params = [])
    {

       $articleId = $params['article'];

       $articleService = $this->service("Article");

       $params['article'] = $articleService->getArticle($articleId);

       $categoryService = $this->service('Category');
       $params['categories'] = $categoryService->getCategoryList();

       $params['now_category'] = $params['article']->getCategoryId();

       $this->render('readArticle', $params );
    }
    

}