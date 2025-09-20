@extends('layouts.master')
@section('title', 'معلومات الدورة')
@section('main')
    <div class="container-fluid py-5">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10 col-xl-8">
                <h1 class="text-decoration-underline text-center mb-4">معلومات الدورة</h1>

                <!-- Program Info Card -->
                <div class="card shadow-sm mb-4">
                    <div class="card-body p-4">
                        <div class="row g-3">
                            <div class="col-12 col-md-6">
                                <div class="d-flex flex-column flex-md-row">
                                    <h5 class="col-md-4 mb-2 mb-md-0 text-muted">تمت الإضافة بواسطة:</h5>
                                    <b class="col-md-8 fs-5 text-break">{{ $program->member->user->name ?? 'غير محدد' }}</b>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="d-flex flex-column flex-md-row">
                                    <h5 class="col-md-4 mb-2 mb-md-0 text-muted">التصنيف:</h5>
                                    <b class="col-md-8 fs-5 text-break">{{ $program->category->title ?? 'بدون تصنيف' }}</b>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="d-flex flex-column flex-md-row">
                                    <h5 class="col-md-4 mb-2 mb-md-0 text-muted">العنوان:</h5>
                                    <b class="col-md-8 fs-5 text-break">{{ $program->title }}</b>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="d-flex flex-column flex-md-row">
                                    <h5 class="col-md-4 mb-2 mb-md-0 text-muted">الموقع:</h5>
                                    <b class="col-md-8 fs-5 text-break">{{ $program->location }}</b>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="d-flex flex-column flex-md-row">
                                    <h5 class="col-md-4 mb-2 mb-md-0 text-muted">عدد المشاركين:</h5>
                                    <b class="col-md-8 fs-5">{{ $program->participants->count() }}</b>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="d-flex flex-column flex-md-row">
                                    <h5 class="col-md-4 mb-2 mb-md-0 text-muted">تاريخ بداية الدورة:</h5>
                                    <b class="col-md-8 fs-5">{{ date('Y-m-d', strtotime($program->start_date)) }}</b>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="d-flex flex-column flex-md-row">
                                    <h5 class="col-md-4 mb-2 mb-md-0 text-muted">تاريخ نهاية الدورة:</h5>
                                    <b class="col-md-8 fs-5">{{ date('Y-m-d', strtotime($program->end_date)) }}</b>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="text-center text-md-end mt-4">
                            <div class="btn-group" role="group">
                                <a class="btn btn-warning" href="{{ route('programs.edit', $program->id) }}">
                                    <i class="fa fa-pen me-1"></i>تعديل
                                </a>
                                <form action="{{ route('programs.destroy', $program->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" type="submit"
                                            onclick="return confirm('هل أنت متأكد من حذف هذه الدورة؟')">
                                        <i class="fa fa-trash me-1"></i>حذف
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons Section -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-light">
                        <h5 class="card-title mb-0 text-center">إجراءات الدورة</h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-12 col-md-6 col-lg-4">
                                <a class="btn btn-primary w-100" href="{{ route('template.create', ['programId' => $program->id]) }}">
                                    <i class="fa fa-upload me-2"></i>رفع ملفات الشهادة
                                </a>
                            </div>
                            <div class="col-12 col-md-6 col-lg-4">
                                <a class="btn btn-success w-100" href="{{ route('participants.create', ['programId' => $program->id]) }}">
                                    <i class="fa fa-user-plus me-2"></i>إضافة مشارك للدورة
                                </a>
                            </div>
                            <div class="col-12 col-md-6 col-lg-4">
                                <a class="btn btn-info w-100" href="{{ route('template.importParticipants.get', $program->id) }}">
                                    <i class="fa fa-file-excel me-2"></i>استيراد من إكسل
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Participants Section -->
                <div class="card shadow-sm">
                    <div class="card-header bg-light">
                        <h5 class="card-title mb-0 text-center">معلومات المشاركين في الدورة</h5>
                    </div>
                    <div class="card-body p-0">
                        <!-- Desktop Table View -->
                        <div class="table-responsive d-none d-lg-block">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th class="border-0 py-3 px-4">#</th>
                                        <th class="border-0 py-3 px-4">الاسم</th>
                                        <th class="border-0 py-3 px-4">البريد الإلكتروني</th>
                                        <th class="border-0 py-3 px-4">الجوال</th>
                                        <th class="border-0 py-3 px-4">الجنس</th>
                                        <th class="border-0 py-3 px-4 text-center">الإجراءات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($participants as $key => $participant)
                                        <tr class="border-bottom">
                                            <td class="py-3 px-4">{{ $key + 1 }}</td>
                                            <td class="py-3 px-4">{{ $participant->name }}</td>
                                            <td class="py-3 px-4">
                                                <a href="mailto:{{ $participant->email }}" class="text-decoration-none text-break"
                                                   style="word-break: break-all; font-size: 0.85rem;">
                                                    {{ $participant->email }}
                                                </a>
                                            </td>
                                            <td class="py-3 px-4">
                                                <a href="tel:{{ $participant->phone }}" class="text-decoration-none">
                                                    {{ $participant->phone }}
                                                </a>
                                            </td>
                                            <td class="py-3 px-4">
                                                <span class="badge bg-{{ $participant->gender == 'ذكر' ? 'primary' : 'success' }}">
                                                    {{ $participant->gender }}
                                                </span>
                                            </td>
                                            <td class="py-3 px-4 text-center">
                                                <div class="btn-group" role="group">
                                                    <button type="button" class="btn btn-secondary dropdown-toggle"
                                                            data-bs-toggle="dropdown" aria-expanded="false">
                                                        إجراء
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                        <li>
                                                            <a class="dropdown-item" href="{{ route('participants.show', $participant->id) }}">
                                                                <i class="fas fa-info-circle me-2"></i>عرض التفاصيل
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href="{{ route('participants.edit', $participant->id) }}">
                                                                <i class="fas fa-edit me-2"></i>تعديل المشارك
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href="{{ route('certificateGenerate', ['programId' => $program->id, 'participantId' => $participant->id]) }}">
                                                                <i class="fas fa-print me-2"></i>إصدار شهادة
                                                            </a>
                                                        </li>
                                                        <li><hr class="dropdown-divider"></li>
                                                        <li>
                                                            <form method="POST" action="{{ route('participants.destroy', $participant->id) }}" class="d-inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button class="dropdown-item text-danger" type="submit"
                                                                        onclick="return confirm('هل أنت متأكد من حذف هذا المشارك؟')">
                                                                    <i class="fas fa-trash me-2"></i>حذف المشارك
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
                        <div class="d-lg-none p-3">
                            @foreach ($participants as $key => $participant)
                                <div class="mobile-card mb-3">
                                    <div class="card-header">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span>مشارك #{{ $key + 1 }}</span>
                                            <span class="badge bg-{{ $participant->gender == 'ذكر' ? 'primary' : 'success' }}">
                                                {{ $participant->gender }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="card-row">
                                            <span class="card-label">الاسم:</span>
                                            <span class="card-value">{{ $participant->name }}</span>
                                        </div>
                                        <div class="card-row">
                                            <span class="card-label">البريد الإلكتروني:</span>
                                            <span class="card-value">
                                                <a href="mailto:{{ $participant->email }}" class="text-decoration-none text-break"
                                                   style="word-break: break-all; font-size: 0.8rem;">
                                                    {{ $participant->email }}
                                                </a>
                                            </span>
                                        </div>
                                        <div class="card-row">
                                            <span class="card-label">رقم الجوال:</span>
                                            <span class="card-value">
                                                <a href="tel:{{ $participant->phone }}" class="text-decoration-none">
                                                    {{ $participant->phone }}
                                                </a>
                                            </span>
                                        </div>
                                        <div class="card-actions d-flex flex-wrap gap-2 justify-content-center">
                                            <a href="{{ route('participants.show', $participant->id) }}"
                                               class="btn btn-info btn-sm flex-fill" style="min-width: 80px;">
                                                <i class="fa fa-eye me-1"></i> عرض
                                            </a>
                                            <a href="{{ route('participants.edit', $participant->id) }}"
                                               class="btn btn-warning btn-sm flex-fill" style="min-width: 80px;">
                                                <i class="fa fa-pen me-1"></i> تعديل
                                            </a>
                                            <a href="{{ route('certificateGenerate', ['programId' => $program->id, 'participantId' => $participant->id]) }}"
                                               class="btn btn-success btn-sm flex-fill" style="min-width: 80px;">
                                                <i class="fa fa-print me-1"></i> شهادة
                                            </a>
                                            <form method="POST" action="{{ route('participants.destroy', $participant->id) }}"
                                                  class="d-inline flex-fill" style="min-width: 80px;">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-sm w-100" type="submit"
                                                    onclick="return confirm('هل أنت متأكد من حذف هذا المشارك؟')">
                                                    <i class="fa fa-trash me-1"></i> حذف
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <!-- Pagination -->
                @if($participants->hasPages())
                    <div class="d-flex justify-content-center mt-4">
                        <nav aria-label="صفحات المشاركين">
                            <ul class="pagination pagination-sm flex-wrap justify-content-center">
                                @if ($participants->onFirstPage())
                                    <li class="page-item disabled">
                                        <span class="page-link">السابق</span>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $participants->previousPageUrl() }}" rel="prev">السابق</a>
                                    </li>
                                @endif

                                @php
                                    $start = max(1, $participants->currentPage() - 2);
                                    $end = min($participants->lastPage(), $participants->currentPage() + 2);
                                @endphp

                                @if($start > 1)
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $participants->url(1) }}">1</a>
                                    </li>
                                    @if($start > 2)
                                        <li class="page-item disabled">
                                            <span class="page-link">...</span>
                                        </li>
                                    @endif
                                @endif

                                @for ($page = $start; $page <= $end; $page++)
                                    <li class="page-item {{ $page == $participants->currentPage() ? 'active' : '' }}">
                                        <a class="page-link" href="{{ $participants->url($page) }}">{{ $page }}</a>
                                    </li>
                                @endfor

                                @if($end < $participants->lastPage())
                                    @if($end < $participants->lastPage() - 1)
                                        <li class="page-item disabled">
                                            <span class="page-link">...</span>
                                        </li>
                                    @endif
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $participants->url($participants->lastPage()) }}">{{ $participants->lastPage() }}</a>
                                    </li>
                                @endif

                                @if ($participants->hasMorePages())
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $participants->nextPageUrl() }}" rel="next">التالي</a>
                                    </li>
                                @else
                                    <li class="page-item disabled">
                                        <span class="page-link">التالي</span>
                                    </li>
                                @endif
                            </ul>
                        </nav>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
