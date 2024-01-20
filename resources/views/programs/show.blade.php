@extends('layouts.master')
@section('title', 'إضافة دورة')
@section('main')
    <div class="container-fluid w-75 py-5">
        <h1 class="text-decoration-underline text-center ">معلومات الدورة</h1>
        <div class="container mx-auto form-bg row  py-5 shadow-sm">

            <h5 class=" col-md-3">تمت الإضافة بواسطة: </h5>
            <b class="col-md-7 fs-4">{{ $program->member->user->name ?? '' }}</b>
            <h5 class=" col-md-3">التصنيف: </h5>
            <b class="col-md-7 fs-4">{{ $program->category->title ?? '' }}</b>

            <h5 class=" col-md-3">العنوان: </h5>
            <b class="col-md-7 fs-4">{{ $program->title }}</b>

            <h5 class=" col-md-3">الموقع: </h5>
            <b class="col-md-7 fs-4">{{ $program->location }}</b>

            <h5 class=" col-md-3">عدد المشاركين: </h5>
            <b class="col-md-7 fs-4">{{ $program->participants->count() }}</b>

            <h5 class=" col-md-3">تاريخ بداية الدورة: </h5>
            <b class="col-md-7 fs-4">{{ date('Y-m-dD', strtotime($program->start_date)) }}</b>

            <h5 class=" col-md-3">تاريخ نهاية الدورة: </h5>
            <b class="col-md-7 fs-4">{{ date('Y-m-dD', strtotime($program->end_date)) }}</b>

            <div class="text-end ">
                <a class="btn btn-sm btn-warning text-white" href="{{ route('programs.edit', $program->id) }}"><i
                        class="fa fa-pen "></i></a>
                <form action="{{ route('programs.destroy', $program->id) }}" method="POST" class="d-inline-block">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger text-white "><i class="fa fa-trash "></i></button>
                </form>

            </div>

        </div>

        <hr class="my-3">

        <div class="d-flex align-items-center justify-content-around mb-5 mt-4">
            <a class="btn-solid-reg" href="{{ route('template.create', ['programId' => $program->id]) }}">
                رفع ملفات الشهادة
            </a>
            <a class="btn-solid-reg " href="{{ route('participants.create', ['programId' => $program->id]) }}">
                إضافة مشارك للدورة</a>
            {{-- <a href="{{route('partici')}}" class="btn-solid-reg ">تحميل بيانات من ملف إكسل</a> --}}
            <a href="{{ route('template.importParticipants.get', $program->id) }}" class="btn-solid-reg ">تحميل بيانات
                المشاركين من ملف
                إكسل</a>

        </div>
        <table class="table table-bordered table-hover m-0 mt-3 shdow-sm">
            <tfoot>
                <h1 class="text-decoration-underline text-center ">معلومات المشاركين في الدورة</h1>
            </tfoot>
            <thead class="table-secondary ">
                <th>#</th>
                <th>الاسم</th>
                <th>البريد الإلكتروني</th>
                <th>الجوال</th>
                <th>الجنس</th>
                <th></th>
            </thead>
            <tbody class="table-group-divider">
                @foreach ($participants as $key=> $participant)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $participant->name }}</td>
                        <td>{{ $participant->email }}</td>
                        <td>{{ $participant->phone }}</td>
                        <td>{{ $participant->gender }}</td>
                        <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    إجراء
                                </button>
                                <ul class="dropdown-menu">
                                    <li> <a class="dropdown-item"
                                            href="{{ route('participants.edit', $participant->id) }}">
                                            <i class="fa fa-pen"></i> تعديل
                                        </a>
                                    </li>
                                    <li>
                                        <form class="dropdown-item" method="POST"
                                            action="{{ route('participants.destroy', $participant->id) }} ">
                                            @csrf
                                            @method('DELETE')
                                            <button class="nav-link" onclick="return confirm('هل أنت متأكد من الحذف؟')">
                                                <i class="fa fa-trash"></i> حذف
                                            </button>
                                        </form>
                                    </li>
                                    <li> <a title="التفاصيل" href="{{ route('participants.show', $participant->id) }}"
                                            class="dropdown-item">
                                            <i class="fa fa-info-circle"></i> تفاصيل
                                        </a>
                                    </li>

                                    {{-- <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li>
                                        <a class="dropdown-item"
                                            href="{{ route('template.create', ['programId' => $id]) }}">قالب
                                            الشهادة</a>
                                    </li> --}}
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li>
                                        <a class=" dropdown-item
             {{ $participants->count() == 0 ? 'disabled' : '' }}"
                                            title="إصدار شهادة" {{-- href="{{ route('certificatePreview', ['programId' => $program->id, 'participantId' => $participant->id]) }}"><i --}}
                                            href="{{ route('certificateGenerate', ['programId' => $program->id, 'participantId' => $participant->id]) }}"><i
                                                class="fa fa-print"></i> إصدار
                                            شهادة</a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="pagination justify-content-center mt-3" style="display: flex; justify-content:space-between;align-items:center">
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
        {{-- <div class="pagination-label float-end">
            Page {{ $participants->currentPage() }} of {{ $participants->lastPage() }}
        </div> --}}

    </div>

@endsection
