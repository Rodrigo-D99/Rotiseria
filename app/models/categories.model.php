<?php


require_once './app/helpers/database.helper.php';
class CategoriesModel{
    private $db;

    function __construct(){
        $this->db = $this->db = DataBase::dataBase();
    }


    function getAll(){
        $query = $this->db->prepare('SELECT * FROM categories');
        $query->execute();
        $categories = $query->fetchAll(PDO::FETCH_OBJ);

        return $categories;
    }

    function delete($id){
        try{
            $query = $this->db->prepare('DELETE FROM categories WHERE id_category =?');
            $query->execute(array($id));
        }
        catch(PDOException $e) {
            error_log('PDO Exception: '.$e->getMessage());
            die('No se puede borrar esta categoria');
        }
    }

    function update($id, $category){
        $query = $this->db->prepare('UPDATE categories SET category =? WHERE id_category =?');
        $query->execute(array($id, $category));
        var_dump($query->errorInfo());
    }

    function add($category){
        $query = $this->db->prepare('INSERT INTO categories(category) VALUES(?)');
        $query->execute(array($category));
    }


}