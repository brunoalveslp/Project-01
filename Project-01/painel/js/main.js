$(()=>{
    let open = true;
    let windowSize = $(window)[0].innerWidth;

    if(windowSize <= 768)
    {
        open = false;
    }

    $('.menu-btn').click(()=>{
        if(open)
        {
            $('.menu').animate({'width':'0'})
            $('.content').animate({'width':'100%'})
            $('.content').animate({'left':'0'})
        }
    })

})