<?php
    include_once './Base/Model.php';
    
    class CommentModel {
        static function query($articleId) {
            return db(DB_BLOG, 'SELECT * FROM comment WHERE comments_id = ' . $articleId);
        }
        static function insert() {

        }
        static function create() {

        }
        static function delete() {

        }
    }