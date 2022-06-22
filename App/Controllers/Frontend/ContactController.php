<?php

namespace App\Controllers\Frontend;

use Core\View;




/**
 * Account controller
 *
 * PHP version 7.0
 */
class ContactController extends \Core\Controller
{
    public function indexAction()
    {
      View::renderTemplate('/frontend/contact.html');
    }
}