<!-- Page Content -->
<!-- Banner Starts Here -->
<div class="banner">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="caption">
                    <h2>Book Sale!</h2>
                    <div class="line-dec"></div>
                    <p>"Diskon Spesial! Harga Terbaik untuk Koleksi Favorit Anda 🌟"</p>
                    <div class="main-button">
                        <a href="#">Order Now!</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Banner Ends Here -->

<!-- Featured Starts Here -->
<div class="featured-items">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-heading">
                    <div class="line-dec"></div>
                        <h1><?= isset($keyword) ? 'Search Results' : 'Featured Items' ?></h1>
                    </div>
                </div>
            </div>
                <div class="col-md-12">  
                    <?php if (empty($books)) : ?>
		                    <a class="btn btn-success" href="<?= base_url('books/create') ?>" role="button">Add New Book</a>	 
                        <p>No results found.</p>
                    <?php else : ?>
                            <a class="btn btn-success" href="<?= base_url('books/create') ?>" role="button">Add New Book</a>		 
                        <div class="owl-carousel owl-theme">
                            <?php foreach ($books as $book): ?>
                                <a href="<?= base_url() ?>books/details/<?= $book['_id']->{'$id'} ?>">
                                    <div class="featured-item">
                                    <img src="<?= $book['cover_image'] ?>" alt="<?= $book['title'] ?>" class="img-fluid" />
                                        <h4><?= $book['title'] ?></h4>
                                        <p><?= $book['author'] ?></p>
                                        <br>
                                        <h6>Rp <?= number_format($book['price'], 2, ',', '.') ?></h6>
                                    </div>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
        </div>
    </div>
<!-- Featured Ends Here -->
