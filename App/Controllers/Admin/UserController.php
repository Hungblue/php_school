<?php

namespace App\Controllers\Admin;

use App\Auth;
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
        $users = User::getAll();
        View::renderTemplate('Admin/User/index.html', ['users' => $users]);
    }

    public function addAction()
    {
        View::renderTemplate('Admin/User/add.html');
    }

    public function viewAction()
    {
        $user_id = $this->route_params['id'];
        $user = User::findByID($user_id);
        if($user->level == 0){
            $level = 'Admin';
        }else{
            $level = 'User';
        }
        View::renderTemplate('Admin/User/view.html', ['user' => $user, 'level' => $level]);
    }
    public function profileAction()
    {
        $user = Auth::getUser();
        if($user->level == 0){
            $level = 'Admin';
        }else{
            $level = 'User';
        }

        if (isset($_POST['submit'])){
            $data['id'] = $user->id;
            $data['name'] = $_POST['name'];
            $data['password'] = $_POST['password'];
            $data['phone'] = $_POST['phone'];
            $data['address'] = $_POST['address'];
            $data['description'] = $_POST['description'];
            $data['thumbnail'] = add_image('thumbnail')['image'];
            if($data['thumbnail'] == ''){
                $data['thumbnail'] = $user->thumbnail;
            }
            User::updateProfile2($data);
            $this->redirect('/admin/user/profile');
        }else{
            View::renderTemplate('Admin/User/profile.html', ['user' => $user, 'level' => $level]);
        }
        
    }

}