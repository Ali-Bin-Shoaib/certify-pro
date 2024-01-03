@extends('layouts.master')
@section('title')
    الدورات
@endsection
@section('main')
    <div class="container">
        <h1 class="text-center text-decoration-underline">الدورات</h1>
        <a class="btn-solid-sm" href="{{ route('programs.create') }}"> <i class="fa fa-plus"></i> إضافة دورة</a>
        <table class="table table-bordered table-hover m-0  mt-3">
            <thead>
                <th>#</th>
                <th>التصنيف</th>
                <th>العنوان</th>
                <th>الموقع</th>
                <th>أضيفت بواسطة</th>
                <th>تاريخ الإضافة</th>
                <th></th>
            </thead>
            <tbody>
                @foreach ($programs as $key => $program)
                    <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ $program->category->title }}</td>
                        <td>{{ $program->title }}</td>
                        <td>{{ $program->location }}</td>
                        <td>{{ $program->member->username }}</td>
                        <td>{{ $program->created_at }}</td>
                        <td class="d-flex align-items-center justify-content-center gap-1">
                            <form action="{{ route('programs.edit', $program->id) }}">
                                <a href="" class="btn btn-warning btn-sm">
                                    <i class="fa fa-pen"></i>
                                </a>
                            </form>
                            <form action="{{ route('programs.destroy', $program->id) }}">
                                <button class="btn btn-danger btn-sm">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                            <a href="{{ route('programs.show', $program->id) }}" class="btn btn-secondary btn-sm">
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
