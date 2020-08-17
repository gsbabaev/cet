<?php

include_once __DIR__."/class.connect.mysql.php";

class CommentsTree extends connectMySQL{
    /*
    private $id;//Идентификатор комментария
    private $parent_id;//Идентификатор комментария, на который отвечают
    private $topic_id;//ID топика, который обсуждают
    private $body; //Текст комментария
    private $created_at ; //время отправки комментария
*/
    private $data;
    public function __construct($data)
    {
        parent::__construct();
        $this->data = $data;
    }


}