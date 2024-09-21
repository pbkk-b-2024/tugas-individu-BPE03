@extends('dashboard.base')

@section('title', 'Fibonacci')

@section('content')
<h1>Masukkan Angka</h1>
<form action='#' method="GET">
    <label for="n">Enter a number (n):</label>
    <input type="text" name="n" id="n" min="1" required>
    <button type="submit">Submit</button>
</form>

@if(count($num) > 0)
    <h2>Hasil</h2>  
    <table border="1">
        <thead>
            <tr>
                <th>Angka Fibonacci</th>
            </tr>
        </thead>
        <tbody>
            @foreach($num as $n)
                <tr>
                    <td>{{ $n }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif
@endsection