<!DOCTYPE html>
<html>
    <head>

    </head>
    <body>
        <h1>This is The view For Book</h1>
        <div>
            <table border="1px" >
                <tr>
                    <th>ID</th>
                    <th>NAME</th>
                    <th>AUTHOR</th>
                    <th>EDITION</th>
                    <th>DESCRIPTION</th>
                    <th>PRICE</th>
                    <th>DATE OF PUBLISHED</th>
                </tr>
                <@foreach($books as $book)
                    <tr>
                        <td>{{$book->id}}</td>
                        <td>{{$book->name}}</td>
                        <td>{{$book->author}}</td>
                        <td>{{$book->edition}}</td>
                        <td>{{$book->description}}</td>
                        <td>{{$book->price}}</td>
                        <td>{{$book->created_at}}</td>
                    </tr>
                @endforeach
            </table>

        </div>
    </body>
</html>