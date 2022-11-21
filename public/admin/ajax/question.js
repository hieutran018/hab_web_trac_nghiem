$(document).ready(function () {
    // fetchQuestion();
    // function fetchQuestion() {
    //     $.ajax({
    //         type: "GET",
    //         url: "/admin/games/questions/fetch-questions",
    //         dataType: "json",
    //         success: function (response) {
    //             // console.log(response.lst);
    //             $("#tableQuestion").html("");
    //             $.each(response.lv, function (key, item) {
    //                 $("#tableQuestion").append('<tr>\
    //                     <td>' + item.id + '</td>\
    //                     <td>' + item.question_content + '</td>\
    //                     <td>' + item.topic_id + '</td>\
    //                     <td>' + item.level_id + '</td>\
    //                     <td>' + item.point + '</td>\
    //                     <td>\
    //                     <button id="btn-edit-level" type="button" value="'+ item.id + '" class="btn btn-success"><i class="bi bi-pencil-square"></i></button>\
    //                     <button id="btn-delete-level" type ="button" value="'+ item.id + '" class= "btn btn-danger" > <i class="bi bi-person-x"></i></button >\
    //                     </td>\
    //                     \</tr > ');
    //             });
    //         }
    //     });
    // }

    $(document).on('click', '#btn-create-question', function (e) {
        e.preventDefault();
        $('#createQuestion').modal('show');
    });




    //* Thêm câu trả lời
    var max_fields = 5;
    var wrapper = $("#add-answer");
    var add_button = $("#add-form-field");

    var x = 2;
    $(add_button).click(function (e) {
        e.preventDefault();
        if (x < max_fields) {

            $(wrapper).append('<div class="mb-6 col-md">\
                <div class= "row">\
                                <label for="create-level-name" class= "form-label"> Câu trả lời 1:</label>\
                                <div class="mb-6 col-md-10">\
                                  <div class="mb-6 col-md">\
                                    <input class="form-control" type="text" id="create-answer-'+ x + '" name="question_content_' + x + '">\
                                    <span class="error-message" style="color: red;" id="error-add-news_category_name" value=""></span>\
                                  </div>\
                                </div>\
                                <div class="mb-6 col-md-2">\
                                    <input class="form-check-input" name="isTrue'+ x + '" type="checkbox" id="isTru' + x + '">\
                                </div>\
                              </div >\
                            </div >'); //add input box
            x++;
        } else {
            alert('You Reached the limits')
        }
    });

    $(wrapper).on("click", ".delete", function (e) {
        e.preventDefault();
        $(this).parent('div').remove();
        x--;
    })
});