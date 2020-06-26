
$( ()=>{
    
    let currentSlide = 0;
    let maxSlider = $('.banner-slider').length-1;
    
    initSlider();
    changeSlide();

    

    function initSlider(){
        $('.banner-slider').hide();
        $('.banner-slider').eq(0).show();

        for(let i = 0; i < maxSlider+1; i++){
            var content = $('.bullets').html();

            if(i == 0)
                content+='<span class="active-slider"></span>';
            else
                content+='<span></span>';
            
            $('.bullets').html(content);
        }
    }

    function changeSlide(){
        setInterval(()=>{
            $('.banner-slider').eq(currentSlide).stop().fadeOut(2000);

            currentSlide++;

            if(currentSlide > maxSlider)
                currentSlide = 0;
            

            $('.banner-slider').eq(currentSlide).stop().fadeIn(2000);

            $('.bullets span').removeClass('active-slider');
            $('.bullets span').eq(currentSlide).addClass('active-slider');

        },3000);
    }

    $('body').on('click','.bullets span', function(){
        var currentBullet = $(this);
        $('.banner-slider').eq(currentSlide).stop().fadeOut(500);
        currentSlide = currentBullet.index();
        $('.banner-slider').eq(currentSlide).stop().fadeIn(500);


        $('.bullets span').removeClass('active-slider');

        currentBullet.addClass('active-slider');
    });
})