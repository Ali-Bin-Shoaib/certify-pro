@extends('layouts.master')
@section('title')
    الدورات
@endsection
@section('main')
    <div class="container">
        <h1 class="text-center text-decoration-underline">الدورات</h1>
        <a class="btn-solid-sm" href="{{ route('programs.create') }}"> <i class="fa fa-plus"></i> إضافة دورة</a>
        <table class="table table-bordered table-hover m-0 mt-3 ">
            <thead class="table-secondary ">
                <th>#</th>
                <th>عنوان الدورة</th>
                <th>الموقع</th>
                <th>التصنيف</th>
                <th>أضيفت بواسطة</th>
                <th>تاريخ الإضافة</th>
                <th></th>
            </thead>
            <tbody class="table-group-divider">
                @foreach ($programs as $key => $program)
                    <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ $program->title }}</td>
                        <td>{{ $program->location }}</td>
                        <td>{{ $program->category->title }}</td>
                        <td>{{ $program->member->user->name ?? '' }}</td>
                        <td>{{ date('Y/m/dD - h:i:s') }}</td>
                        <td class="d-flex align-items-center justify-content-center gap-1">
                            <a href="{{ route('programs.edit', $program->id) }}" class="btn btn-warning btn-sm text-white">
                                <i class="fa fa-pen"></i>
                            </a>
                            <form method="POST" action="{{ route('programs.destroy', $program->id) }} ">
                                @csrf
                                @method('DELETE')

                                <button class="btn btn-danger btn-sm text-white">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                            <a href="{{ route('programs.show', $program->id) }}"
                                class="btn btn-secondary btn-sm text-white">
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
