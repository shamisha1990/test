
function validation( name ){		

	  var field = document.getElementsByName(name);
      var prev  = field[0].value;
            
      window.setInterval(function ()
      {
            
            if (field[0].value != prev){
               prev = field[0].value;
               $.ajax({
               		url: './files/validation.php',
               		type: "POST",
               		dataType: "json",
               		data: {'name':name, 'value':prev, 'type':'valid_one'},
               		success: function( result ){
               			if( result.message != "success" ){
	               			if( !$( '#'+field[0].id ).parent().find('p').hasClass('error') ){
	               				$( '#'+field[0].id ).parent().append('<p class="alert-danger text-center error">'+result.message+'</p>');
	               				$( '#'+field[0].id ).parents().eq(1).addClass('has-warning');
	               			} else {
	               				$( '#'+field[0].id ).parent().find('p.error').text(result.message);
	               			}
	               		} else {
	               			$( '#'+field[0].id ).parents().eq(1).removeClass('has-warning');
	               			$( '#'+field[0].id ).parent().find("p.error").remove();
	               		}
               		}
               })
            }

      }, 300);
	
}


$(document).ready(function(){

	function show_mess( id, mess ){

		if( !$( '#'+id ).parent().find('p').hasClass('error') ){
			$( '#'+id ).parent().append('<p class="alert-danger text-center error">'+mess+'</p>');
			$( '#'+id ).parents().eq(1).addClass('has-warning');
		} else {
			$( '#'+id ).parent().find('p.error').text(mess);
		}

	}


	$("#message_form input, #message_form textarea").each(function(){
                  var name = $(this).attr("name")
                  validation( name );
            })
	
	$(".send").click(function(){
		var data = $('form').serialize();
		$.ajax({
               		url: './files/validation.php',
               		type: "POST",
               		dataType: "json",
               		data: data+"&type=valid_all",
               		success: function( result ){
               			if( result.valid != "success" ){
	               			if( result.mess ){ show_mess('message', result.mess); }
	               			if( result.name ){ show_mess('username', result.name); }
	               			if( result.email ){ show_mess('email', result.mess); }
	               		} else {
	               			$('form').submit();
	               		}
               		}
               })
	})



})