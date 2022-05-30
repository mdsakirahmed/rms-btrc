@extends('layouts.pdf.app')
@section('content')

    <table style="width: 100%;">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col"> Category </th>
                <th scope="col"> Sub Category </th>
                <th scope="col"> Name </th>
                <th scope="col"> Phone </th>
                <th scope="col"> Email </th>
                <th scope="col"> Website </th>
                <th scope="col"> Address </th>
                <th scope="col"> Note </th>
                <th scope="col"> Contact person name </th>
                <th scope="col"> Contact person designation </th>
                <th scope="col"> Contact person phone </th>
                <th scope="col"> Contact person email </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($collections as $collection)
                <tr @if($loop->odd) style="background: #F7F4F3" @endif>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $collection->category->name ?? '--' }}</td>
                    <td>{{ $collection->sub_category->name ?? '--' }}</td>
                    <td>{{ $collection->name }}</td>
                    <td>{{ $collection->phone }}</td>
                    <td>{{ $collection->email }}</td>
                    <td>{{ $collection->website }}</td>
                    <td>{{ $collection->address }}</td>
                    <td>{{ $collection->note }}</td>
                    <td>{{ $collection->contact_person_name }}</td>
                    <td>{{ $collection->contact_person_designation }}</td>
                    <td>{{ $collection->contact_person_phone }}</td>
                    <td>{{ $collection->contact_person_email }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
