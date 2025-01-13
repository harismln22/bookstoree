<!-- Page Content -->
<!-- Banner Starts Here -->
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="caption">
					<h2 align="center">Add New Book</h2>
					    <div class="line-dec"></div>
					    <p align="center">
					    	"Tambahkan koleksi buku baru"
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
					<h1>Add Book Details</h1>
				</div>
			</div>
			<div class="col-md-12">
				<form action="<?= base_url('books/store') ?>" method="post" enctype="multipart/form-data">
					<div class="form-group">
						<label for="title">Title</label>
						<input type="text" class="form-control" name="title" required>
					</div>
					<div class="form-group">
						<label for="author">Author</label>
						<input type="text" class="form-control" name="author" required>
					</div>
					<div class="form-group">
						<label for="price">Price</label>
						<input type="number" class="form-control" name="price" required>
					</div>
					<div class="form-group">
						<label for="category">Category</label>
						<input type="text" class="form-control" name="category" required>
					</div>
					<div class="form-group">
						<label for="stock">Stock</label>
						<input type="number" class="form-control" name="stock" required>
					</div>
                    <div class="form-group">
						<label for="ISBN">ISBN</label>
						<input type="text" class="form-control" name="ISBN" required>
					</div>
                    <div class="form-group">
						<label for="pages">Pages</label>
						<input type="text" class="form-control" name="pages" required>
					</div>
                    <div class="form-group">
						<label for="publisher">Publisher</label>
						<input type="text" class="form-control" name="publisher" required>
					</div>
                    <div class="form-group">
                        <label for="language">Languages</label>
                        <select class="form-control" name="language" required>
                            <option value="indonesia">Indonesia</option>
                            <option value="english">English</option>
                        </select>
                    </div>
					<div class="form-group">
						<label for="description">Description</label>
						<textarea class="form-control" name="description" rows="3" required></textarea>
					</div>
					<div class="form-group">
						<label for="cover_image">Cover Image URL</label>
						<input type="text" class="form-control" name="cover_image" required>
					</div>
					<div class="main-button">
						<button type="submit" class="btn btn-primary">Add Book</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- Form Ends Here -->
