<?php
$url = "https://dog.ceo/api/breeds/list/all";
$dogs = json_decode(file_get_contents($url), true);
$breeds = $dogs['message'];


function getByBreed($breed)
{
      $api = 'https://dog.ceo/api/breed/' . $breed . '/images';
      $response = json_decode(file_get_contents($api));
      if (isset($response->status) && $response->status == 'success') {
            return $response->message;
      }
}

// if(isset($_POST['breed'])) {
//       $breed = $_POST['breed'];
//       $dogs_breed = getByBreed($breed);
//       echo "This is Button1 that is selected", $breed;
//   }
?>
<!DOCTYPE html>
<html lang="pt">

<head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Cachorros</title>
      <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
      <header>
            <h1> Raças de cachorro </h1>
      </header>
      <div id="app">
            <section id="search">
                  <form method="POST">
                        Pesquisar:<input id="name-search" type="text" name="breed">
                        <select id="type-search" name="select_breeds">
                              <option value=""></option>
                              <?php
                              foreach ($breeds as $key => $value) { ?>
                                    <option value="<?php echo $key ?>">
                                          <?php echo $key ?>
                                    </option>
                              <?php  } ?>
                        </select>
                        <input type="submit" value="ENVIAR">
                  </form>
            </section>
            <div id="content">
                  <div class="grid-container">
                        <div class="grid-item">
                              <?php
                              if (isset($_POST['select_breeds'])) {
                                    $selected_breed = $_POST['select_breeds'];
                                    $dogs_breed = getByBreed($selected_breed);
                                    foreach ($dogs_breed as $dog_breed) { ?>
                                          <img class="dog_img" src="<?php echo $dog_breed; ?>">
                              <?php
                                    }
                              }
                              ?>
                        </div>
                  </div>
            </div>
      </div>
</body>

</html>