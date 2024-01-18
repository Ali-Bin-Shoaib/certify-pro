@extends('layouts.master')
@section('title', 'أعضاء المنظمة')

@section('main')
    <div class="container-fluid w-75 py-5">
        <h1 class="text-center text-decoration-underline">أعضاء المنظمة</h1>
        <a class="btn-solid-sm" href="{{ route('members.create') }}"> <i class="fa fa-plus"></i> إضافة عضو</a>
        <table class="table table-bordered table-hover m-0 mt-3 ">
            <thead class="table-secondary ">
                <th>#</th>
                <th>اسم العضو</th>
                <th>اسم المستخدم</th>
                <th>البريد الإلكتروني</th>
                <th>المسمى الوظيفي</th>
                <th></th>
            </thead>
            <tbody class="table-group-divider">

                @foreach ($members as $key => $member)
                    <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ $member->user->name }}</td>
                        <td>{{ $member->user->username }}</td>
                        <td>{{ $member->user->email }}</td>
                        <td>{{ $member->job_title }}</td>
                        <td class="d-flex align-items-center justify-content-center gap-1">
                            <a href="{{ route('members.edit', $member->id) }}" class="btn btn-warning btn-sm">
                                <i class="fa fa-pen"></i>
                            </a>
                            <form action="{{ route('members.destroy', $member->id) }}" method="POST">
                                @method('Delete')
                                @csrf
                                <button class="btn btn-danger btn-sm" onclick="return confirm('هل أنت متأكد من الحذف؟')">
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
