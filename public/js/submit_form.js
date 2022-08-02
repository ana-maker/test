$('form').submit(function (event) {
    event.preventDefault();
    let form = $(this);
    $.ajax({
        url: '/ajax/search',
        type: "POST",
        data: form.serialize(),
        success: function (response) {
            let table = $('#table');
            table.empty();
            table.append(response);
        },
        error: function (err) {
            console.log(err);
        }
    });
});