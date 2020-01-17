<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if(isset($_COOKIE['publisherId'])) { 
	

	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		

		$filePath  = $_FILES['picture']['tmp_name'];
		$errorCode = $_FILES['picture']['error'];
// Проверим на ошибки
		if ($errorCode !== UPLOAD_ERR_OK || !is_uploaded_file($filePath)) {
    // Массив с названиями ошибок
		    $errorMessages = [
		        UPLOAD_ERR_INI_SIZE   => 'Размер файла превысил значение upload_max_filesize в конфигурации PHP.',
		        UPLOAD_ERR_FORM_SIZE  => 'Размер загружаемого файла превысил значение MAX_FILE_SIZE в HTML-форме.',
		        UPLOAD_ERR_PARTIAL    => 'Загружаемый файл был получен только частично.',
		        UPLOAD_ERR_NO_FILE    => 'Файл не был загружен.',
		        UPLOAD_ERR_NO_TMP_DIR => 'Отсутствует временная папка.',
		        UPLOAD_ERR_CANT_WRITE => 'Не удалось записать файл на диск.',
		        UPLOAD_ERR_EXTENSION  => 'PHP-расширение остановило загрузку файла.',
		    ];
    // Зададим неизвестную ошибку
    		$unknownMessage = 'При загрузке файла произошла неизвестная ошибка.';
    // Если в массиве нет кода ошибки, скажем, что ошибка неизвестна
    		$outputMessage = isset($errorMessages[$errorCode]) ? $errorMessages[$errorCode] : $unknownMessage;
    // Выведем название ошибки
    		die($outputMessage);
		}
// Создадим ресурс FileInfo
		$fi = finfo_open(FILEINFO_MIME_TYPE);
// Получим MIME-тип
		$mime = (string) finfo_file($fi, $filePath);
// Закроем ресурс
		finfo_close($fi);
// Проверим ключевое слово image (image/jpeg, image/png и т. д.)
		if (strpos($mime, 'image') === false) die('Можно загружать только изображения.');
// Результат функции запишем в переменную
		$image = getimagesize($filePath);
// Зададим ограничения для картинок
		$limitBytes  = 1024 * 1024 * 5;
		$limitWidth  = 1280;
		$limitHeight = 768;
// Проверим нужные параметры
		if (filesize($filePath) > $limitBytes) die('Размер изображения не должен превышать 5 Мбайт.');
		if ($image[1] > $limitHeight)          die('Высота изображения не должна превышать 768 точек.');
		if ($image[0] > $limitWidth)           die('Ширина изображения не должна превышать 1280 точек.');
// Сгенерируем новое имя файла на основе MD5-хеша
		$name = md5_file($filePath);
// Сгенерируем расширение файла на основе типа картинки
		$extension = image_type_to_extension($image[2]);
// Сократим .jpeg до .jpg
		$format = str_replace('jpeg', 'jpg', $extension);
// Переместим картинку с новым именем и расширением в папку /pics
		$imgPath = 'C://wamp64/www/MediaManager/img/' . $name . $format;
		if (!move_uploaded_file($filePath, $imgPath)) {
		    die('При записи изображения на диск произошла ошибка.');
		}
		$imgPath = 'img/'.$name.$format;

		$dbc = mysqli_connect("localhost", "root", "", "mediamanager")
        or die("Could not connect : " . mysqli_error());
		$title = mysqli_real_escape_string($dbc, trim($_POST['title']));
		$brief_description = mysqli_real_escape_string($dbc, trim($_POST['brief_description']));
		$event = mysqli_real_escape_string($dbc, trim($_POST['events']));
		$keywords = mysqli_real_escape_string($dbc, trim($_POST['keywords']));
		$datetime = date("Y-m-d H:i:s");
		if (!empty($title) && !empty($brief_description) && !empty($event) && !empty($keywords) && !empty($datetime)){
			$query = "SELECT eventId FROM events WHERE eventTitle='$event';";
			$events = mysqli_query($dbc, $query) or trigger_error("Query: $insert MySQL Error: " . mysqli_error($dbc));
			if (mysqli_num_rows($events) > 0) {
				while($row = mysqli_fetch_assoc($events)) {
					$eventId = $row["eventId"]; 
	    		}
		    }
			$insert = "INSERT INTO publications (publicationTitle, publisherId, publicationDescr, publicationDateTime, publicationKeywords, eventId, imgPath) VALUES ('$title', '{$_COOKIE['publisherId']}', '$brief_description', '$datetime', '$keywords', '$eventId', '$imgPath');";
			mysqli_query($dbc, $insert) or trigger_error("Query: $insert MySQL Error: " . mysqli_error($dbc));
			mysqli_close($dbc);
			$home_url = '../index.php';
			header('Location: '. $home_url);
		}
		else{
			mysqli_close($dbc);
			echo 'Please, fill all fields!!!';
		}
	}
}
?>