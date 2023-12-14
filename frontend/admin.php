<?php
include('headers.php');
?>

<style>
    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    th, td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
    }
</style>

<div class="container">
    <h1 class="d-flex align-items-center justify-content-center">Admin Panel</h1>

    <form method="post">
        <div class="container d-flex align-items-center justify-content-center">
            <div class="col-md-6">
                <label for="formToggle" class="form-label">Select a table:</label>
                <select name="formToggle" id="formToggle" class="form-select">
                    <option value="dvd" selected>DVDs</option>
                    <option value="genre">Genres</option>
                </select>
            </div>
        </div>
    </form>

    <form id="dvdForm" method="post" style="display:block;">
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
                    <button id="addDvdBtn" type="submit" class="btn btn-primary" name="action" value="add_dvd">Add DVD
                    </button>
                </div>
            </div>
        </div>
        <h2>DVD table Details</h2>
        <table id="dvd"></table>
    </form>


    <form id="genreForm" method="post" style="display:none;">
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
                    <button id="addgenrebtn" type="submit" class="btn btn-primary" name="action" value="add_genre">Add
                        Genre
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

</main>
<?php
include('footers.php');
?>

<script>
    function formToggle() {
        const formToggleValue = document.getElementById('formToggle').value;
        const DVDForm = document.getElementById('dvdForm');
        const GenreForm = document.getElementById('genreForm');

        if (formToggleValue === 'dvd') {
            GenreForm.style.display = 'none';
            DVDForm.style.display = 'block';
        } else {
            GenreForm.style.display = 'block';
            DVDForm.style.display = 'none';
        }
    }

    document.getElementById('formToggle').addEventListener('change', formToggle);


    (() => {
        const adminLoginXhr = new XMLHttpRequest();
        adminLoginXhr.open('GET', '/group-project-DVD-store/API.php/adminStatus', true);

        adminLoginXhr.onreadystatechange = function () {
            if (adminLoginXhr.readyState === XMLHttpRequest.DONE) {
                if (adminLoginXhr.status === 200) {
                    const response = JSON.parse(adminLoginXhr.responseText);
                    if (!response.$isAdmin) {
                        window.location.replace('login.php');
                    }
                } else {
                    console.error('Error:', adminLoginXhr.status);
                }
            }
        };

        adminLoginXhr.send();
    })();


    document.getElementById('addDvdBtn').addEventListener('click', function (event) {
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

    document.getElementById('addgenrebtn').addEventListener('click', function (event) {
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

    async function getDvds() {
        const xmlHttp = new XMLHttpRequest();

        xmlHttp.onreadystatechange = function () {
            if (this.readyState === 4) {
                if (this.status === 200) {
                    const response = JSON.parse(this.responseText);

                    if (response.hasOwnProperty('items')) {

                        const dvds = response.items;

                        const dvdTable = document.getElementById('dvd');

                        dvdTable.innerHTML = '';

                        let tableHTML = `
                    <tr>
                        <th>Title</th>
                        <th>Genre Name</th>
                        <th>Price</th>
                        <th>Image URL</th>
                        <th>Action</th>
                    </tr>
                `;

                        dvds.forEach(function (dvd) {
                            console.log(dvd);
                            tableHTML += `
        <tr>
            <td>${dvd.Title}</td>
            <td>${dvd.genreName}</td>
            <td>$${dvd.Price}</td>
            <td><img src="${dvd.imageURL}" alt="DVD Image" style="width: 100px; height: auto;"></td>
            <td>
                <button onclick="editDVDQuanity('${dvd.id}')">Edit</button>
                <button onclick="deleteDVD('${dvd.id}')">Delete</button>
            </td>
        </tr>
    `
                        });

                        dvdTable.innerHTML = tableHTML;
                    } else {
                        const errorMessage = '<p>Error: No DVD items found.</p>';
                        document.getElementById('dvd').innerHTML = errorMessage;
                    }
                } else {
                    console.error("Error: " + this.status);
                }
            }
        };

        xmlHttp.open("GET", '/group-project-DVD-store/API.php/dvds', true);

        xmlHttp.send();
    }


    getDvds();


    function deleteDVD(id) {
        const confirmation = confirm('Are you sure you want to delete this DVD?');

        if (confirmation) {
            const deleteDvdXhr = new XMLHttpRequest();
            deleteDvdXhr.open('POST', '/group-project-DVD-store/API.php', true);
            deleteDvdXhr.setRequestHeader('Content-Type', 'application/json');

            deleteDvdXhr.onreadystatechange = function () {
                if (deleteDvdXhr.readyState === XMLHttpRequest.DONE) {
                    if (deleteDvdXhr.status === 200) {
                        getDvds();
                    } else {
                        console.error('Error:', deleteDvdXhr.status);
                    }
                }
            };

            const deleteDvdRequestBody = JSON.stringify({
                action: 'deleteDVD',
                DVDId: id
            });

            deleteDvdXhr.send(deleteDvdRequestBody);
        }
    }


</script>
