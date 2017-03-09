<?php
	
	include_once("./files/db.php");

	include_once("./files/Message.php");

	include_once("./files/pagination_helper.php");

	$message = new Message();
	if( !empty($_POST) ){
		$message->addMessage();
		header("Location: ./?page=".get_page_num());
	}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="./files/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="./files/css/style.css">
	<script type="text/javascript" src="./files/js/jquery-3.1.1.min.js"></script>
	<script  type="text/javascript" src="./files/my.js"></script>
	<title>Гостевая книга</title>
</head>
<body>
	<div id="wrap">	
		<div class="jumbotron">
			<div class="container">
				<h2>Приветствуем вас!</h2>
				<p>Это пример гостевой книги на bootstrap. Для продолжения нажимте "Далее"</p>
				
			</div>
		</div>
		
		<div class="container-fluid">	
			<div class="page-header">
				<h1>Гостевая книга</h1>
			</div>
			<div class="row">
				<div class="col-md-offset-1 col-md-10">
					<table class="table table-striped">
						<thead>
							<tr>	
								<th>Имя пользователя</th>
								<th>e-mail</th>
								<th>Homepage</th>
								<th>Дата добавления</th>
								<th>Сообщение</th>	
							</tr>
						</thead>
						<tbody>
							<?php 
								$list = $message->getList(); 
								$out='';
								foreach ($list as $mess) {
									$out.= '<tr>';
									$out.= '<td>'.$mess->username.'</td>'; 
									$out.= '<td>'.$mess->email.'</td>'; 
									if( !empty($mess->homepage) ){
										$out.= '<td>'.$mess->homepage.'</td>'; 
									} else {
										$out.= '<td>Отсутствует</td>'; 
									}
									
									$out.= '<td>'.$mess->date_add.'</td>'; 
									$out.= '<td>'.$mess->message.'</td>'; 
									$out.= '</tr>';
								}
								echo $out;
							?>
						</tbody>		
					</table>
				<p class="text-center page-links">
					<?php echo pagination_links(); ?>
				</p>
				</div>	
			</div>
			<div class="row">
				<div class="col-md-offset-2 col-md-8 form-border rounded">
					<form role="form" id="message_form" class="form-horizontal" action="" method="POST">
						<div class="form-group">
							<label for="username" class="col-sm-2 control-label ">Ваше имя*</label>
							<div class="col-sm-10">
								<input type="text" id="username" name="username" class="form-control" placeholder="Введите имя">
							</div>
						</div>
						<div class="form-group">
							<label for="email" class="col-sm-2 control-label ">E-mail*</label>
							<div class="col-sm-10">
								<input type="email" id="email" name="email" class="form-control" placeholder="Введите email">
							</div>
						</div>
						<div class="form-group">
							<label for="homepage" class="col-sm-2 control-label ">Homepage</label>
							<div class="col-sm-10">
								<input type="text" id="homepage" name="homepage" class="form-control" placeholder="Домашняя страница">
							</div>
						</div>
						<div class="form-group">
							<label for="message" class="control-label col-sm-2">Сообщение*</label>
							<div class="col-sm-10">
								<textarea name="message" id="message" name="message" rows="5" class="form-control"></textarea>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-offset-2 col-sm-10">
								<button type="button" class="btn btn-success send">Отправить сообщение</button>
							</div>
						</div>
					</form>				
				</div>
			</div>
		</div>
		<div id="push"></div>
	</div>
	<div id="footer">
		<div class="container-fluid"><p class="text-center">&copy; Гостевая книга </p></div>
	</div>
</body>
</html>