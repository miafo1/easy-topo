<!-- search_form.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Land Search</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Search for Land</h1>
        <form action="search_land.php" method="POST">
            <label for="search_query">Enter your land requirements:</label>
            <textarea name="search_query" id="search_query" class="form-control" rows="4" placeholder="Example: I need land in Nkomo, 2 acres, under 200,000fr for residential purposes"></textarea>
            <button type="submit" class="btn btn-primary mt-3">Search</button>
        </form>
    </div>
</body>
</html>
