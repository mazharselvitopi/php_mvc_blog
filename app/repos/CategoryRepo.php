<?php 
class CategoryRepo extends Repo 
{
    public function getCategory ($id)
    {
        $query = "select * from categories where id = ?";
        $category = $this->fetch($query, [$id]);
        
        return $this->getCategoryEntity($category);
    }

    public function isThereCategory ($title)
    {
        $query = "select * from categories where title = ?";
        $category = $this->fetch($query, [$title]);
        if ($category != null)
            return true;
        else
            return false;
    }

    public function getCategoryWithTitle ($title)
    {
        $query = "select * from categories where title = ?";

        $category = $this->fetch($query, [$title]);
        if (!$category) return false;
        else
        return $this->getCategoryEntity($category);
    }

    public function getTotalCategories ()
    {
        $query = "select count(*) as total from categories";

        $data = $this->fetch($query);

        return $data['total'];
    }

    public function getTotalPages ()
    {
        $totalCategories = $this->getTotalCategories();

        $pageLimit = $this->config['category_page_limit'];

        $totalPages = $totalCategories / $pageLimit;

        if ($totalPages > intval($totalPages))
        {
            $totalPages = intval($totalPages + 1);
        } else {
            $totalPages = intval($totalPages);
        }

        return $totalPages;
    }

    public function getCategoriesOnPage ($page)
    {

        $pageLimit = $this->config['category_page_limit'];

        $totalPages = $this->getTotalPages();

        $page--;
        $offset = $page * $pageLimit;

        $query = "select * from categories order by id limit ?, ?";

        $stmt = $this->db->prepare($query);

        $stmt->bindValue (1, $offset, PDO::PARAM_INT);
        $stmt->bindValue (2, $pageLimit, PDO::PARAM_INT);

        $stmt->execute();

        $categoryList = $stmt->fetchAll();

        $data = [];

        foreach ($categoryList as $category)
        {
            $categoryEntity = $this->getCategoryEntity($category);
            $data[] = $categoryEntity;
        }

        return $data;
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

    public function addCategory ($title)
    {
        $query = "insert into categories (title) values (?)";

        // true false
        $stmt = $this->query($query, [$title]);
    }

    public function updateCategory ($id, $title)
    {
        $query = "update categories set title = ? where id = ?";

        // true false
        return $this->query($query, [$title, $id]);
    }

    public function  deleteCategory ($id)
    {
        $query = "delete from categories where id = ?";

        return $this->query($query, [$id]);

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