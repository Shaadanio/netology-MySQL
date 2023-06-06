<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Оформление заказа</title>
  </head>
  <body>

<?
// echo "<pre>";
// print_r($_REQUEST);
// echo "</pre>";

if($_REQUEST['submit']){
	//подключаемся к БД
	$DB_HOST='localhost:3306'; 
	$DB_USER='shaadafz_netol'; 
	$DB_PASS='v*N0Fsb9';
	$DB_NAME='shaadafz_netol';
	$link = mysqli_connect( $DB_HOST, $DB_USER, $DB_PASS, $DB_NAME );
	if (!$link) {
 		echo "Ошибка: Невозможно установить соединение с MySQL.";
 		echo "Код ошибки errno: ".mysqli_connect_errno( );
 		echo "Текст ошибки error: ".mysqli_connect_error( );
	} else {

		if($_REQUEST['user_name'] != ''){
			$sql_contact = "INSERT INTO contacts (Name, SecondName, LastName) VALUES ('".$_REQUEST['user_name']."', '".$_REQUEST['user_second_name']."', '".$_REQUEST['user_last_name']."')";
			$result = mysqli_query($link, $sql_contact);
			$contact_id= mysqli_insert_id($link);

			$sql_order = "INSERT INTO orders (ContactId, City, Street, House, Flat) VALUES ('".$contact_id."', '".$_REQUEST['user_address_city']."', '".$_REQUEST['user_address_street']."', '".$_REQUEST['user_address_house']."', '".$_REQUEST['user_address_flat']."')";
			$result2 = mysqli_query($link, $sql_order);
			$order_id= mysqli_insert_id($link);

			if ($result == false) {
				echo "Произошла ошибка при выполнении запроса";
			}else{

				echo "<p><b>Спасибо за ваш заказ!</b> Ему присвоен номер $order_id</p>";
				echo "<b>Данные заказа</b>";
				echo "<p><i>Ваше имя: </i>" . $_REQUEST['user_last_name'] . " " . $_REQUEST['user_name'] ." " . $_REQUEST['user_second_name'] . "</p>";
				echo "<i><p>Ваш адрес: </i>" . $_REQUEST['user_address_city'] . " " . $_REQUEST['user_address_street'] ." " . $_REQUEST['user_address_house'] . " " . $_REQUEST['user_address_flat'] . "</p>";												
			
				// Вывести данные можно не через $_REQUEST а через повторное ображение к базе, 
				//так же перед добавлением пользователя проверять его наличие и использовать ID ранее созданного пользователя
			}
		}

	}
}
?>
<div class="container">
<h2>Оформление заказа</h2>
<form action="" method="POST">
<fieldset>
	<legend>Контактная информация</legend>
	<div class="mb-3">
		<label class="form-label">Ваше имя<span class="mf-req">*</span></label>
		<input type="text" name="user_name" id="user_name" class="form-control" value="" required="required"><br>
	</div>
		<div class="mb-3">
		<label class="form-label">Ваше отчество<span class="mf-req">*</span></label>
		<input type="text" name="user_second_name" id="user_second_name" class="form-control" value="" required="required"><br>

		<div class="mb-3">
		<label class="form-label">Ваша фамилия<span class="mf-req">*</span></label>
		<input type="text" name="user_last_name" id="user_last_name" class="form-control" value="" required="required"><br>
</fieldset>
<fieldset>
	<legend>Адрес доставки</legend>
		<div class="mb-3">
		<label class="form-label">Город<span class="mf-req">*</span></label>
		<input type="text" name="user_address_city" id="user_address_city" class="form-control" value="" required="required"><br>

		<div class="mb-3">
		<label class="form-label">Улица<span class="mf-req">*</span></label>
		<input type="text" name="user_address_street" id="user_address_street" class="form-control" value="" required="required"><br>

		<div class="mb-3">
		<label class="form-label">Дом и корпус<span class="mf-req">*</span></label>
		<input type="text" name="user_address_house" id="user_address_house" class="form-control" value="" required="required"><br>

		<div class="mb-3">
		<label class="form-label">Квартира<span class="mf-req">*</span></label>
		<input type="text" name="user_address_flat" id="user_address_flat" class="form-control" value="" required="required"><br>
</fieldset>
		<button type="submit" name="submit" class="btn btn-primary" value="submit">Заказать</button>
	</form>
	<div id="result"></div>
</div>
</body>
</html>