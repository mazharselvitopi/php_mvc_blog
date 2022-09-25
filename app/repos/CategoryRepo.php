<?php 
class CategoryRepo extends Repo 
{
    public function getCategory ($id)
    {
        $query = "select * from categories where id = ?";
        $category = $this->fetch($query, [$id]);
        
        return $this->getCategoryEntity($category);
    }

    public function getCategoryList ()
    {
        $query = "select * from categories";
        $categories = $this->fetchAll($query);
        $categoryEntityListEntity = [];
        
        foreach ($categories as $category) {
            $categoryEntityListEntity[] = $this->getCategoryEntity($category); 
        }

        return $categoryEntityListEntity;
    }

    public function getCategoryEntity ($category)
    {
        $categoryEntity = $this->entity("Category");
        $categoryEntity ->setId ($category['id'])
                        ->setTitle($category['title'])
                        ->setCreatedDate($category['created_date'])
                        ->setUpdatedDate($category['updated_date']);
        
        return $categoryEntity;
    }

}