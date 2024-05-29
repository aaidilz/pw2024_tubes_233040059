<?php
require 'app/controller/IndexController.php';

$controller = new IndexController($conn);
$inventories = $controller->getAllInventory();
$categories = $controller->getAllCategory();
?>

<section>
  <br>
  <br>
  <br>
</section>
<!-- hero section -->
<section class="justify-content-center align-items-center">
  <div class="container">
    <div class="row">
      <div class="col-md-6 d-flex flex-column justify-content-center mb-3">
        <div class="container">
          <h1 class="text-white">Get your merchandise with STACKED</h1>
          <hr class="bg-white" style="height: 2px;">
          <p class="text-white fs-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem ullam officia
            laudantium illo dignissimos est atque maxime velit dicta magnam.</p>
          <!-- button -->
          <a href="login.php" class="btn btn-primary mt-4">GET STARTED</a>
        </div>
      </div>
      <div class="col-md-6">
        <img src="https://pnghq.com/wp-content/uploads/genshin-png-stickers-png-download-52499-768x698.png"
          class="img-fluid">
      </div>
    </div>
  </div>
</section>
<section>
  <br>
  <br>
  <br>
</section>
<section>
  <div class="container mb-5">
    <div class="swiper mySwiper">
      <div class="swiper-wrapper">
        <div class="swiper-slide">
          <img src="https://blog.upes.ac.in/wp-content/uploads/2022/04/Untitled-design-4-1024x576.png">
        </div>
        <div class="swiper-slide">
          <img src="https://th.bing.com/th/id/OIP.2XwREaDTYMT_FV2YGj47mwHaEK?rs=1&pid=ImgDetMain">
        </div>
        <div class="swiper-slide">
          <img
            src="https://cdn.shopify.com/s/files/1/0602/2617/5224/files/8af1c411-031e-474a-bf0c-03ac0e3113ce_600x600.png?v=1681954708">
        </div>
        <div class="swiper-slide">
          <img src="https://cdn1.clickthecity.com/wp-content/uploads/2021/07/06123646/Anime-merch-600x338.png">
        </div>
        <div class="swiper-slide">
          <img src="https://i.ytimg.com/vi/FZq_cxcOStI/maxresdefault.jpg">
        </div>
        <div class="swiper-slide">
          <img src="https://awesomestuff365.com/wp-content/uploads/2022/08/4-5.jpg">
        </div>
      </div>
      <div class="swiper-button-next"></div>
      <div class="swiper-button-prev"></div>
    </div>
  </div>
</section>

<section>
  <div class="container">
    <div class="mb-3 text-white">
      <h4>Recent added!</h4>
    </div>
    <div class="row row-cols-2 row-cols-md-6">
      <?php
      if (empty($inventories)) {
        // Jika tidak ada data dalam $inventories
        ?>
        <div class="col">
          <div class="card text-center" style="width: 10rem;">
            <div class="card-body">
              <h5 class="card-title">gak ada data terbaru :(</h5>
            </div>
          </div>
        </div>
        <?php
      } else {
        usort($inventories, function ($a, $b) {
          $dateA = isset ($a['created_at']) ? strtotime($a['created_at']) : strtotime($a['updated_at']);
          $dateB = isset ($b['created_at']) ? strtotime($b['created_at']) : strtotime($b['updated_at']);
          return $dateB - $dateA;
        });
        $count = 0;
        foreach ($inventories as $inventory) {
          if ($count >= 5) {
            break;
          }
          ?>
          <div class="col">
            <div class="custom-card text-white">
              <a href="orders.php?id=<?php echo $inventory['id']; ?>">
                <img src="uploads/<?php echo $inventory['gambar']; ?>" class="card-img-top">
              </a>
            </div>
            <div class="custom-card-text">
              <a href="orders.php?id=<?php echo $inventory['id']; ?>" class="text-decoration-none">
                <h5 class="card-title text-white"><?php echo $inventory['nama']; ?></h5>
              </a>
            </div>
          </div>
          <?php
          $count++;
        }
      }
      ?>
    </div>
  </div>
</section>

<section>
  <br>
  <br>
  <br>
</section>

<section>
  <div class="container mb-3">
    <div class="mb-3 text-white">
      <h4>Carilah barang kesukaan mu!</h4>
    </div>

    <div class="mb-3 text-white">
      <form class="d-flex" id="searchForm">
        <input class="form-control me-2" type="search" id="searchInput" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-light" type="submit">Search</button>
      </form>
    </div>

    <div class="d-flex flex-wrap">
      <!-- foreach category -->
      <?php foreach ($categories as $category) { ?>
        <button class="btn btn-primary m-1 category-btn"
          data-id="<?php echo $category['id']; ?>"><?php echo $category['nama']; ?></button> <?php } ?>
    </div>
  </div>

  <div class="container justify-content-center">
    <div class="row pb-5 mb-4" id="inventoryItems">
      <?php foreach ($inventories as $inventory) { ?>
        <div class="col-lg-4 col-md-6 mb-4">
          <div class="card rounded shadow-sm border-0">
            <div class="card-body p-4">
              <div class="card-img-wrapper">
                <img src="uploads/<?php echo $inventory['gambar']; ?>" alt="" class="img-fluid d-block mx-auto mb-3">
              </div>
              <h5>
                <a href="orders.php?id=<?php echo $inventory['id']; ?>"
                  class="text-dark"><?php echo $inventory['nama']; ?></a>
              </h5>
              <p class="small text-muted font-italic">Stock: <?php echo $inventory['kuantitas']; ?></p>
              <h4>Rp<?php echo $inventory['harga']; ?></h4>
            </div>
          </div>
        </div>
      <?php } ?>
    </div>
  </div>
</section>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
  integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
  crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  <script>
  $(document).ready(function () {
    // init first search 
    // Event listener for search form submission
    $('#searchForm').on('submit', function (e) {
      e.preventDefault();
      searchInventory($('#searchInput').val(), 'nama');
    });

    // Event listener for category buttons
    $('.category-btn').on('click', function () {
      searchInventory('', 'kategori_id', $(this).data('id'));
    });
  });

  function searchInventory(query, column, categoryId) {
    $.ajax({
      url: '../app/controller/GetIndexController.php',
      method: 'POST',
      data: {
        query: query,
        column: column,
        categoryId: categoryId
      },
      success: function (data) {
        $('#inventoryItems').html(data);
      }
    });
  }
</script>