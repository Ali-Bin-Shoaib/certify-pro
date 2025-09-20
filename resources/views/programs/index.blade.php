@extends('layouts.master')
@section('title')
    الدورات
@endsection
@section('main')
    <div class="container-fluid py-5">
        <div class="row">
            <div class="col-12">
                <h1 class="text-center text-decoration-underline mb-4">الدورات</h1>
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <a class="btn-solid-sm" href="{{ route('programs.create') }}">
                        <i class="fa fa-plus"></i> إضافة دورة
                    </a>
                </div>

                <!-- Desktop Table View -->
                <div class="table-responsive-md d-none d-md-block">
                    <table class="table table-bordered table-hover m-0">
                        <thead class="table-secondary">
                            <th>#</th>
                            <th>عنوان الدورة</th>
                            <th>الموقع</th>
                            <th>التصنيف</th>
                            <th>أضيفت بواسطة</th>
                            <th>تاريخ الإضافة</th>
                            <th>الإجراءات</th>
                        </thead>
                        <tbody class="table-group-divider">
                            @php $i = 0; @endphp
                            @foreach ($programs as $program)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $program->title }}</td>
                                    <td>{{ $program->location }}</td>
                                    <td>{{ $program->category->title ?? '' }}</td>
                                    <td>{{ $program->member->user->name ?? '' }}</td>
                                    <td>{{ $program->created_at->format('Y-m-d') }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-secondary dropdown-toggle btn-sm"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                إجراء
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="{{ route('programs.edit', $program->id) }}">
                                                    <i class="fa fa-pen"></i> تعديل
                                                </a></li>
                                                <li><a class="dropdown-item" href="{{ route('programs.show', $program->id) }}">
                                                    <i class="fa fa-info-circle"></i> تفاصيل
                                                </a></li>
                                                <li><a class="dropdown-item" href="{{ route('participants.create', ['programId' => $program->id]) }}">
                                                    <i class="fa fa-users"></i> إضافة مشاركين
                                                </a></li>
                                                <li><hr class="dropdown-divider"></li>
                                                <li>
                                                    <form method="POST" action="{{ route('programs.destroy', $program->id) }}" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="dropdown-item text-danger" type="submit"
                                                            onclick="return confirm('هل أنت متأكد من الحذف؟')">
                                                            <i class="fa fa-trash"></i> حذف
                                                        </button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Mobile Card View -->
                <div class="d-md-none">
                    @php $i = 0; @endphp
                    @foreach ($programs as $program)
                        <div class="mobile-card">
                            <div class="card-header">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span>دورة #{{ ++$i }}</span>
                                    <span class="badge bg-primary">{{ $program->category->title ?? 'بدون تصنيف' }}</span>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="card-row">
                                    <span class="card-label">عنوان الدورة:</span>
                                    <span class="card-value">{{ $program->title }}</span>
                                </div>
                                <div class="card-row">
                                    <span class="card-label">الموقع:</span>
                                    <span class="card-value">{{ $program->location }}</span>
                                </div>
                                <div class="card-row">
                                    <span class="card-label">أضيفت بواسطة:</span>
                                    <span class="card-value">{{ $program->member->user->name ?? 'غير محدد' }}</span>
                                </div>
                                <div class="card-row">
                                    <span class="card-label">تاريخ الإضافة:</span>
                                    <span class="card-value">{{ $program->created_at->format('Y-m-d') }}</span>
                                </div>
                                <div class="card-actions">
                                    <a href="{{ route('programs.edit', $program->id) }}" class="btn btn-warning btn-sm">
                                        <i class="fa fa-pen"></i> تعديل
                                    </a>
                                    <a href="{{ route('programs.show', $program->id) }}" class="btn btn-info btn-sm">
                                        <i class="fa fa-info-circle"></i> تفاصيل
                                    </a>
                                    <a href="{{ route('participants.create', ['programId' => $program->id]) }}" class="btn btn-success btn-sm">
                                        <i class="fa fa-users"></i> مشاركين
                                    </a>
                                    <form method="POST" action="{{ route('programs.destroy', $program->id) }}" class="d-inline">
                                        @csrf
                                        @method('DELETE')
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
                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-4">
                    <nav aria-label="صفحات الدورات">
                        <ul class="pagination pagination-sm flex-wrap justify-content-center">
                            @if ($programs->onFirstPage())
                                <li class="page-item disabled">
                                    <span class="page-link">السابق</span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $programs->previousPageUrl() }}" rel="prev">السابق</a>
                                </li>
                            @endif

                            @php
                                $start = max(1, $programs->currentPage() - 2);
                                $end = min($programs->lastPage(), $programs->currentPage() + 2);
                            @endphp

                            @if($start > 1)
                                <li class="page-item">
                                    <a class="page-link" href="{{ $programs->url(1) }}">1</a>
                                </li>
                                @if($start > 2)
                                    <li class="page-item disabled">
                                        <span class="page-link">...</span>
                                    </li>
                                @endif
                            @endif

                            @for ($page = $start; $page <= $end; $page++)
                                <li class="page-item {{ $page == $programs->currentPage() ? 'active' : '' }}">
                                    <a class="page-link" href="{{ $programs->url($page) }}">{{ $page }}</a>
                                </li>
                            @endfor

                            @if($end < $programs->lastPage())
                                @if($end < $programs->lastPage() - 1)
                                    <li class="page-item disabled">
                                        <span class="page-link">...</span>
                                    </li>
                                @endif
                                <li class="page-item">
                                    <a class="page-link" href="{{ $programs->url($programs->lastPage()) }}">{{ $programs->lastPage() }}</a>
                                </li>
                            @endif

                            @if ($programs->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link" href="{{ $programs->nextPageUrl() }}" rel="next">التالي</a>
                                </li>
                            @else
                                <li class="page-item disabled">
                                    <span class="page-link">التالي</span>
                                </li>
                            @endif
                        </ul>
                    </nav>
                </div>

        </div>
    </div>
@endsection
