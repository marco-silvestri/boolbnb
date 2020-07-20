<div class="container">
        <table class="table">
            <thead>
                <tr class="text-primary">
                    <th>Mittente:</th>
                    <th>Appartamento:</th>
                    <th>Title:</th>
                    <th>Contenuto:</th>
                    <th>Ricevuto:</th>
                </tr> 
            </thead>
            <tbody>
                @foreach ($messageForApartment as $message)
                        @foreach ($message as $item)
                        <tr>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->apartment->name }}</td>
                            <td>{{ $item['title'] }}</td>
                            <td>{{ $item['body'] }}</td>
                            <td>{{ $item['created_at']->diffForHumans()}}</td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    </div>