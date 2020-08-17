<?php

include_once __DIR__."/class.connect.mysql.php";

Class TemplateCommentHtml extends connectMySQL{
    public $template;
    public function __construct()
    {
        $this->template = [//<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Open modal for @mdo</button>
            'ul' => '<ul class="list-unstyled">{li}</ul>',
            'li' => '<li class="media">
            <img src="..." class="img  mr-3" alt="...">
            <div class="media-body">
                <span class="badge badge-dark">{created_at}</span><a href="#" data-whatever="{id}" data-toggle="modal" data-target="#exampleModal" class="badge badge-default">Комментировать</a>
                <div class="body">{body}</div>                
                <div class="childrens_comment_{id}">{template_{id}}</div>
            </div>
        </li>'];
        parent::__construct();
    }

    private function make($topic_id, $parent_id = null){
        $data = $this->getAll("SELECT * FROM comments WHERE topic_id=?i ".
            (
            isset($parent_id) ? "AND parent_id = ".$parent_id."" : "AND parent_id = 0 "
            )." ",$topic_id);

        $prepareLI= '';

        if(count($data)){
            foreach ($data as $datum) {
                $prepareLI .= str_replace( ['{template_'.$datum['id'].'}'],$this->make($topic_id, $datum['id']),  $this->__getPrepareLI($datum));
            }
            $prepareLI = str_replace('{li}',$prepareLI,$this->template['ul']);
        }

        return $prepareLI;
    }

    private function __getPrepareLI($datum){
        $prepareLI = $this->template['li'];
        foreach ($datum as $key => $item) {
            $prepareLI = str_replace( '{'.$key.'}', $item, $prepareLI);
        }
        return $prepareLI;
    }

    //Экранирование и проверка значений в базовом классе
    public function save($data){

        $this->parent_id = $data['parent_id'];

        $sql  = "INSERT INTO comments SET parent_id = ?i, topic_id = ?i, `body` = ?s ";
        $this->query($sql, $data['parent_id'], $data['topic_id'], $data['body']);

        return $this;
    }

    // return FULL TREE in HTML view
    public function html($topic_id){
        return $this->make($topic_id);
    }

    //return TRUE/FALSE
    public function json(){
        $r = null;
        if(filter_var($this->insertId(), FILTER_VALIDATE_INT)){
            $r  = $this->getOne("SELECT count(id) FROM comments WHERE parent_id=?i ",$this->parent_id);
        }
        return json_decode( $r );
    }
}