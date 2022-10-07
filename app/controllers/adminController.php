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

    public function userUpdateActionGetRequest ($params = [])
    {
        $userService = $this->service('User');

        $params = $userService->getUserWithId($params);

        $this->renderUserLevelAdmin('admin/userUpdate', $params);


    }

    public function userUpdateActionPostRequest ($params = [])
    {
        $userService = $this->service('User');

        $params = $userService->updateUser($params);

        $params = $userService->getUserWithId($params);

        $this->renderUserLevelAdmin('admin/userUpdate', $params);
    }

    public function userDeleteActionGetRequest ($params = [])
    {

    }

    public function userDeleteActionPostRequest ($params = [])
    {

    }
}