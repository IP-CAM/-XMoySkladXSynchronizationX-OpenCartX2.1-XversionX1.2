<?php

class ModelToolMoyskladOC21Synch12 extends Model {

    //При инстализации модуля создаем таблицы
    public function createTables(){
        $sql =array();
        
        $sql[] = "
        
            
            CREATE TABLE IF NOT EXISTS `".DB_PREFIX."cache_image` (
              `name_image` varchar(255) NOT NULL,
              `image_url` text CHARACTER SET utf8 NOT NULL
             )  ENGINE=InnoDB DEFAULT CHARSET=utf8;

        ";
        
        $sql[] = "
                        
            CREATE TABLE IF NOT EXISTS `".DB_PREFIX."uuid` (
             `product_id` int(255) NOT NULL,
             `uuid_id` varchar(255) NOT NULL,
              PRIMARY KEY (`product_id`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

        ";


        foreach( $sql as $q ){
             $this->db->query( $q );
        }
        return true;
    }
 
    //функция для поиска в таблице uuid
    public function modelSearchUUID($uuid){
        $query = $this->db->query("SELECT product_id FROM `".DB_PREFIX."uuid` WHERE uuid_id = '$uuid' ");
        return $query->row;
    }
    
    //после удачного добавления товара в базу, заносим id  товара и uuid товара с моего 
    //склада в таблицу uuid для проверок существования товара
    public function modelInsertUUID($data){
      $this->db->query('INSERT INTO `'.DB_PREFIX.'uuid` SET product_id = ' . (int)$data["product_id"] . ', `uuid_id` = "' . $data["uuid"] . '"');  
      return true;
    }
 
    
    //обновляем информацию о товаре
    public function updateProduct($id,$data){
        $this->db->query("UPDATE " . DB_PREFIX . "product SET  quantity = '" . (int)$data['quantity'] . "',  price = '" . (float)$data['price'] . "', weight = '" . (float)$data['weight'] . "',  date_modified = NOW() WHERE product_id = '" . (int)$id['product_id'] . "'");

            if (isset($data['image'])) {
    $this->db->query("UPDATE " . DB_PREFIX . "product SET image = '" . $this->db->escape($data['image']) . "' WHERE product_id = '" . (int)$id['product_id'] . "'");
            }

            foreach ($data['product_description'] as $language_id => $value) {
    $this->db->query("UPDATE " . DB_PREFIX . "product_description SET name = '" . $this->db->escape($value['name']) . "', description = '" . $this->db->escape($value['description']) . "'  WHERE product_id = '" . (int)$id['product_id'] . "'");
            }
            
             return true;
     }

     //заносим в базу кэш картинки
     public function  addImagCache($data){
      $this->db->query('INSERT INTO `'.DB_PREFIX.'cache_image` SET name_image = "' . $data["name_image"] . '", `image_url` = "' . $data["image_url"] . '"');  
      return true;
     }

     //подсчитываем сколько картинок нужно скачать
     public function countImage(){
      $rewards = $this->db->query("SELECT name_image FROM `" . DB_PREFIX . "cache_image`");
      
      return $rewards->num_rows;

     }
}