<?php

class Validator {
    private $title;
    private $desc;

    public function __construct( $title, $des ) {
        $title = strip_tags( $title );
        $title = htmlspecialchars( $title );
        $title = filter_var( $title, FILTER_SANITIZE_STRING );
        $title = trim( $title );
        $this->title = $title;

        $des = strip_tags( $des );
        $des = htmlspecialchars( $des );
        $des = filter_var( $des, FILTER_SANITIZE_STRING );
        $des = trim( $des );
        $this->desc = $des;

    }

    public function getTitle() {
        return $this->title;
    }

    public function getDesc() {
        return $this->desc;
    }
}

?>