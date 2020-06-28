
$( ()=>{
    
    $('body').on('submit','form',function()
    {
		var form = $(this);
		$.ajax({
			beforeSend: ()=>
			{
				$('.loading').fadeIn();
			},
			url:'http://localhost/Project-01/ajax/forms.php',
			method:'post',
			dataType: 'json',
			data:form.serialize()
		}).done(function(data){
			if(data.succed)
			{
				$('.loading').fadeOut();
				$('.succed').fadeIn();
				setTimeout(()=>{
				$('.succed').fadeOut();
				},3000);
				
			}else
			{
				$('.Erro').fadeIn();
				setTimeout(()=>{
					$('.Err0').fadeOut();
					},3000);
			}
		});
        return false;
    })
    
})