$('.add-other-values').click(function () {
    var ct = '<div class="row">';
    ct += '<div class="col-sm-2"></div>';
    ct += '<div class="col-sm-3">';
    ct += '<input type="text" name="answers[ar][]" class="form-control" placeholder="الإجابة بالعربى">';
    ct += '</div>';
    ct += '<div class="col-sm-3">';
    ct += '<input type="text" name="answers[en][]" class="form-control" placeholder="الإجابة بالإنجليزى">';
    ct += '</div>';
    ct += '<div class="col-sm-2">';
    ct += '<input type="number" name="answers[points][]" class="form-control" placeholder="النقاط">';
    ct += '</div>';
    ct += '<div class="col-sm-2">';
    ct += '<span class="btn btn-icon btn-outline-danger waves-effect value-trash">X</span>';
    ct += '</div></div><br>';
    $('.other-values').append(ct);
    return false;
});
$(document).on('click','.value-trash',  function () {
    var btn = $(this);
    var answer = $(this).data('answer');
    var url = _url_+"app/scales/remove_answer/"+answer;
    if (answer) {
        $.get(url, function(data) {
            data == "true" ? btn.parent().parent().hide("") : '';
            data == "true"? btn.parent().parent().next().hide("") : '';
        });
    } else {
        btn.parent().parent().hide("");
        btn.parent().parent().next().hide("");
    }
});