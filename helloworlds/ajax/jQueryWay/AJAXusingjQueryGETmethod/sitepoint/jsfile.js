// Needed to simulate a JSON response
var fakeResponse = {
    status: "error",
    message: "Username already in use"
};

$('input').blur(function() {
    var data = {};
    data[this.name] = this.value;

    if (this.value) {
        $.get(
            'http://codepen.io/SitePoint/pen/339dd919e6b771f6c7edea3c8815b088.html',
            data,
            function (responseText) {
                if (fakeResponse.status === 'error') {
                    $('#notification-bar')
                        .html('<p>' + fakeResponse.message + '<p>')
                }
            });
    }
});

$('input').focus(function() {
    $('#notification-bar').html('');
});