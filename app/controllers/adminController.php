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
        $userService = $this->service('User');



        $params = $userService->deleteUser($params);

        $params = $userService->getUsersOnPage($params);

        $this->renderUserLevelAdmin('admin/users', $params );
    }

    public function userAddActionPostRequest ($params = [])
    {
        $userService = $this->service('User');

        $params = $userService->addUser($params);

        $this->renderUserLevelAdmin('admin/useradd', $params);
    }

    public function userAddActionGetRequest ($params = [])
    {
        $this->renderUserLevelAdmin('admin/useradd', $params);
    }

    public function categoriesActionGetRequest ($params = [])
    {
        $categoryService = $this->service('Category');

        $params = $categoryService->getCategoriesOnPage ($params);

        $this->renderUserLevelAdmin('admin/categories', $params);
    }
}