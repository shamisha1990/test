<?php

class validation{

	public function email( $email ){
		$matches = preg_match('/^[-\w.]+@([A-z0-9][-A-z0-9]+\.)+[A-z]{2,4}$/', $email);
		if( !empty($matches) ){
			return true;
		}
		return false;
	}

	public function is_required( $value ){
		
		if( empty($value) ){
			return false;
		} else {
			return true;
		}

	}

	public function checkAll($data){

		foreach($data as $key=>$value){
			if( $key=="email" ){
				$show_email_req = !$this->is_required( $value ); 
				$show_email = !$this->email($value); 
			}
			if( $key=="message"){ $show_mess = !$this->is_required( $value ); }
			if( $key=="username" ){ $show_name = !$this->is_required( $value ); } 
		} 
		if( $show_email ){
			$mess['email'] = "Некорректный email"; 
		}
		if( $show_email_req ){
			$mess['email'] = "Это поле обязательно к заполнению";
		}
		if( $show_mess ){
			$mess['mess'] = "Это поле обязательно к заполнению";
		}
		if( $show_name ){
			$mess['name'] = "Это поле обязательно к заполнению";
		}

		if ( !$show_name && !$show_mess && !$show_email && !$show_email_req ){
			$mess['valid'] = 'success';
		} else {
			$mess['valid'] = 'error';
		}

		echo json_encode( $mess );
		
	}

}

$valid = new validation();
if( $_POST['type']=='valid_one' ){
	switch($_POST['name']){
		case 'email': 	if( !$valid->is_required( $_POST['value'] ) ){
							echo json_encode(array( "message"=>"Это поле обязательно к заполнению!" ));
						} else {
							if( !$valid->email($_POST['value']) ) { 
								echo json_encode(array( "message"=>"Некорректный email" )); 
							} else {
								echo json_encode(array( "message"=>"success" ));  
							}
						}	
						break;
						
		case 'message': if( !$valid->is_required( $_POST['value'] ) ){
							echo json_encode(array( "message"=>"Это поле обязательно к заполнению!" )); 		
						} else {
							echo json_encode(array( "message"=>"success" ));  
						}
						break;
		case 'username': if( !$valid->is_required( $_POST['value'] )){
							echo json_encode(array( "message"=>"Это поле обязательно к заполнению" )); 	
						}  else {
							echo json_encode(array( "message"=>"success" ));  
						}
	}
}

if( $_POST['type'] == 'valid_all' ){

	$valid->checkAll($_POST);

}	