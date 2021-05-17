<?php

//! Front-end processor
class HomePage extends Controller {

    //! Display content page
    function home($f3) {
        $db=$this->db;

        // $products=new DB\SQL\Mapper($db,'products');
        // $products->load();

        $f3->set('products', $db->exec('SELECT * FROM products ORDER BY id;'));

        // Заполняем данные об организации в преременную company
        // $f3->set('company', $db->exec('SELECT name, fullname, address, phone, email, facebook_lnk, twitter_lnk, linkedin_lnk, skype_lnk, ok_lnk, vk_lnk, gplus_lnk  FROM contacts WHERE id = 1;'));


        $f3->set('menuactive', 'products');
        $f3->set('inc','portfolio.htm');
         
        // $products = new Product();
        // $products->load();


        // if ($products->dry()) {
        //     $f3->error(404);
        //     die;
        // } else {
        //     $results=array();

        //     // $results['products'] = $products;
        //     // $f3->set('results',$results);
        //     $f3->set('products',$products);
        //     $f3->set('inc','portfolio.htm');
        // }

        // foreach ($products as $obj)
        //     // echo $obj->title.', '.$obj->summary;
        //     echo $obj[0];


        // $page=new DB\SQL\Mapper($db,'pages');
        // $slug=empty($args['slug'])?'':$args['slug'];
        // $page->load(array('slug=?',$slug));
        // $f3->set('menu',
        //     $db->exec('SELECT slug,title FROM pages ORDER BY position;'));
        // if ($page->dry()) {
        //     $f3->error(404);
        //     die;
        // }
        // else {
        //     $page->copyto('page');
        //     $f3->set('comments',
        //         $db->exec(
        //             'SELECT * FROM comments '.
        //             'WHERE slug=? '.
        //             'ORDER BY posted',
        //             $slug
        //         )
        //     );
        //     $f3->set('inc','page.htm');
        // }






        // $f3->set('content','portfolio.htm');
        // echo View::instance()->render('layout.htm');


    }








    // $f3->route('GET /',
    //     function($f3) {
    //         $db = new DB\SQL('sqlite:db/db.sqlite');
    //         $results=array();

    //         $products=$db->exec('SELECT * FROM products');
    //         $results['products'] = $products;


    //         // $f3->set('DB',new DB\SQL('sqlite:db/db.sqlite'));
    
    //         // class Product extends \DB\SQL\Mapper {
    //         //     public function __construct() {
    //         //         parent::__construct( \Base::instance()->get('DB'), 'products' );
    //         //     }
    //         // }
            
    //         // $products = new Product();
    //         // $products->load();

    //         // print_r($products);

    //         // $product = new \DB\Cortex($db, 'products');

    //         // $product->load(['id = ?', 3]);
    //         // echo $product->title; // shouts out: Jack Ripper

    //         // $product->load('id > ?', 0);
    //         // foreach ($product as $obj)
    //         //         echo $obj->title.', '.$obj->summary;

    //         // $products=new Axon('products');
    //         //     $products=$products->afind();
    //         //     $f3->set('products',$products);

    //         //     foreach ($products as $obj)
    //         //         echo $obj->title.', '.$obj->summary;




    //         $f3->set('results',$results);
    //         $f3->set('content','portfolio.htm');
    //         echo View::instance()->render('layout.htm');
    //     }
    // );



    function about($f3) {
        $db=$this->db;

        $f3->set('contacts', $db->exec('SELECT * FROM contacts ORDER BY id;'));

        $f3->set('menuactive', 'about');
        $f3->set('inc','about.htm');
    }

    function contact($f3) {
        $f3->set('menuactive', 'contact');
        $f3->set('inc','contact.htm');
    }







}