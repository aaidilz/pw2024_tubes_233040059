<!-- add category form -->

<div class="container-fluid">
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h1>Welcome to Your Add Category Page</h1>
            </div>
            <div class="card-body">
                <form action="../controller/categoryController.php?action=add" method="POST">
                    <div class="mb-3">
                        <label for="name" class="form-label">Category Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <input type="text" class="form-control" id="description" name="description" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>