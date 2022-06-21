<?php

namespace App\Controllers\Admin;

use Core\View;
use App\Models\Order;





/**
 * Account controller
 *
 * PHP version 7.0
 */
class OrderController extends \Core\Controller
{

            /**
     * Require the user to be authenticated before giving access to all methods in the controller
     *
     * @return void
     */
    
    protected function before()
    {
        $this->requireLogin();
    }
    /**
     * Validate if email is available (AJAX) for a new signup or an existing user.
     * The ID of an existing user can be passed in in the querystring to ignore when
     * checking if an email already exists or not.
     *
     * @return void
     */
    public function indexAction()
    {
        $orders = Order::getAll();

        View::renderTemplate('Admin/Order/index.html', ['orders' => $orders]);
    }

    public function viewAction()
    {

    }

    public function updateAction()
    {
        
    }

    public function historyAction()
    {

    }
}