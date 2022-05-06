<?php
    interface iUser extends iTemplate
    {
        public function canLogin();
        public function canRegister();
        public function validateEmail();
        public function validatePassword($id);
        public function sendPasswordResetLink();
        public function resetPassword();
        public function changePassword($id);
        public static function getInfo($id);
        public static function getMainEmail($mail);
    }
