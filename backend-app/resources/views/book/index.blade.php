<!DOCTYPE html>
<html>
    <head>

    </head>
    <body>
        <h1>This is The view For Book</h1>
        <div>
            <a href="{{route('book.register')}}">Register New Book</a>
        </div>
        <div>
            @if(session()->has('success'))
            <div>
                {{session('success')}}
            </div>
            @endif
        </div>
            <table border="1px">
                <tr>
                    <th>ID</th>
                    <th>NAME</th>
                    <th>AUTHOR</th>
                    <th>EDITION</th>
                    <th>DESCRIPTION</th>
                    <th>PRICE</th>
                    <th>DATE OF PUBLISHED</th>
                    <th>EDIT</th>
                    <th>DELETE</th>
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
                        <td><a href="{{route('book.edit',$book)}}">EDIT</a></td>
                        <td>
                            <form method="post" action="{{route('book.destroy',['book'=>$book])}}">
                                @csrf
                                @method('delete')
                                <input type="submit" value="DELETE"/>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </table>
        </body>
</html>