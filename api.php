<?php
$method = $_SERVER['REQUEST_METHOD'];
echo $method;

/* 7. JSON
- создаем POST запрос
- в URL вставляем http://localhost:8080/index.php
- в body -> raw вставляем json
 {
   "username": "John",
   "email": "john@ispring.ru",
   "age": 34
 }
*/

const HOST = 'localhost';
const USERNAME = 'root';
const PASSWORD = '';
const DATABASE = 'blog';

function createDBConnection(): mysqli {
  $conn = new mysqli(HOST, USERNAME, PASSWORD, DATABASE);
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  return $conn;
}

function closeDBConnection(mysqli $conn): void {
  $conn->close();
}

function getPostJson(): ?string {
  $dataAsJson = file_get_contents("php://input");
  if (!$dataAsJson) {
    echo 'Не удалось считать данные! <br>';
    return null;
  }
  return $dataAsJson;
}

function getPostJsonAsArray(string $dataAsJson): array {
  $dataAsArray = json_decode($dataAsJson, true);
  if (!$dataAsArray) {
    echo 'Не удалось преобразовать JSON в массив! <br>';
    return [];
  }
  return $dataAsArray;
}

if ($method == 'POST'){
    $dataAsJson = getPostJson();
    // if ($dataAsJson) {
    //   // не нужно выводить данные запроса
    //     print_r($dataAsJson . '<br>');
    //     print_r(getPostJsonAsArray($dataAsJson));
    //     echo '<br><br>';
    // }
    // if ($dataAsJson) {
    //   // не нужно сохранаять json файл на сервере
    //     saveFile('data.json', $dataAsJson);
    //   }
    if ($dataAsJson) {
        $dataAsArray = getPostJsonAsArray($dataAsJson);
        if ($dataAsArray['image_url']) {
          saveImage($dataAsArray['image_url'], $dataAsArray['title']);
        }
    }
}else{
    echo 'Произошла ошибка при выборе метода. Попробуйте POST.';
}

// 8. Сохраним JSON в файл
function saveFile(string $file, string $data): void {
  $myFile = fopen($file, 'w');
  if ($myFile) {
    $result = fwrite($myFile, $data);
    if ($result) {
      echo 'Данные успешно сохранены в файл <br>';
    } else {
      echo 'Произошла ошибка при сохранении данных в файл <br>';
    }
    fclose($myFile);
  } else {
    echo 'Произошла ошибка при открытии файла <br>';
  }
}

/* 9. Сохраним картинку в файл
 сервис конвертирования картинки в base64 https://base64.guru/converter/encode/image
 {
   "image": "....тут base64"
 }
*/

function saveImage(string $imageBase64, string $name): string  {
  $imageBase64Array = explode(';base64,', $imageBase64);
  $imgExtention = str_replace('data:image/', '', $imageBase64Array[0]);
  $imageDecoded = base64_decode($imageBase64Array[1]);
  saveFile("images/$name.{$imgExtention}", $imageDecoded);
  return "images/$name.{$imgExtention}";
}

$dataAsJson = getPostJson();
  
   
  if ($dataAsJson) {
    $dataAsArray = getPostJsonAsArray($dataAsJson);
    if ($dataAsArray['image_url']) {
      $image_url = saveImage($dataAsArray['image_url'], $dataAsArray['title']);
    }
    if ($dataAsArray['author_url']) {
      $author_image = saveImage($dataAsArray['author_url'], $dataAsArray['author']);
    }
    $conn = createDBConnection();    
    $sql = "INSERT INTO post (title, subtitle, content, author, author_url, publish_date, image_url, featured) VALUES ('{$dataAsArray['title']}', '{$dataAsArray['subtitle']}', '{$dataAsArray['content']}', '{$dataAsArray['author']}', '$author_image', '{$dataAsArray['publish_date']}', '$image_url', '{$dataAsArray['featured']}')";  
    $result = $conn->query($sql);
  }

?>