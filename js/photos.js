function loadPhotos()
{
    var url = "http://localhost/farpost?controller=profile&action=get_photos";
    $.ajax({
        method: 'GET',
        url: url,
        success: function(data){
            var arr = $("#photo_album_block").children();
            for (var i = 0; i < arr.length; ++i)
                $(arr[i]).remove();
            for (var i = 0; i < data.length; ++i)
                $("#photo_album_block").append(
                    $("<div/>", {"class": "photo"}).append(
                        $("<a/>", {"href": "img/" + data[i], "target": "_blank"}).append(
                            $("<img/>", {"src": "img/thumb/" + data[i]})
                        )
                    )
                );
        }
    });
}

function on_document_ready()
{
    $("#hidden_frame").load(function() {loadPhotos()});
}

$(document).ready(on_document_ready);
