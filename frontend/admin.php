<?php
    include('headers.php');
?>
<div class="container">
    <h1 class="d-flex align-items-center justify-content-center">Admin Panel</h1>
    <?php
        session_start();
        $formToggle = isset($_POST['formToggle']) ? $_POST['formToggle'] : 'dvd';
        $_SESSION['formToggle'] = $formToggle;
    ?>
    <form method="post">
        <div class="container d-flex align-items-center justify-content-center">
            <div class="col-md-6">
                <label for="formToggle" class="form-label">Select a table:</label>
                <select name="formToggle" id="formToggle" class="form-select" onchange="this.form.submit()">
                    <option value="dvd" <?php if ($formToggle === 'dvd') echo 'selected'; ?>>DVDs</option>
                    <option value="genre" <?php if ($formToggle === 'genre') echo 'selected'; ?>>Genres</option>
                </select>
            </div>
        </div>
    </form>

    <form method="post" <?php if ($formToggle === 'dvd') echo 'style="display:block;"'; else echo 'style="display:none;"'; ?>>
        <div class="container mt-5">
            <h2 class="mb-4 text-center">Add DVD</h2>

            <div class="mb-3 row justify-content-center">
                <label for="title" class="col-sm-2 col-form-label">Title:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="title" required>
                </div>
            </div>

            <div class="mb-3 row justify-content-center">
                <label for="genreId" class="col-sm-2 col-form-label">Genre ID:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="genreId" required>
                </div>
            </div>

            <div class="mb-3 row justify-content-center">
                <label for="price" class="col-sm-2 col-form-label">Price:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="price" required>
                </div>
            </div>

            <div class="mb-3 row justify-content-center">
                <label for="stockQuantity" class="col-sm-2 col-form-label">Stock Quantity:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="stockQuantity" value="0">
                </div>
            </div>

            <div class="mb-3 row justify-content-center">
                <label for="imageURL" class="col-sm-2 col-form-label">Image URL:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="imageURL">
                </div>
            </div>

            <div class="mb-3 row justify-content-center">
                <label for="description" class="col-sm-2 col-form-label">Description:</label>
                <div class="col-sm-6">
                    <textarea class="form-control" name="description"></textarea>
                </div>
            </div>

            <div class="mb-3 row justify-content-center">
                <div class="col-sm-6">
                    <button type="submit" class="btn btn-primary" name="action" value="add_dvd">Add DVD</button>
                </div>
            </div>
        </div>
    </form>



    <!-- Genre Form -->
    <form method="post" <?php if ($formToggle === 'genre') echo 'style="display:block;"'; else echo 'style="display:none;"'; ?>>
        <div class="container mt-5">    
            <h2 class="mb-4 text-center">Add Genre</h2>
            <div class="mb-3 row justify-content-center">
                <label for="genreName" class="col-sm-2 col-form-label">Genre Name:</label>
                <div class="col-sm-4">
                    <input type="text" name="genreName" class="form-control" required>
                </div>
            </div>
            <div class="mb-3 row justify-content-center">
                <div class="col-sm-6">
                    <button type="submit" class="btn btn-primary" name="action" value="add_genre">Add Genre</button>
                </div>
            </div>
        </div>
    </form>
</div>
</main>
<?php
    include('footers.php');
?>