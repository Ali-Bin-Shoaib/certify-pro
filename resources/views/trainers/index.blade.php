@extends('layouts.master')
@section('title', 'المدربين')

@section('main')
    <div class="container-fluid py-5">
        <div class="row">
            <div class="col-12">
                <h1 class="text-center text-decoration-underline mb-4">المدربين</h1>
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <a class="btn-solid-sm" href="{{ route('trainers.create') }}">
                        <i class="fa fa-plus"></i> إضافة مدرب
                    </a>
                </div>

                <!-- Desktop Table View -->
                <div class="table-responsive-md d-none d-md-block">
                    <table class="table table-bordered table-hover m-0">
                        <thead class="table-secondary">
                            <th>#</th>
                            <th>اسم المدرب</th>
                            <th>الجنس</th>
                            <th>رقم الجوال</th>
                            <th>الإجراءات</th>
                        </thead>
                        <tbody class="table-group-divider">
                            @foreach ($trainers as $key => $trainer)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $trainer->name }}</td>
                                    <td>{{ $trainer->gender }}</td>
                                    <td>{{ $trainer->phone }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('trainers.edit', $trainer->id) }}" class="btn btn-warning btn-sm">
                                                <i class="fa fa-pen"></i> تعديل
                                            </a>
                                            <a href="{{ route('trainers.show', $trainer->id) }}" class="btn btn-info btn-sm">
                                                <i class="fa fa-info-circle"></i> تفاصيل
                                            </a>
                                            <form action="{{ route('trainers.destroy', $trainer->id) }}" method="POST" class="d-inline">
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
                    @foreach ($trainers as $key => $trainer)
                        <div class="mobile-card">
                            <div class="card-header">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span>مدرب #{{ ++$key }}</span>
                                    <span class="badge bg-{{ $trainer->gender == 'ذكر' ? 'primary' : 'success' }}">
                                        {{ $trainer->gender }}
                                    </span>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="card-row">
                                    <span class="card-label">اسم المدرب:</span>
                                    <span class="card-value">{{ $trainer->name }}</span>
                                </div>
                                <div class="card-row">
                                    <span class="card-label">الجنس:</span>
                                    <span class="card-value">{{ $trainer->gender }}</span>
                                </div>
                                <div class="card-row">
                                    <span class="card-label">رقم الجوال:</span>
                                    <span class="card-value">
                                        <a href="tel:{{ $trainer->phone }}" class="text-decoration-none">
                                            {{ $trainer->phone }}
                                        </a>
                                    </span>
                                </div>
                                <div class="card-actions">
                                    <a href="{{ route('trainers.edit', $trainer->id) }}" class="btn btn-warning btn-sm">
                                        <i class="fa fa-pen"></i> تعديل
                                    </a>
                                    <a href="{{ route('trainers.show', $trainer->id) }}" class="btn btn-info btn-sm">
                                        <i class="fa fa-info-circle"></i> تفاصيل
                                    </a>
                                    <form action="{{ route('trainers.destroy', $trainer->id) }}" method="POST" class="d-inline">
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
        <div class="pagination justify-content-center mt-3"
            style="display: flex; justify-content:space-between;align-items:center">
            <ul class="pagination justify-content-center">
                @if ($trainers->onFirstPage())
                    <li class="page-item disabled">
                        <span class="page-link">السابق</span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $trainers->previousPageUrl() }}" rel="prev">السابق</a>
                    </li>
                @endif
                @foreach ($trainers->getUrlRange(1, $trainers->lastPage()) as $page => $url)
                    <li class="page-item {{ $page == $trainers->currentPage() ? 'active' : '' }}">
                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                    </li>
                @endforeach
                @if ($trainers->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $trainers->nextPageUrl() }}" rel="next">التالي</a>
                    </li>
                @else
                    <li class="page-item disabled">
                        <span class="page-link">التالي</span>
                    </li>
                @endif
            </ul>
        </div>

    </div>
@endsection
