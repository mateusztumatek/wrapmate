$(document).ready(() => {

    $(window).scroll(function (event) {
        var scroll = $(window).scrollTop();
        if(scroll > 300){
            $('.navbar').addClass('scrolled');
            $('body').css('margin-top', $('.navbar').height());
        }else{
            if($('.navbar').hasClass('scrolled')){
                $('.navbar').addClass('hide-scroll');
            }
            if(scroll == 0){
                $('.navbar').removeClass('scrolled hide-scroll');
                $('body').css('margin-top', '0px');
            }
            $('.navbar').removeClass('scrolled');

        }
        // Do something
    });
    $('.description-content').each((item) => {
        console.log('item');
    })
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

