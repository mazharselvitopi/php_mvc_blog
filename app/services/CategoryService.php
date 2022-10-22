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

    public function getCategoryWithId ($params)
    {
        $categoryRepo = $this->repo('Category');

        $params['data'] = $categoryRepo->getCategory($params['id']);

        return $params;
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

    public function updateCategory ($params)
    {

        if (isset($params['id']) && isset($_POST['title']))
        {
            $id = $params['id'];
            $title = $_POST['title'];
            
            $categoryRepo = $this->repo('Category');
            
            $isThereTitle = $categoryRepo->getCategoryWithTitle($title);
            
            if (!$isThereTitle)
            {
                
                $categoryRepo->updateCategory($id, $title);

                $params = $this->alertReturn($params, "success", "Guncelleme basarili", "Guncelleme basarili oldu.");

            }
            else
            {
                if ($isThereTitle->getId() == $id)
                {
                    $params = $this->alertReturn($params, "warning", "Guncelleme basarisiz", "Degisen birsey yok. Onun icin sorgu calistirilmadi.");
                }
                else 
                {
                    $params = $this->alertReturn($params, "danger", "Guncelleme basarisiz", "Lutfen baska bir kategori adi deneyin. Giridiginiz kategori suanda var.");
                }
            }
        }

        return $params;
    }

    public function deleteCategory ($params)
    {

        $categoryRepo = $this->repo('Category');
        $isDelete = $categoryRepo->deleteCategory($params['id']);

        if ($isDelete)
        {
            $params = $this->alertReturn($params, 'danger', 'Silinemedi.', 'Bir problem var. Silinemedi.');
        }
        else
        {
            $params = $this->alertReturn($params, 'success', 'Basariyla silindi', 'Kategori basariyla silindi.');
        }
        return $params;
    }

}