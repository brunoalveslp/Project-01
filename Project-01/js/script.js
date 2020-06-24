$(()=>{
    $('.mobile').click(()=>{
        const navMobile = $('.mobile ul');
        //fadeIn test
        // if(navMobile.is(':hidden') == true)
        //     navMobile.fadeIn();
        // else
        //     navMobile.fadeOut();
        
        if(navMobile.is(':hidden') == true){
            const icon = $('.mobile').find('i');
            icon.removeClass('fa-bars');
            icon.addClass('fa-times');
            navMobile.slideToggle();
        }else {
            const icon = $('.mobile i');
            icon.removeClass('fa-times');
            icon.addClass('fa-bars');
            navMobile.slideToggle();
        }
    });

        if($('target').length > 0){
            const element = '#'+$('target').attr('target');
            const divScroll = $(element).offset().top;
            $('html,body').animate({'scrollTop':divScroll},1500);
        }

})