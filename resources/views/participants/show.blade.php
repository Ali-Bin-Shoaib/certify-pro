@extends('layouts.master')
@section('title', 'معلومات المشارك')
@section('main')
    <div class="container-fluid w-75 py-5 ">
        <h1 class="text-decoration-underline text-center ">معلومات المشارك</h1>

        <div class="container form-bg row  py-5 shadow-sm overflow-hidden mx-auto">

            <h5 class=" col-md-5">تمت الإضافة بواسطة: </h5>
            <b class="col-md-7 fs-4">{{ $participant->member->user->name ?? '' }}</b>

            <h5 class=" col-md-5">ID: </h5>
            <b class="col-md-7 fs-4">{{ $participant->id }}</b>

            <h5 class=" col-md-5">الاسم: </h5>
            <b class="col-md-7 fs-4">{{ $participant->name }}</b>

            <h5 class=" col-md-5">الجنس: </h5>
            <b class="col-md-7 fs-4">{{ $participant->gender }}</b>

            <h5 class=" col-md-5">البريد الإلكتروني: </h5>
            <b class="col-md-7 fs-4">{{ $participant->email }}</b>

            <h5 class=" col-md-5">رقم الجوال: </h5>
            <b class="col-md-7 fs-4">{{ $participant->phone }}</b>

            <h5 class=" col-md-5">تاريخ الإضافة: </h5>
            <b class="col-md-7 fs-4">{{ date('Y/m/dD - h-i-s a', strtotime($participant->created_at)) }}</b>

            <h5 class=" col-md-5">آخر تعديل: </h5>
            <b class="col-md-7 fs-4">{{ date('Y/m/dD - h-i-s a', strtotime($participant->updated_at)) }}</b>

            <div class="d-flex flex-row align-items-end justify-content-end">
                <a href="{{ route('participants.edit', $participant->id) }}" class="btn btn-warning btn-sm">
                    <i class="fa fa-pen"></i>
                </a>
                <form action="{{ route('participants.destroy', $participant->id) }}" method="POST">
                    @method('DELETE')
                    @csrf
                    <button class="btn btn-sm btn-danger text-white" onclick="return confirm('هل أنت متأكد من الحذف؟')"><i class="fa fa-trash "></i></button>
                </form>
            </div>
        </div>
    </div>
    <div class="container-fluid w-75 py-5 ">
        <h1 class="text-decoration-underline text-center ">الدورات التي حضرها المشارك</h1>

        <table class="table table-bordered table-hover m-0 mt-3 ">
            <thead class="table-secondary ">
                <th>#</th>
                <th>عنوان الدورة</th>
                <th>الموقع</th>
                <th>تاريخ البداية</th>
                <th>تاريخ النهاية</th>
            </thead>
            <tbody class="table-group-divider">
                @foreach ($programs as $program)
                    <tr>
                        <td>{{ $program->id }}</td>
                        <td>{{ $program->title }}</td>
                        <td>{{ $program->location }}</td>

                        <td>{{ date('Y/m/dD - h-i-s a', strtotime($program->created_at)) }}</td>
                        <td>{{ date('Y/m/dD - h-i-s a', strtotime($program->created_at)) }}</td>

                    </tr>
                @endforeach
            </tbody>

        </table>
                    <div class="pagination justify-content-center mt-3"
                style="display: flex; justify-content:space-between;align-items:center">
                <ul class="pagination justify-content-center">
                    @if ($programs->onFirstPage())
                        <li class="page-item disabled">
                            <span class="page-link">السابق</span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $programs->previousPageUrl() }}" rel="prev">السابق</a>
                        </li>
                    @endif
                    @foreach ($programs->getUrlRange(1, $programs->lastPage()) as $page => $url)
                        <li class="page-item {{ $page == $programs->currentPage() ? 'active' : '' }}">
                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endforeach
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
            </div>

    </div>

@endsection
