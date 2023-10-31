<table border="1">
    <tr>
        <td>id</td>
        <td>Nombre</td>
        <td>Email</td>
        <td>Creacion</td>
    </tr>
    @foreach($users as $i)
        <tr>
            <td>{{$i->id}}</td>
            <td>{{$i->name}}</td>
            <td>{{$i->email}}</td>
            <td>{{$i->created_at->format('h:m - d-M-Y')}}</td>
        </tr>
    @endforeach
</table>
