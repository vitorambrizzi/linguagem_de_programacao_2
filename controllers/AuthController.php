<?php
class AuthController {
    public function login() {
        Router::allowedMethod('POST');

        $data = Input::getData();
        $email = $data['email'];
        $pass = sha1($data['pass']);

        $user = new User(null, null, $email, $pass, null);
        $idUser = $user->login();

        if ($idUser) {
            $token = sha1(uniqid(rand(), true));
            $client = $_SERVER['HTTP_USER_AGENT'];
            $session = new Session(null, $idUser, $token, $client);
            $sessionId = $session->create();
            if ($sessionId) {
                $result['success']['message'] = 'User logged successfully!';
                $result['data']['token'] = $token; 
                Output::response($result);
            } else {
                $result['error']['message'] = 'Error creating session! Please, try again!';
                Output::response($result, 500);
            }
        } else {
            $result['error']['message'] = 'Email or Password invalid! Please, try again!';
            Output::response($result, 401);
        }
    }

    public function logout() {
        Router::allowedMethod('POST');
    
        $data = Input::getData();
        $idUser = $data['idUser'];
        $token = $data['token'];

        $session = new Session(null, $idUser, $token, null);
        $wasDeleted = $session->delete();

        if ($wasDeleted) {
            $result['success']['message'] = 'User logged out successfully!';
            Output::response($result);
        } else {
            $result['error']['message'] = 'Error logging out! Please, try again!';
            Output::response($result, 500);
        }
    }
}
?>