@extends('layouts.master')
@section('title', 'أعضاء المنظمة')

@section('main')
    <div class="container-fluid py-5">
        <div class="row">
            <div class="col-12">
                <h1 class="text-center text-decoration-underline mb-4">أعضاء المنظمة</h1>
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <a class="btn-solid-sm" href="{{ route('members.create') }}">
                        <i class="fa fa-plus"></i> إضافة عضو
                    </a>
                </div>

                <!-- Desktop Table View -->
                <div class="table-responsive-md d-none d-md-block">
                    <table class="table table-bordered table-hover m-0">
                        <thead class="table-secondary">
                            <th>#</th>
                            <th>اسم العضو</th>
                            <th>اسم المستخدم</th>
                            <th>البريد الإلكتروني</th>
                            <th>المسمى الوظيفي</th>
                            <th>الإجراءات</th>
                        </thead>
                        <tbody class="table-group-divider">
                            @foreach ($members as $key => $member)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $member->user->name }}</td>
                                    <td>{{ $member->user->username }}</td>
                                    <td>{{ $member->user->email }}</td>
                                    <td>{{ $member->job_title }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('members.edit', $member->id) }}" class="btn btn-warning btn-sm">
                                                <i class="fa fa-pen"></i> تعديل
                                            </a>
                                            <a href="{{ route('members.show', $member->id) }}" class="btn btn-info btn-sm">
                                                <i class="fa fa-info-circle"></i> تفاصيل
                                            </a>
                                            <form action="{{ route('members.destroy', $member->id) }}" method="POST" class="d-inline">
                                                @method('DELETE')
                                                @csrf
                                                <button class="btn btn-danger btn-sm" type="submit"
                                                    onclick="return confirm('هل أنت متأكد من الحذف؟')">
                                                    <i class="fa fa-trash"></i> حذف
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Mobile Card View -->
                <div class="d-md-none">
                    @foreach ($members as $key => $member)
                        <div class="mobile-card">
                            <div class="card-header">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span>عضو #{{ ++$key }}</span>
                                    <span class="badge bg-info">{{ $member->job_title }}</span>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="card-row">
                                    <span class="card-label">اسم العضو:</span>
                                    <span class="card-value">{{ $member->user->name }}</span>
                                </div>
                                <div class="card-row">
                                    <span class="card-label">اسم المستخدم:</span>
                                    <span class="card-value">{{ $member->user->username }}</span>
                                </div>
                                <div class="card-row">
                                    <span class="card-label">البريد الإلكتروني:</span>
                                    <span class="card-value">
                                        <a href="mailto:{{ $member->user->email }}" class="text-decoration-none">
                                            {{ $member->user->email }}
                                        </a>
                                    </span>
                                </div>
                                <div class="card-row">
                                    <span class="card-label">المسمى الوظيفي:</span>
                                    <span class="card-value">{{ $member->job_title }}</span>
                                </div>
                                <div class="card-actions">
                                    <a href="{{ route('members.edit', $member->id) }}" class="btn btn-warning btn-sm">
                                        <i class="fa fa-pen"></i> تعديل
                                    </a>
                                    <a href="{{ route('members.show', $member->id) }}" class="btn btn-info btn-sm">
                                        <i class="fa fa-info-circle"></i> تفاصيل
                                    </a>
                                    <form action="{{ route('members.destroy', $member->id) }}" method="POST" class="d-inline">
                                        @method('DELETE')
                                        @csrf
                                        <button class="btn btn-danger btn-sm" type="submit"
                                            onclick="return confirm('هل أنت متأكد من الحذف؟')">
                                            <i class="fa fa-trash"></i> حذف
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
    </div>
@endsection
