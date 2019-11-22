<?php
/**
 * Created by PhpStorm.
 * User: Giomlly
 * Date: 11/16/2019
 * Time: 9:22 PM
 */
App::uses('AppController', 'Controller');

class HomeController extends AppController{


    /**
     * display method
     *
     * @return void
     */
    public function display(){

    }

    /**
     * about method
     *
     * @return void
     */
    public function about(){

    }

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('display', 'about');
    }
}
