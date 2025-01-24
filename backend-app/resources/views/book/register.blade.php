<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Book Register</title>
</head>
<body>
    <div>
        <form method="post" action={{ route('book.store') }} >
            @csrf
            @method("post")
            <fieldset>
                <legend>Book Register :</legend>
                <div>
                    <label for="name">Book Name</label><br>
                    <input type="text" name="name" placeholder="Enter Book Name">   
                </div>
                <div>
                    <label for="author"> Author</label><br>
                    <input type="text" name="author" placeholder="Enter Book Author">   
                </div>
                <div>
                    <label for="edition">Book Edition</label><br>
                    <input type="text" name="edition" placeholder="Enter Book Edition">   
                </div>
                <div>
                    <label for="description">Book Description</label><br>
                    <input type="text" name="description" placeholder="Enter Book Description">   
                </div>
                <div>
                    <label for="name">Book Price</label><br>
                    <input type="text" name="price" placeholder="Enter Book Price">   
                </div>
                <div>
                    <label for="date">Date Of Publish</label><br>
                    <input type="text" name="created_at" placeholder="Enter Book Publish Date">   
                </div>
                <div>
                    <br>
                    <button type="submit">Register Book</button>   
                </div>
            </fieldset>
        </form>
    </div>

</body>
</html>