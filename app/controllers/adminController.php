<?php
class AdminController extends Controller
{
    public function indexActionGetRequest ($params = [])
    {
        $this->renderUserLevelAdmin('admin/index', $params);
    }

    public function userActionGetRequest ($params = [])
    {
        $userService = $this->service('User');
        $params = $userService->getUsersOnPage($params);

        $this->renderUserLevelAdmin('admin/users', $params);
    }

    public function userUpdateGetRequest ($params = [])
    {

    }

    public function userUpdatePostRequest ($params = [])
    {

    }

    public function userDeleteGetRequest ($params = [])
    {

    }

    public function userDeletPostRequest ($params = [])
    {
        
    }
}