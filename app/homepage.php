<?php

//! Front-end processor
class HomePage extends Controller {

    //! Display content page
    function home($f3) {
        $db=$this->db;

        $f3->set('products', $db->exec('SELECT * FROM products ORDER BY id;'));

        // $f3->set('sitekeywords', '');
        $f3->set('menuactive', 'products');
        $f3->set('inc','portfolio.htm');
        

    }

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