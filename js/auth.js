var is_reg = true;

function on_form_submit()
{
    var action = $("#auth_form").attr("action") + (is_reg ? "signup" : "signin");
    $("#auth_form").attr("action", action);
}

function on_document_ready()
{
    $("#signIn").click(function () {is_reg = false});
    $("#signUp").click(function () {is_reg = true});
    $("#auth_form").submit(on_form_submit);
}

$(document).ready(on_document_ready);
