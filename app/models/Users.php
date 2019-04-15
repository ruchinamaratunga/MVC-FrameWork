<?php

class Users extends Model {
    private $_isLoggedIn,
            $_sessionName,
            $_cookieName;
    public static $currentLoggedInUser = null;

    public function __construct($user='') {
        $table = 'users';
        parent::__construct($table);
        $this->_sessionName = CURRENT_USER_SESSION_NAME;
        $this->_cookieName = REMEMBER_ME_COOKIE_NAME;
        $this->_softDelete = true;

        if($user != '') {
            if(is_int($user)) {
                $u = $this->db->findFirst('users',['conditions'=>'id = ?', 'bind'=>[$user]]);
            } else {
                $u = $this->_db->findFirst('users',['conditions'=>'username = ?', 'bind'=>[$user]]);
            }
            if($u) {
                dnd($u);
                foreach($u as $key =>$val) {
                    $this->$key = $val;
                }
            }
            echo $this->username;
        }
    }

    public function findByUsername($username) {
        return $this->findFirst(['condition' => "username = ?" , 'bind' => [$username]]);
    }

    // public static function currentLoggedInUser() {
    //     if(!isset(self::$currentLoggedInUser) && Sessoin::exists(CURRENT_USER_SESSION_NAME)) {
    //             $u = new Users((int)Session::get(CURRENT_USER_SESSION_NAME));
    //             self::$currentLoggedInUser = $u;
    //     } 
    //     return self::$currentLoggedInUser;
    // }

    public function login($rememberMe = false) {
        Session::set($this->_sessionName,$this->id);
        if($rememberMe) {
            $hash = md5(unique() + rand(0,100));
            $user_agent = Session::uagent_no_versions();
            Cookie::set($this->_cookieName, $hash, REMEMBER_ME_COOKIE_EXPIRY);
            $fields = ['session' => $hash, 'user_agent' =>$user_agent, 'user_id' =>$this->id];
            $this->_db->query("DELETE FROM user_sessions WHERE user_id = ? AND user_agent = ?",[$this->id, $user_agent]);      //delete old cookies saved in the DB
            $this->_db->insert('user_sessions', $fields);
        }
    }

    public static function loginUserFromCookie() {
        $user_session_model = new UserSessions();
        $user_session = $user_session_model->findFirst([
            'conditions' => "user_agent = ? AND session = ?",
            'bind' => [Session::uagent_no_version(), Cookie::get(REMEMBER_ME_COOKIE_NAME)]
        ]);
        if($user_session->user_id != '') {
            $user = new self((int)$user_session->user_id);
        }
        $user->login();
        return self::$currentLoggedInUser;
    }

    // public function loggout() {
    //     $user_agent = Session::uagent_no_versions();
    //     $this->_db->query("DELETE FROM user_sessions WHERE user_id = ? AND user_agent = ?",[$this->id,$user_agent]);
    //     Session::delete(CURRENT_USER_SESSION_NAME);
    //     if(Cookie::exists(REMEMBER_ME_COOKIE_NAME)) {
    //         Cookie::delete(REMEMBER_ME_COOKIE_NAME);
    //     }
    //     self::$currentLoggedInUser = null;
    //     return ture;
    // }
}