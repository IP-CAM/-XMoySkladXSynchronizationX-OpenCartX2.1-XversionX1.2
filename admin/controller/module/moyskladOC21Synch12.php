<?php
ini_set('display_errors',1);
error_reporting(E_ALL ^E_NOTICE);

class ControllermodulemoyskladOC21Synch12 extends Controller {

    #TODO надо написать еще функцию по отправке заказаов 
    
    public function index() {
        
        $this->load->language('module/moyskladOC21Synch12');
        
        $this->document->addStyle('view/stylesheet/moyskladOC21Synch12.css');
        $this->document->addScript('view/javascript/jquery/tabs.js');
        
        $this->document->setTitle($this->language->get('heading_title'));
        $this->load->model('extension/module');

        $this->load->model('setting/setting');
         
        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
            
            $this->model_setting_setting->editSetting('moyskladOC21Synch12', $this->request->post);

        }

        $data['entry_username'] = $this->language->get('entry_username');
        $data['entry_password'] = $this->language->get('entry_password');
        $data['text_tab_setting'] = $this->language->get('text_tab_setting');
        $data['entry_save'] = $this->language->get('entry_save');
        $data['text_tab_import'] = $this->language->get('text_tab_import');
        $data['entry_import'] = $this->language->get('entry_import');
        $data['text_tab_author'] = $this->language->get('text_tab_author');
        $data['button_save'] = $this->language->get('button_save');
        $data['button_cancel'] = $this->language->get('button_cancel');
        $data['setting_module'] = $this->language->get('setting_module');
        $data['import_text'] = $this->language->get('import_text');
        $data['import_button'] = $this->language->get('import_button');
        $data['entry_order_status_to_exchange'] = $this->language->get('entry_order_status_to_exchange');
        $data['entry_order_status_to_exchange_not'] = $this->language->get('entry_order_status_to_exchange_not');
        $data['download'] = $this->language->get('download');
        $data['download_image'] = $this->language->get('download_image');

        $data['text_tab_orders'] = $this->language->get('text_tab_orders');
        $data['text_order'] = $this->language->get('text_order');
        $data['export_order'] = $this->language->get('export_order');

        
 
        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        }
        else {
            $data['error_warning'] = '';
        }

         

        if (isset($this->error['moyskladOC21Synch12_username'])) {
            $data['error_moyskladOC21Synch12_username'] = $this->error['moyskladOC21Synch12_username'];
        }
        else {
            $data['error_moyskladOC21Synch12_username'] = '';
        }

        if (isset($this->error['moyskladOC21Synch12_order_status_to_exchange'])) {
            $data['error_moyskladOC21Synch12_order_status_to_exchange'] = $this->error['moyskladOC21Synch12_order_status_to_exchange'];
        }
        else {
            $data['error_moyskladOC21Synch12_order_status_to_exchange'] = '';
        }
        

        if (isset($this->error['moyskladOC21Synch12_password'])) {
            $data['error_moyskladOC21Synch12_password'] = $this->error['moyskladOC21Synch12_password'];
        }
        else {
            $data['error_moyskladOC21Synch12_password'] = '';
        }

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_extension'),
            'href' => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL')
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('module/moyskladOC21Synch12', 'token=' . $this->session->data['token'], 'SSL')
        );

        $data['action'] = $this->url->link('module/moyskladOC21Synch12', 'token=' . $this->session->data['token'], 'SSL');

        //используем ссылку в форме для импорта товара
        $data['action_import'] = $this->url->link('module/moyskladOC21Synch12/getMethodImport', 'token=' . $this->session->data['token'], 'SSL');

        //используем ссылку в форме для загрузки картинок
        $data['action_get_images'] = $this->url->link('module/moyskladOC21Synch12/downloadImage', 'token=' . $this->session->data['token'], 'SSL');

        //используем ссылку в форме для выгрузки заказов
        $data['action_get_orders'] = $this->url->link('module/moyskladOC21Synch12/getOrders', 'token=' . $this->session->data['token'], 'SSL');

        $data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');
        

        if (isset($this->request->post['moyskladOC21Synch12_username'])) {
            $data['moyskladOC21Synch12_username'] = $this->request->post['moyskladOC21Synch12_username'];
        }
        else {
            $data['moyskladOC21Synch12_username'] = $this->config->get('moyskladOC21Synch12_username');
        }


        if (isset($this->request->post['moyskladOC21Synch12_order_status_to_exchange'])) {
            $data['moyskladOC21Synch12_order_status_to_exchange'] = $this->request->post['moyskladOC21Synch12_order_status_to_exchange'];
        }
        else {
            $data['moyskladOC21Synch12_order_status_to_exchange'] = $this->config->get('moyskladOC21Synch12_order_status_to_exchange');
        }


        if (isset($this->request->post['moyskladOC21Synch12_password'])) {
            $data['moyskladOC21Synch12_password'] = $this->request->post['moyskladOC21Synch12_password'];
        }
        else {
            $data['moyskladOC21Synch12_password'] = $this->config->get('moyskladOC21Synch12_password');
        }

       
        //получаем доступ к модели модуля и создаем таблицы в базе
        $this->load->model('tool/moyskladOC21Synch12');
        $this->model_tool_moyskladOC21Synch12->createTables();

        //получаем с базы количество картинок
        $data['count_image'] = $this->model_tool_moyskladOC21Synch12->countImage();


        //Подключаем все статусы ордеров
        $this->load->model('localisation/order_status');
        $order_statuses = $this->model_localisation_order_status->getOrderStatuses();
        foreach ($order_statuses as $order_status) {
            $data['order_statuses'][] = array(
                'order_status_id' => $order_status['order_status_id'],
                'name'            => $order_status['name']
            );
        }
 
        
        // Группы
        $this->load->model('customer/customer_group');
        $data['customer_groups'] = $this->model_customer_customer_group->getCustomerGroups();
 
        $this->template = 'module/moyskladOC21Synch12.tpl';
        $this->children = array(
            'common/header',
            'common/footer' 
        );

        $data['heading_title'] = $this->language->get('heading_title');
        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');
        $this->response->setOutput($this->load->view('module/moyskladOC21Synch12.tpl', $data));
 
    }

    private function validate() {

        if (!$this->user->hasPermission('modify', 'module/moyskladOC21Synch12')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        return !$this->error;

    }

    //тут храниться инфа о клиенте
    protected function dataClient(){
        //получаем данные в переменные
        $mas = [
            "login" => (!empty($this->config->get('moyskladOC21Synch12_username'))) ? $this->config->get('moyskladOC21Synch12_username') : false,
            "pass" => (!empty($this->config->get('moyskladOC21Synch12_password'))) ? $this->config->get('moyskladOC21Synch12_password') : false
        ];

        return $mas;
    }

    //вызываем метод в форме
    public function getMethodImport(){
        if(!empty($_POST['start'])){

                //по клику запускаем API МойСклад для получения всего товара
                $this->getAllProduct(0);

                //после завершения функции делаем редирект в модуль
                $this->response->redirect($this->url->link('module/moyskladOC21Synch12', 'token=' . $this->session->data['token'], 'SSL'));
            }
    }
  
    //получаем весь товар, что есть (рекурсия)
    public function getAllProduct($position){
     
        $urlProduct = "entity/product?offset=$position&limit=100";
         //$urlProduct = "entity/product?offset=$position&limit=20";


        $product = $this->getNeedInfo($urlProduct);

        //если дошли до конца списка то выходим из рекурсии 
        if(!empty($product["rows"])){

            for($i=0; $i<100; $i++){
                //делаем провекру, что бы товар был с именем
                if(!empty($product["rows"][$i]["name"])){
 
                    //передаем uuid для проверки существует ли такой uuid в базе или нет
                    $this->searchUUID($product["rows"][$i]["id"],$product["rows"][$i]);
                }
            }

            //вызов рекурсии  
            $this->getAllProduct($position+$i);
        
         } 
   
    }
    
    
    //получаем нужную информацию меняя поля URL
   public function getNeedInfo($url){

    $result = "https://".$this->dataClient()['login'].":".$this->dataClient()['pass']."@"."online.moysklad.ru/api/remap/1.1/".$url;
 
    return json_decode(file_get_contents($result), true);
    }


    //делаем поиск в таблице uuid  на id  товара.
    //Если нету то добавляем товар если есть id  товара то обновляем.
    public function searchUUID($uuid,$mas){
        
        //получаем доступ к модели модуля
        $this->load->model('tool/moyskladOC21Synch12');
        $findUUID = $this->model_tool_moyskladOC21Synch12->modelSearchUUID($uuid);

        //проверяем есть ли картинка
        if(!empty($mas["image"]["meta"]["href"])){
            
            //заносим в массив данные о картинке (имя, ссылка)
            $image_data = [
                "name_image"    =>  $mas["image"]["filename"],
                "image_url"     =>  $mas["image"]["meta"]["href"]
            ];

            //добавляем инфу о кэше в базу
            $this->model_tool_moyskladOC21Synch12->addImagCache($image_data);

            $image =  'catalog/moysklad/'.$image_data["name_image"];

        }else{
            $image = "";
        }
        
        
        //проверяем существует ли цена продажи
        if(!empty($mas['salePrices'][0]['value'])){
      $price = number_format($mas['salePrices'][0]['value']/100, 2, '.', '');
        
        }else{
      $price = 0;
        }
 
        $data = [
            'model'                 =>  "",
            'sku'                   =>  "",
            'upc'                   =>  "",
            'ean'                   =>  "",
            'jan'                   =>  "",
            'isbn'                  =>  "",
            'mpn'                   =>  "",
            'location'              =>  "",
            'quantity'              =>  (!empty($this->getQuantity($mas['name']))) ? $this->getQuantity($mas['name']): 0,
            'minimum'               =>  "",
            'subtract'              =>  "",
            'stock_status_id'       =>  "",
            'date_available'        =>  "",
            'manufacturer_id'       =>  "",
            'shipping'              =>  "",
            'price'                 =>  $price,
            'points'                =>  "",
            'weight'                =>  (!empty($mas['weight'])) ? $mas['weight']: 0,
            'weight_class_id'       =>  "",
            'length'                =>  "",
            'width'                 =>  "",
            'height'                =>  "",
            'length_class_id'       =>  "",
            'status'                =>  1,
            'tax_class_id'          =>  "",
            'sort_order'            =>  "",
            'image'                 =>  $image,
            'product_description'   =>  [
                $this->config->get('config_language_id') =>[
                    'name'          => $mas['name'],
                    'description'   => (!empty($mas['description'])) ? $mas['description']: " ",
                    'tag'           =>  "",
                    'meta_title'    =>  "",
                    'meta_description'  =>  "",
                    'meta_keyword'  =>  "",
                ],
            ],
            
            'uuid'                  =>  $uuid,
            'keyword'               =>  "",
 

        ];
       
        
        //если нашли id товара то update, если нет то insert
        if(!empty($findUUID)){
            $this->updateProduct($findUUID,$data);
        }else{
            $this->insertProduct($data);
        }
        
        return true;

    }
    
    
    //метод по обновлению инфы товара, параметр id товара
    public function updateProduct($id,$data){
        
        //получаем доступ к модели модуля
        $this->load->model('tool/moyskladOC21Synch12');
        $this->model_tool_moyskladOC21Synch12->updateProduct($id,$data);
    }
    
    //метод по добавлению нового товара
    public function insertProduct($data){
         
        //подгружаем стандартный метод опенкарт по добавлению нового товара
        $this->load->model('catalog/product');
        $product_id = $this->model_catalog_product->addProduct($data);
        
        //получаем доступ к модели модуля
        $this->load->model('tool/moyskladOC21Synch12');
        
        //делаем проверку если товар добавлен то заносим его id  в таблицу uuid
        if(!empty($product_id)){
            $data = [
               'product_id' =>  $product_id,
               'uuid'       =>  $data['uuid'],   
            ];
            
          //передаем массив в модель модуля  
         $this->model_tool_moyskladOC21Synch12->modelInsertUUID($data);
        }
        
        return true;
    }
    
   //функция по скачиванию картинок из моего склада
   function downloadImage(){

        //Ловим данные (количество картинок которые нужно скачать) и передаем функцию для скачивания
        if(!empty($_POST['count_images'])){

            //получаем доступ к модели модуля
            $this->load->model('tool/moyskladOC21Synch12');
            $masImage = $this->model_tool_moyskladOC21Synch12->getImage((int)$_POST['count_images']);
 
            //проверяем существует ли директория в которую будем заносить картинки, если нет то создаем
            if (empty(file_exists("../image/catalog/moysklad"))) {
                 $dir_image = mkdir("../image/catalog/moysklad", 0777);

                 //даем права на создание файлов
                 chmod("../image/catalog/moysklad", 0777);

                 //Если папка не создалась выводим false
                 if(empty($dir_image)){
                     $dir_image = false;

                 }else{
                    $dir_image = "../image/catalog/moysklad/";
                 }

            }else{
                $dir_image = "../image/catalog/moysklad/";
            }

            //проверяем создалась ли нами папка + есть ли картинки для скачивания
            if(!empty($masImage) && !empty($dir_image)){

                for($i = 0; $i < count($masImage); $i++){
 
                    $ch = curl_init($masImage[$i]['image_url']);
                    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 20);  
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($ch, CURLOPT_USERPWD, $this->dataClient()['login'].":".$this->dataClient()['pass']);
                    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, array(   
                        'Accept: application/octet-stream',
                        'Content-Type: application/octet-stream')                                                           
                    );   
                    $response = curl_exec($ch);
                    curl_close($ch);

                 
                    //проверяем нету ли ошибок на стороне сервера, если нету то загружаем картинку
                    if(!empty($response)){
                        file_put_contents('../image/catalog/moysklad/'.$masImage[$i]['name_image'], $response);
                    } 
                }

                $this->model_tool_moyskladOC21Synch12->delImage(count($masImage));
 
                //после завершения функции делаем редирект в модуль
                $this->response->redirect($this->url->link('module/moyskladOC21Synch12', 'token=' . $this->session->data['token'], 'SSL'));

                return true;
            }
        }
    }

    //получаем количество доступного товара в "Остатках"
    public function getQuantity($name){
        $jsonAnswerServer = $this->getNeedInfo("entity/assortment?filter=name=".urlencode($name)); 
 
        //формируем результат по столбцу "Доступно" в моем складе
        $quantity = $jsonAnswerServer['rows'][0]['quantity'];
        return $quantity;
    }

    #TODO uuid товара нужно брать с таблицы uuid если нету там то делать запрос по имени и получить с моегосклада, если и там нету такого товара то генерить самому или отправить без ид

    #TODO данные для сбора: номер ордера, организация(как то получить ее имя), created(время создания заказа), агент, position(пример с позициями(количество, цена)), uuid товара, аккаунт ид(если можно где то достать), oc_order_product (quantity,price), имя товара

    //выгружаем все заказы в мойсклад
    public function getOrders(){
        //получаем из настроек какие ордера подгружать
        $order_status = $this->config->get('moyskladOC21Synch12_order_status_to_exchange');

        //по клику и выбраном статусе загружаем заказы в мойсклад
        if(!empty($_POST['get_orders']) && !empty($order_status)){
             
        }
    }


}
?>