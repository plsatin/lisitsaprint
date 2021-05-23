<?php

//! Front-end processor
class ProductPage extends Controller {



    function product($f3,$args) {
        $db=$this->db;
        $product=new DB\SQL\Mapper($db,'products');
        // $id=empty($args['id'])?'':$args['id'];
        $id=($f3->get('GET.id')?:'');
        // $id=$f3->get('PARAMS.id');
        $product->load(array('id=?',$id));

        if ($product->dry()) {
            $f3->error(404);
            die;
        }
        else {
            $product->copyto('product');
            $f3->set('product', $product);
            $f3->set('pagetitle', $product->title);
            $f3->set('pageimage', $product->image_path);
            $f3->set('pagekeywords', $product->keywords);
            $f3->set('pagedescription', $product->description);
            $f3->set('menuactive', 'products');
            $f3->set('inc','product-item.htm');
        }
    }





}