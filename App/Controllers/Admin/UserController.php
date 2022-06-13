<?php

namespace App\Controllers\Admin;

use Core\View;
use App\Models\User;


/**
 * Account controller
 *
 * PHP version 7.0
 */
class UserController extends \Core\Controller
{

    /**
     * Validate if email is available (AJAX) for a new signup or an existing user.
     * The ID of an existing user can be passed in in the querystring to ignore when
     * checking if an email already exists or not.
     *
     * @return void
     */
    public function indexAction()
    {
        $users = User::getAll();

        View::renderTemplate('Admin/User/index.html', ['users' => $users]);
    }

    public function viewAction()
    {
        
    }


}