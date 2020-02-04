// log('Hello world!')

var post_category = $("#post_category")
var token = $("#post_token")


$post_category.change(function () {

    var $form = $(this).closest('form')
    var data = {}

    data[$token.attr('name')] = $token.val()
    data[$post_category.attr('name')] = $post_category.val()

    $.post($form.attr('action'), data).then(function (response) {
          $("#post_sub_category").replaceWith(
              $(response).find("#post_sub_category")
          )
    })
});


function log($msg)
{
    console.log($msg)
}