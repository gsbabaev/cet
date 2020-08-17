$( document ).ready(function() {
    $('#exampleModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var recipient = button.data('whatever') // Extract info from data-* attributes
        var modal = $(this)
        modal.find('.modal-title').text('New message ID: ' + recipient)
        modal.find('.modal-body input#parent_id').val(recipient)
    });

    $('#my_form_send').click(function(){


        var data = $("#ajax_form").serializeArray();
        var parent_id = $("#ajax_form #parent_id").val();
        var fbody = $("#ajax_form #fbody").val();
        var d = new Date();
        var strDate = d.getFullYear() + "/" + (d.getMonth()+1) + "/" + d.getDate();

        $.post(
            'index.php', // адрес обработчика
            data, // отправляемые данные
            function(id) { // получен ответ сервера
                console.log(id);
                if(id == 1){ //ul
                    $(".childrens_comment_" + parent_id ).append(
                        '<ul class="list-unstyled"><li class="media"><img src="..." class="img  mr-3" alt="..."><div class="media-body"><span class="badge badge-dark">' +
                        strDate +
                        '</span><a href="#" data-whatever="'+
                        id +
                        '" data-toggle="modal" data-target="#exampleModal" class="badge badge-default">Комментировать</a><div class="body">'+
                        fbody +
                        '</div><div class="childrens_comment_'+
                        id+
                        '"></div></div></li></ul>'
                    );
                }if(id > 1){ //li
                        $(".childrens_comment_" + parent_id + " ul").append(
                            '<li class="media"><img src="..." class="img  mr-3" alt="..."><div class="media-body"><span class="badge badge-dark">' +
                            strDate +
                            '</span><a href="#" data-whatever="'+
                            id +
                            '" data-toggle="modal" data-target="#exampleModal" class="badge badge-default">Комментировать</a><div class="body">'+
                            fbody +
                                '</div><div class="childrens_comment_'+
                            id+
                                '"></div></div></li>'
                        );
                }else{ //error

                }
            }
        );
        $('#exampleModal').modal('hide');
    });



});
