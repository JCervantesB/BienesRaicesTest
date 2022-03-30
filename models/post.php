<?php

namespace Model;

class post extends activeRecord {
    protected static $tabla = "post";
 
    protected static $columnasDB = ["id", "title", "bodys", "create_at", "image_post"];

    public $id;
    public $title;
    public $bodys;
    public $create_at;
    public $image_post;

    public function __construct($args = [])
    {
        $this->id = $args["id"] ?? null;
        $this->title = $args["title"] ?? "";
        $this->bodys = $args["bodys"] ?? "";
        $this->create_at = date("Y/m/d");
        $this->image_post = $args["image_post"] ?? "";
    }

}