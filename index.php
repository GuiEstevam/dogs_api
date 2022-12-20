<?php
$url = "https://dog.ceo/api/breeds/list/all";
$dogs = json_decode(file_get_contents($url), true);
$breeds = $dogs['message'];


function getByBreed($breed)
{
      $api = 'https://dog.ceo/api/breed/' . $breed . '/images/random';
      $response = json_decode(file_get_contents($api));
      if (isset($response->status) && $response->status == 'success') {
            return $response->message;
      }
}
?>

<script type="text/javascript">
      function adicionar() {
            localStorage.setItem("breed", document.breed.select_breed.value);
            alert("Raça:" + localStorage.getItem("breed"));
      }
</script>

<!DOCTYPE html>
<html lang="pt">

<head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Cachorros</title>
      <link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>

<body>
      <header>
            <!-- <h1> Selecione a raça do cachorro </h1> -->
      </header>
      <div id="app">
            <section id="search">
                  <form name="breed" method="POST">
                        <select id="type-search" name="select_breeds" required>
                              <option value="" disabled selected>Selecione a raça do cachorro</option>
                              <?php
                              foreach ($breeds as $key => $value) { ?>
                                    <option value="<?php echo $key ?>">
                                          <?php echo $key ?>
                                    </option>
                              <?php  } ?>
                        </select>
                        <input type="submit" value="PESQUISAR">
                  </form>
            </section>
            <div id="content">
                  <?php
                  if (isset($_POST['select_breeds'])) {

                        $selected_breed = $_POST['select_breeds'];
                        $dogs_breed = getByBreed($selected_breed);
                  ?>
                        <script>
                              adicionar();
                        </script>
                        <div class="grid-container">
                              <h1> Dê um nome para o cachorro </h1>
                              <div class="grid-item">
                                    <img class="dog_img" src="<?php echo $dogs_breed; ?>">
                              </div>
                              <form method="POST" action="">
                                    <input type="text" class="dog_info" name="dog_name" placeholder="Nome">
                                    <select class="dog_info" name="font" required>
                                          <option value="" disabled selected>Selecione uma fonte</option>
                                          <option value=""></option>
                                          <option value=""></option>
                                          <option value=""></option>
                                          <option value=""></option>
                                          <option value=""></option>
                                    </select>
                                    <select class="dog_info" name="color" required>
                                          <option value="" disabled selected>Selecione uma cor</option>
                                          <option style="color:#0000ff" value="#0000ff">Azul</option>
                                          <option style="color:#FF0000" value="#FF0000">Vermelho</option>
                                          <option style="color:#ffa500" value="#ffa500">Laranja</option>
                                          <option style="color:#008000" value="#008000">Verde</option>
                                          <option style="color:#ffcbdb" value="#ffcbdb">Rosa</option>
                                    </select>
                                    <input type="submit" value="Salvar">
                              </form>
                        <?php
                  }
                        ?>
                        </div>
                        <?php
                        if (isset($_POST['dog_name'])) {
                              $name = $_POST['dog_name'];
                              $font = $_POST['font'];
                              $color = $_POST['color'];
                        ?>
                              <div class="grid-container">
                                    <div class="grid-item">
                                          <h1> Esse foi o cachorro selecionado </h1>
                                          <div class="grid-item">
                                                <img class="dog_img" src="<?php echo $dogs_breed; ?>">
                                          </div>
                                          <p style="color:<?php echo $color ?>"><?php echo $name ?></p>
                                    </div>
                              <?php
                        }
                              ?>
                              </div>
            </div>
      </d   iv>
</body>

</html>