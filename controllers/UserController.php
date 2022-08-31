<?php

class UserController {
    function signUp() {
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
}

?>