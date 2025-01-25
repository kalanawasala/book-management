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
        <div>
            <!-- to  get the errors of inpult filed if form validation failed-->
            @if ($errors->any())
            <ul>    
                @foreach ($errors->all() as $error)

                <li>{{$error}}</li>
                    
                @endforeach

            </ul>    
            @endif

        </div>
    </div>
        
    <div>
        <form method="post" action="" >
            @csrf
            @method("post")
            <fieldset>
                <legend>Book Register :</legend>
                <div>
                    <label for="name" id='name'>Book Name</label><br>
                    <input type="text" name="name" placeholder="Enter Book Name" value="{{$book->name}}" autocomplete="on">   
                </div>
                <div>
                    <label for="author"> Author</label><br>
                    <input type="text" name="author" placeholder="Enter Book Author" value="{{$book->author}}" autocomplete="on">   
                </div>
                <div>
                    <label for="edition">Book Edition</label><br>
                    <input type="text" name="edition" placeholder="Enter Book Edition" value="{{$book->edition}}" autocomplete="on">   
                </div>
                <div>
                    <label for="description">Book Description</label><br>
                    <input type="text" name="description" placeholder="Enter Book Description" value="{{$book->description}}" autocomplete="on" >   
                </div>
                <div>
                    <label for="price">Book Price</label><br>
                    <input type="text" name="price" placeholder="Enter Book Price" value="{{$book->price}}" autocomplete="on">   
                </div>
                <div>
                    <label for="created_at">Date Of Publish</label><br>
                    <input type="text" name="created_at" placeholder="Enter Book Publish Date" value="{{$book->created_at}}" autocomplete="on">   
                </div>
                <div>
                    <br>
                    <button type="submit">Update</button>   
                </div>
            </fieldset>
        </form>
    </div>

</body>
</html>