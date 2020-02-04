$(document).ready(() => {

    $(window).scroll(function (event) {
        var scroll = $(window).scrollTop();
        if(scroll > 0){
            $('.navbar').addClass('scrolled');
        }else{
            $('.navbar').removeClass('scrolled');
        }
        // Do something
    });
    $('.description-content').each((item) => {
        console.log('item');
    })
    //Smooth scrolling with links
    $('a[href*=\\#]').on('click', function(event){
        console.log('DUPA');
        event.preventDefault();
        $('html,body').animate({scrollTop:$(this.hash).offset().top}, 500);
    });

    $('.switcher').addClass('show-switcher');
})
window.showDescription = () => {
    $('.description-content').each(function () {
        $(this).addClass('description-content-show');
    })
}
window.hamburgerClick = function (elem) {
    if($(elem).hasClass('is-active')) $(elem).removeClass('is-active')
    else $(elem).addClass('is-active')
}

