<?php

include_once "class/class.template.comment.html.php";

$TemplateCommentHtml = new TemplateCommentHtml();

$topic_id = isset($_REQUEST['topic_id']) ? $_REQUEST['topic_id'] : null;

if (isset($topic_id) AND filter_var($topic_id, FILTER_VALIDATE_INT)) {
    //MAKE TREE COMMENT FULL
    $tree_for_html = $TemplateCommentHtml->html($topic_id);
}elseif(isset($_REQUEST['add']) AND is_array($_REQUEST['add'])){
    echo  $TemplateCommentHtml->save($_REQUEST['add'])->json();//AJAX REQUEST
    exit();
}else{
    //nothing
}


//$CommentsTree = new CommentsTree($data);
//$CommentsTree->save();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <title>Starter Template · Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>
    <!-- Custom styles for this template -->
    <link href="css/css.css" rel="stylesheet">
</head>
<body>


<main role="main" class="container">

    <?php
        if(isset($tree_for_html)){
            echo $tree_for_html;
        }else{
            echo "Not data";
        }
    ?>



    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" id="ajax_form" action="">
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Message:</label>
                            <textarea class="form-control" id="fbody" name="add[body]"></textarea>
                        </div>
                        <input type="hidden" id="parent_id" name="add[parent_id]" value="">
                        <input type="hidden" name="add[topic_id]" value="<?= $topic_id?>">

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" id="my_form_send" class="btn btn-primary">Send message</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>

</main><!-- /.container -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
<script src="js/js.js" ></script>
</html>
