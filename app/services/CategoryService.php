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


}