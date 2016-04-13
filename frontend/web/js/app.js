$(document).ready(function() {
    if ($("div").is("#posts-list")) {
        var socket = io.connect('http://localhost:3000');
        var source = $("#posts-item-template").html();
        var template = Handlebars.compile(source);
        socket.on('post', function (data) {
            $('#posts-list').prepend(template(data));
            console.log(data);
        });
    }
});