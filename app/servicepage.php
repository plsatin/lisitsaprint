<?php

//! Front-end processor
class ServicePage extends Controller {



    function servicelist($f3) {
        $db=$this->db;

        $f3->set('services', $db->exec(
            'SELECT * FROM services ORDER BY id;'));

        $f3->set('menuactive', 'services');
        $f3->set('inc','services.htm');
    }


    function service($f3,$args) {
        $db=$this->db;
        $product=new DB\SQL\Mapper($db,'services');
        // $id=empty($args['id'])?'':$args['id'];
        $id=($f3->get('GET.id')?:'');
        // $id=$f3->get('PARAMS.id');
        $product->load(array('id=?',$id));

        if ($product->dry()) {
            $f3->error(404);
            die;
        }
        else {
            $product->copyto('service');
            $f3->set('service', $product);

            $f3->set('menuactive', 'services');
            $f3->set('inc','service-item.htm');
        }
    }




}