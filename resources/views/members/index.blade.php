@extends('layouts.master')
@section('title', 'الأعضاء')

@section('main')
    <div class="container">
        <h1 class="text-center text-decoration-underline">الأعضاء</h1>
        <a class="btn-solid-sm" href="{{ route('members.create') }}"> <i class="fa fa-plus"></i> إضافة عضو</a>
        <table class="table table-bordered table-hover m-0  mt-3">
            <thead>
                <th>#</th>
                <th>اسم المستخدم</th>
                <th></th>
            </thead>
            <tbody>
                @foreach ($members as $key => $member)
                    <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ $member->username }}</td>
                        <td class="d-flex align-items-center justify-content-center gap-1">
                            <a href="{{ route('members.edit', $member->id) }}" class="btn btn-warning btn-sm">
                                <i class="fa fa-pen"></i>
                            </a>
                            <form action="{{ route('members.destroy', $member->id) }}" method="POST">
                                @method('Delete')
                                <button class="btn btn-danger btn-sm">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                            <a href="{{ route('members.show', $member->id) }}" class="btn btn-secondary btn-sm">
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
