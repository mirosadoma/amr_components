$('.add-other-values').click(function () {
    var ct = '<div class="row">';
    ct += '<div class="col-sm-2"></div>';
    ct += '<div class="col-sm-4">';
    ct += '<input type="text" name="answers[ar][]" class="form-control" placeholder="الإجابة بالعربى">';
    ct += '</div>';
    ct += '<div class="col-sm-4">';
    ct += '<input type="text" name="answers[en][]" class="form-control" placeholder="الإجابة بالإنجليزى">';
    ct += '</div>';
    ct += '<div class="col-sm-1">';
    ct += '<label class="custom-checkbox">';
    ct += '<input type="hidden" class="custom-checkbox-input-hidden" name="answers[is_right][]" value="0" />';
    ct += '<input class="custom-checkbox-input" name="answers[is_right][]" value="1" type="radio" title="الإجابة الصحيحة">';
    ct += '<span class="custom-checkbox-text btn btn-secondry pull-right waves-effect waves-float waves-light"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg></span>';
    ct += '</label>';
    ct += '</div>';
    ct += '<div class="col-sm-1">';
    ct += '<span class="btn btn-icon btn-outline-danger waves-effect value-trash">X</span>';
    ct += '</div></div><br>';
    $('.other-values').append(ct);
    return false;
});
$(document).on('click','.custom-checkbox',  function () {
    $('.custom-checkbox-input-hidden').prop('disabled', false);
    $(this).find('.custom-checkbox-input-hidden').prop("disabled", true);
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