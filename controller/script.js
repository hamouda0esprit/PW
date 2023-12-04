$('.order').click(function(e) {

    let button = $(this);

    if(!button.hasClass('animate')) {
        button.addClass('animate');
        setTimeout(() => {
            button.removeClass('animate');
        }, 10000);
    }

});
function delay(){
document.getElementById('form').addEventListener('submit', function (event) {
    event.preventDefault();

    setTimeout(function () {document.getElementById('form').submit();}, 11000);});

}