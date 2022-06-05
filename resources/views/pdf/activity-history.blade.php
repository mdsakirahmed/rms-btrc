@extends('layouts.pdf.app')
@section('content')

<table style="width: 100%;">
    <thead>
        <tr>
            <th>#</th>
            <th>User</th>
            <th>Action</th>
            <th>Message</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($collections as $collection)
        <tr @if($loop->odd) style="background: #F7F4F3" @endif>
            <td>{{ $collection->id }}</td>
            <td>{{ $collection->causer->name ?? 'Not Found' }}</td>
            <td>{{ $collection->log_name }}</td>
            <td>{{ $collection->description }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
