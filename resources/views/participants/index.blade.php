@extends('layouts.master')
@section('title', 'المشاركين')

@section('main')
    <div class="container">
        <h1 class="text-center text-decoration-underline">المشاركين</h1>
        <a class="btn-solid-sm" href="{{ route('participants.create') }}"> <i class="fa fa-plus"></i> إضافة مشارك</a>
        <table class="table table-bordered table-hover m-0  mt-3">
            <thead>
                <th>#</th>
                <th>الاسم</th>
                <th>البريد الإلكتروني</th>
                <th>رقم الجوال</th>
                <th>الجنس</th>
                <th>تمت الإضافة بواسطة</th>
                <th></th>
            </thead>
            <tbody>
                @foreach ($participants as $key => $participant)
                    <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ $participant->name }}</td>
                        <td>{{ $participant->email }}</td>
                        <td>{{ $participant->phone }}</td>
                        <td>{{ $participant->gender }}</td>
                        <td>{{ $participant->member->username }}</td>
                        <td class="d-flex align-items-center justify-content-center gap-1">
                            <a href="{{ route('participants.edit', $participant->id) }}" class="btn btn-warning btn-sm">
                                <i class="fa fa-pen"></i>
                            </a>
                            <form action="{{ route('participants.destroy', $participant->id) }}" method="POST">
                                @method('Delete')
                                @csrf
                                <button class="btn btn-danger btn-sm">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                            <a href="{{ route('participants.show', $participant->id) }}" class="btn btn-secondary btn-sm">
                                <i class="fa fa-info-circle"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot></tfoot>
        </table>
    </div>
@endsection