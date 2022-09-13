<?php

class UserController {
    function signup() {
        $route = new Router;
        $route->allowedMethod('POST');

        // Get the inserts
        $name = $_POST['name'];
        $email = $_POST['email'];
        $pass = sha1($_POST['pass']);
        $avatar = $_POST['avatar'];

        // Inserts validation

        // Implement database operation
        $user = new User(null, $name, $email, $pass, $avatar);
        $id = $user->create();

        // Give the Output
        $result['success']['message'] = 'User created successfully!';

        $result['user']['id'] = $id;
        $result['user']['name'] = $name;
        $result['user']['email'] = $email;
        $result['user']['pass'] = $pass;
        $result['user']['avatar'] = $avatar;

        $output = new Output();
        $output->response($result);
    }

    function list() {
        $route = new Router();
        $route->allowedMethod('GET');

        $user = new User(NULL, NULL, NULL, NULL, NULL);
        $list = $user->list();

        $result['success']['message'] = 'User list has been successfully listed!';
        $result['data'] = $list;

        $output = new Output;
        $output->response($result);
    }
    
    function byId() {
        $route = new Router();
        $route->allowedMethod('GET');
        $output = new Output;
        
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            $user = new User($id, NULL, NULL, NULL, NULL);
            $userData = $user->getById();
    
            if ($userData) {
                $result['success']['message'] = 'User successfully selected!';
                $result['data'] = $userData;
                $output->response($result);
            } else {
                $result['error']['message'] = 'User not found!';
                $output->response($result, 404);
            }
        }
        
        $result['error']['message'] = "ID parameter required!";
        $output->response($result, 406);
    }
}

?>