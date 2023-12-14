<?php
    include('headers.php');
?>

<script>
     function formToggle(form) {
        const DVDForm = document.getElementById('dvdForm');
        const GenreForm = document.getElementById('genreForm');

        if (form === 'dvd') {
            GenreForm.style.display = 'none';
            DVDForm.style.display = 'block';
            <?php $_SESSION['formToggle'] = 'dvd'; ?>
        } else {
            GenreForm.style.display = 'block';
            DVDForm.style.display = 'none';
            <?php $_SESSION['formToggle'] = 'genre'; ?>
        }
    }

    addDvdBtn.addEventListener('click', function (event) {
            console.log("add DVD Button-clicked");
            event.preventDefault();

            const dvdTitle = document.getElementById('title').value;
            const dvdGennreId = document.getElementById('genreId').value;
            const dvdPrice = document.getElementById('price').value;
            const dvdStockQuantity = document.getElementById('stockQuantity').value;
            const dvdImageUrl = document.getElementById('imageURL').value;
            const dvdDescription = document.getElementById('description').value;

            const addDvdXhr = new XMLHttpRequest();
            addDvdXhr.open('POST', '/group-project-DVD-store/API.php', true);
            addDvdXhr.setRequestHeader('Content-Type', 'application/json');

            addDvdXhr.onreadystatechange = function () {
                if (addDvdXhr.readyState === XMLHttpRequest.DONE) {
                    if (addDvdXhr.status === 200) {
                        // window.location.replace("admin.php");
                    } else {
                        console.error('Error:', addDvdXhr.status);
                    }
                }
            };

            const addDvdRequestBody = JSON.stringify({
                action: 'createDVD',
                Title: dvdTitle,
                GenreId: dvdGennreId,
                Price: dvdPrice,
                stockQuantity: dvdStockQuantity,
                imageURL: dvdImageUrl,
                description: dvdDescription
            });

            addDvdXhr.send(addDvdRequestBody);
        });

        addgenrebtn.addEventListener('click', function (event) {
            console.log("add Genre Button-clicked");
            event.preventDefault();

            const dvdGenreName = document.getElementById('genreName').value;

            const addGenreXhr = new XMLHttpRequest();
            addGenreXhr.open('POST', '/group-project-DVD-store/API.php', true);
            addGenreXhr.setRequestHeader('Content-Type', 'application/json');

            addGenreXhr.onreadystatechange = function () {
                if (addGenreXhr.readyState === XMLHttpRequest.DONE) {
                    if (addGenreXhr.status === 200) {
                        window.location.replace("admin.php");
                    } else {
                        console.error('Error:', addGenreXhr.status);
                    }
                }
            };

            const addGenreRequestBody = JSON.stringify({
                action: 'createGenre',
                genreName: dvdGenreName,
    
            });

            addGenreXhr.send(addGenreRequestBody);
        });
        // api url
const api_url = 
	"/group-project-DVD-store/API.php/dvds";

// Defining async function
async function getapi(url) {

	// Storing response
	const response = await fetch(url);

	// Storing data in form of JSON
	var data = await response.json();
	console.log(data);
	if (response) {
		hideloader();
	}
	show(data);
}
// Calling that async function
getapi(api_url);

// Function to hide the loader
function hideloader() {
	document.getElementById('loading').style.display = 'none';
}
// Function to define innerHTML for HTML table
function show(data) {
	let tab = 
		`<tr>
		<th>Title</th>
		<th>Genre ID</th>
		<th>Price</th>
		<th>Stock Quantity</th>
        <th>Image URL</th>
		<th>Description</th>
        <th>Action</th>
		<th>Action</th>
		</tr>`;

	// Loop to access all rows 
	for (let r of data.list) {
		tab += `<tr> 
	<td>${r.Title} </td>
	<td>${r.GenreId}</td>
	<td>${r.Price}</td> 
	<td>${r.StockQuantity}</td>		
    <td>${r.imageURL}</td> 
	<td>${r.description}</td>	
    <td>
            <button onclick="editDVDQuanity('${r.id}')">Edit</button>
            <button onclick="deleteDVD('${r.id}')">Delete</button>
    </td>
</tr>`;
	}
	// Setting innerHTML as tab variable
	document.getElementById("dvd").innerHTML = tab;

}

// Function to handle the delete button click
function deleteDVD(id) {
    const confirmation = confirm('Are you sure you want to delete this DVD?');

    if (confirmation) {
        const deleteDvdXhr = new XMLHttpRequest();
        deleteDvdXhr.open('DELETE', '/group-project-DVD-store/API.php', true);
        deleteDvdXhr.setRequestHeader('Content-Type', 'application/json');

        deleteDvdXhr.onreadystatechange = function () {
            if (deleteDvdXhr.readyState === XMLHttpRequest.DONE) {
                if (deleteDvdXhr.status === 200) {
                    // Refresh the table or update the UI as needed
                    getapi(api_url);
                } else {
                    console.error('Error:', deleteDvdXhr.status);
                }
            }
        };

        const deleteDvdRequestBody = JSON.stringify({
            action: 'deleteDVD',
            id: id
        });

        deleteDvdXhr.send(deleteDvdRequestBody);
    }
}

</script>



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

    <form id="dvdForm" method="post" <?php if ($formToggle === 'dvd') echo 'style="display:block;"'; else echo 'style="display:none;"'; ?>>
        <div class="container mt-5">
            <h2 class="mb-4 text-center">Add DVD</h2>

            <div class="mb-3 row justify-content-center">
                <label for="title" class="col-sm-2 col-form-label">Title:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="title" name="title" required>
                </div>
            </div>

            <div class="mb-3 row justify-content-center">
                <label for="genreId" class="col-sm-2 col-form-label">Genre ID:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="genreId" name="genreId" required>
                </div>
            </div>

            <div class="mb-3 row justify-content-center">
                <label for="price" class="col-sm-2 col-form-label">Price:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="price" name="price" required>
                </div>
            </div>

            <div class="mb-3 row justify-content-center">
                <label for="stockQuantity" class="col-sm-2 col-form-label">Stock Quantity:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="stockQuantity" name="stockQuantity" value="0">
                </div>
            </div>

            <div class="mb-3 row justify-content-center">
                <label for="imageURL" class="col-sm-2 col-form-label">Image URL:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="imageURL" name="imageURL">
                </div>
            </div>

            <div class="mb-3 row justify-content-center">
                <label for="description" class="col-sm-2 col-form-label">Description:</label>
                <div class="col-sm-6">
                    <textarea class="form-control" id="description" name="description"></textarea>
                </div>
            </div>

            <div class="mb-3 row justify-content-center">
                <div class="col-sm-6">
                    <button id="addDvdBtn" type="submit" class="btn btn-primary" name="action" value="add_dvd">Add DVD</button>
                </div>
            </div>
        </div>
        <h2>DVD table Details</h2>
        <table id="dvd"></table>
    </form>



    <form id="genreForm" method="post" <?php if ($formToggle === 'genre') echo 'style="display:block;"'; else echo 'style="display:none;"'; ?>>
        <div class="container mt-5">    
            <h2 class="mb-4 text-center">Add Genre</h2>
            <div class="mb-3 row justify-content-center">
                <label for="genreName" class="col-sm-2 col-form-label">Genre Name:</label>
                <div class="col-sm-4">
                    <input id="genreName" type="text" name="genreName" class="form-control" required>
                </div>
            </div>
            <div class="mb-3 row justify-content-center">
                <div class="col-sm-6">
                    <button id="addgenrebtn" type="submit" class="btn btn-primary" name="action" value="add_genre">Add Genre</button>
                </div>
            </div>
        </div>
    </form>
</div>

</main>
<?php
    include('footers.php');
?>
