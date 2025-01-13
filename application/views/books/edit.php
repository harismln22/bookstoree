<!-- Page Content -->
<!-- Banner Starts Here -->
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="caption">
					<h2 align="center">Edit Book</h2>
					<div class="line-dec"></div>
					<p align="center">
						"Perbarui informasi koleksi buku"
					</p>
				</div>
			</div>
		</div>
	</div>
<!-- Banner Ends Here -->

<!-- Form Starts Here -->
<div class="featured-items">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="section-heading">
					<div class="line-dec"></div>
					<h1>Edit Book Details</h1>
				</div>
			</div>
			<div class="col-md-12">
                <form action="<?= base_url('books/update/' . $book['_id']->{'$id'}) ?>" method="post" enctype="multipart/form-data">
					<div class="form-group">
						<label for="title">Title</label>
						<input type="text" class="form-control" name="title" value="<?= $book['title'] ?>" required>
					</div>
					<div class="form-group">
						<label for="author">Author</label>
						<input type="text" class="form-control" name="author" value="<?= $book['author'] ?>" required>
					</div>
					<div class="form-group">
						<label for="price">Price</label>
						<input type="number" class="form-control" name="price" value="<?= $book['price'] ?>" required>
					</div>
					<div class="form-group">
						<label for="category">Category</label>
						<input type="text" class="form-control" name="category" value="<?= $book['category'] ?>" required>
					</div>
					<div class="form-group">
						<label for="stock">Stock</label>
						<input type="number" class="form-control" name="stock" value="<?= $book['stock'] ?>" required>
					</div>
                    <div class="form-group">
                        <label for="ISBN">ISBN</label>
						<input type="text" class="form-control" name="ISBN" value="<?= $book['ISBN'] ?>"required>
					</div>
                    <div class="form-group">
                        <label for="pages">Pages</label>
                        <input type="number" class="form-control" name="pages" value="<?= $book['pages'] ?>"required>
                    </div>
                    <div class="form-group">
						<label for="publisher">Publisher</label>
						<input type="text" class="form-control" name="publisher" value="<?= $book['publisher'] ?>"required>
					</div>
                    <div class="form-group">
						<label for="publishedDate">Published Date</label>
						<input type="text" class="form-control" name="publisherDate" value="<?= $book['published_date'] ?>"required>
					</div>
					<div class="form-group">
						<label for="description">Description</label>
						<textarea class="form-control" name="description" rows="3" required><?= $book['description'] ?></textarea>
					</div>                    
                    <div class="form-group">
                        <label for="language">Languages</label>
                        <select class="form-control" name="language" value="<?= $book['language'] ?>" required>
                            <option value="indonesia">Indonesia</option>
                            <option value="english">English</option>
                        </select>
                    </div>
					<div class="form-group">
						<label for="cover_image">Cover Image URL</label>
						<input type="text" class="form-control" name="cover_image" value="<?= $book['cover_image'] ?>" required>
					</div>
					<div class="main-button">
						<button type="submit" class="btn btn-primary">Update Book</button>
					</div>
				</for>
			</div>
		</div>
	</div>
</div>
<!-- Form Ends Here -->
