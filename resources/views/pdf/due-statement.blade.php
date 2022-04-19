@extends('layouts.pdf.app')
@section('content')

    <table style="width: 100%;">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Operator name</th>
                <th scope="col">Category name</th>
                <th scope="col">Sub Category name</th>
                <th scope="col">Fee type name</th>
                <th scope="col">Period date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($collections as $collection)
                <tr @if($loop->odd) style="background: #F7F4F3" @endif>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $collection->operator_name }}</td>
                    <td>{{ $collection->category_name }}</td>
                    <td>{{ $collection->sub_category_name }}</td>
                    <td>{{ $collection->fee_type_name }}</td>
                    <td>{{ date('d-m-Y', strtotime($collection->period_date)) }}
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
