<?php
    class Token {
        public static function generate()
        {
            return session::put(Config::get('session/token_name'),md5(uniqid()));
        }
        public static function check($token)
        {
            $tokenname = Config::get('session/token_name');

            if(session::exists($tokenname)&& $token === session::get($tokenname)) {
                session::delete($tokenname);
                return true;

            }
            return false;
        }

    }
