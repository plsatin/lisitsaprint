<?php

//! Front-end processor
class HomePage extends Controller {

    //! Display content page
    function home($f3) {
        $db=$this->db;

        $f3->set('products', $db->exec('SELECT * FROM products ORDER BY id;'));

        // $f3->set('pagekeywords', '');
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


    //! Custom error page
    function error($f3) {
        $log=new Log('error.log');
        $log->write($f3->get('ERROR.text'));
        $trace = $f3->get('ERROR.trace');
        if (!isset($trace)) {
        foreach ($f3->get('ERROR.trace') as $frame)
            if (isset($frame['file'])) {
                // Parse each backtrace stack frame
                $line='';
                $addr=$f3->fixslashes($frame['file']).':'.$frame['line'];
                if (isset($frame['class']))
                    $line.=$frame['class'].$frame['type'];
                if (isset($frame['function'])) {
                    $line.=$frame['function'];
                    if (!preg_match('/{.+}/',$frame['function'])) {
                        $line.='(';
                        if (isset($frame['args']) && $frame['args'])
                            $line.=$f3->csv($frame['args']);
                        $line.=')';
                    }
                }
                // Write to custom log
                $log->write($addr.' '.$line);
            }
        }
        $f3->set('inc','error.htm');
    }



    function notes($f3) {
        $file = F3::instance()->read('notes.md');
        $html = Markdown::instance()->convert($file);
        $f3->set('content', $html);
        $f3->set('inc','article.htm');

    }

    function privacypolicy($f3) {
        $file = F3::instance()->read('privacypolicy.md');
        $html = Markdown::instance()->convert($file);
        $f3->set('content', $html);
        $f3->set('inc','article.htm');

    }

    function order($f3) {

        $f3->set('menuactive', 'contact');
        $f3->set('inc','order.htm');
    }

}