<?php

class CategoryService extends Service
{
    public function getCategory ($id)
    {
        $categoryRepo = $this->repo("Category");

        return $categoryRepo->getCategory($id);
    }

    public function getCategoryList ()
    {
        $categoryRepo = $this->repo("Category");

        return $categoryRepo->getCategoryList();
    }

    public function getCategoriesOnPage ($params)
    {
        $categoryRepo = $this->repo('Category');
        $totalPages = $categoryRepo->getTotalPages();

        if (!isset($params['page'])) $params['page'] = 1;

        $page = $params['page'];
        $page = intval($page);

        if ($page == false) $page = 1;

        if ($totalPages < 1) $page = 1;
        elseif ($totalPages < $page)  $page = $totalPages;

        $params['total_page'] = $totalPages;
        $params['now_page'] = $page;

        $params['data'] = $categoryRepo->getCategoriesOnPage($params['now_page']);

        return $params;
    }
    public function addCategory ($params)
    {
        $categoryRepo = $this->repo('Category');
        $title = '';
        if (isset($_POST['title']))
        {
            $title = $_POST['title'];
        }

        if ($title != '')
        {
            if (!$categoryRepo->isThereCategory($title))
            {
                $categoryRepo->addCategory($title);
                $params = $this->alertReturn($params, 'success', 'Basarili', 'Kategori basariyla eklendi.');
            }
            else
            {
                $params = $this->alertReturn($params, 'danger', 'Eklenemedi', 'Ayni kategori zaten mevcut.');
            }
        }
        else
        {
            $params = $this->alertReturn($params, 'warning', 'Bos alan', 'Lutfen bos alan birakmayin.');
        }

        return $params;
    }

    public function categoryUpdate ($params)
    {


        return $params;
    }

    public function categoryDelete ($params)
    {


        return $params;
    }

}