<?php
    interface iPost extends iTemplate
    {
        public static function getUser($userId);
        public static function getAll($start);
        //public static function deleteAll($id);
        public function getId();
    }