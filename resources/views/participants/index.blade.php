@extends('layouts.master')
@section('title', 'المشاركين')

@section('main')
    <div class="container-fluid py-5">
        <div class="row">
            <div class="col-12">
                <h1 class="text-center text-decoration-underline mb-4">المشاركين</h1>
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <a class="btn-solid-sm" href="{{ route('participants.create') }}">
                        <i class="fa fa-plus"></i> إضافة مشارك
                    </a>
                </div>

                <!-- Desktop Table View -->
                <div class="table-responsive-md d-none d-md-block">
                    <table class="table table-bordered table-hover m-0">
                        <thead class="table-secondary">
                            <th>#</th>
                            <th>الاسم</th>
                            <th>البريد الإلكتروني</th>
                            <th>رقم الجوال</th>
                            <th>الجنس</th>
                            <th>تمت الإضافة بواسطة</th>
                            <th>الإجراءات</th>
                        </thead>
                        <tbody class="table-group-divider">
                            @foreach ($participants as $key => $participant)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $participant->name }}</td>
                                    <td>{{ $participant->email }}</td>
                                    <td>{{ $participant->phone }}</td>
                                    <td>{{ $participant->gender }}</td>
                                    <td>{{ $participant->member->user->name ?? 'غير محدد' }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('participants.edit', $participant->id) }}" class="btn btn-warning btn-sm">
                                                <i class="fa fa-pen"></i> تعديل
                                            </a>
                                            <a href="{{ route('participants.show', $participant->id) }}" class="btn btn-info btn-sm">
                                                <i class="fa fa-info-circle"></i> تفاصيل
                                            </a>
                                            <form action="{{ route('participants.destroy', $participant->id) }}" method="POST" class="d-inline">
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
                    @foreach ($participants as $key => $participant)
                        <div class="mobile-card">
                            <div class="card-header">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span>مشارك #{{ ++$key }}</span>
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
                                <div class="card-row">
                                    <span class="card-label">تمت الإضافة بواسطة:</span>
                                    <span class="card-value">{{ $participant->member->user->name ?? 'غير محدد' }}</span>
                                </div>
                                <div class="card-actions d-flex flex-wrap gap-2 justify-content-center">
                                    <a href="{{ route('participants.edit', $participant->id) }}"
                                       class="btn btn-warning btn-sm flex-fill" style="min-width: 80px;">
                                        <i class="fa fa-pen me-1"></i> تعديل
                                    </a>
                                    <a href="{{ route('participants.show', $participant->id) }}"
                                       class="btn btn-info btn-sm flex-fill" style="min-width: 80px;">
                                        <i class="fa fa-info-circle me-1"></i> تفاصيل
                                    </a>
                                    <form action="{{ route('participants.destroy', $participant->id) }}" method="POST"
                                          class="d-inline flex-fill" style="min-width: 80px;">
                                        @method('DELETE')
                                        @csrf
                                        <button class="btn btn-danger btn-sm w-100" type="submit"
                                            onclick="return confirm('هل أنت متأكد من الحذف؟')">
                                            <i class="fa fa-trash me-1"></i> حذف
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
                    @if ($participants->onFirstPage())
                        <li class="page-item disabled">
                            <span class="page-link">السابق</span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $participants->previousPageUrl() }}" rel="prev">السابق</a>
                        </li>
                    @endif
                    @foreach ($participants->getUrlRange(1, $participants->lastPage()) as $page => $url)
                        <li class="page-item {{ $page == $participants->currentPage() ? 'active' : '' }}">
                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endforeach
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
            </div>


        </div>
    </div>
@endsection
