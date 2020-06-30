$(()=>{
    let open = true;
    let windowSize = $(window)[0].innerWidth;

    if(windowSize <= 768)
    {
        open = false;
    }

    $('.menu-btn').click(
        function(){
        if(open == true)
        {
            $('.menu').animate({'width':'0','padding':'0'},
            ()=>
            {
                open = false;
            });
            ;
            $('.content,header').css({'width':'96%'});
            $('.content,header').animate({'left':'0'},
            ()=>
            {
                open = false;
            });
            
        } else
        {
            $('.menu').css({'display':'block'});
            $('.menu').animate({'width':'300px'},()=>
            {
                open = true;
            });
            if(windowSize > 768){
               $('.content,header').css({'width':'calc(100% - 300px)'}); 
            }
            

            $('.content,header').animate({'left':'300px'},
            ()=>
            {
                open = true;
            });
            
        }
    })

    $(window).resize(()=>
    {
        let windowSize = $(window)[0].innerWidth;
        if(windowSize <= 768)
        {
            open = false;
            $('.menu').css({'width':'0','padding':'0'});
            $('.content,header').css({'width':'96%'});
            $('.content,header').css({'left':'0'});
        } else
        {
            open = true;
            $('.menu').css({'width':'300px','display':'block'});
            $('.content,header').css({'width':'calc(100% - 300px)','left':'300px'});
        }
            
    })

    $('[formato=data]').mask('99/99/9999');

    $('[actionBtn=delete]').click(()=>{
        let txt;
        let r = confirm("Deseja ecluir o registro!");
        if (r == true) {
            return true;
        } else {
            return false;
        } 
    })

})