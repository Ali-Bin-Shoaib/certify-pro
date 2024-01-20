@extends('layouts.master')
@section('title')
    الدورات
@endsection
@section('main')
    <div class="container-fluid w-75 py-5">

        <h1 class="text-center text-decoration-underline">الدورات</h1>
        <a class="btn-solid-sm" href="{{ route('programs.create') }}"> <i class="fa fa-plus"></i> إضافة دورة</a>
        <div class="table-responsive-md">

            <table class="table table-bordered table-hover m-0 mt-3 ">
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
                        @php
                            $i = 0;
                        @endphp
                        @foreach ($programs as $program)
                            <tr>
                                <td>{{ ++$i }}</td>
                                {{-- <td>{{ $program->id }}</td> --}}
                                <td>{{ $program->title }}</td>
                                <td>{{ $program->location }}</td>
                                <td>{{ $program->category->title ?? '' }}</td>
                                <td>{{ $program->member->user->name ?? '' }}</td>
                                <td>{{ $program->created_at }}</td>
                                <td class="d-flex align-items-center justify-content-center gap-1">


                                    <div class="btn-group">
                                        <button type="button" class="btn btn-secondary dropdown-toggle"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            إجراء
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li> <a class="dropdown-item" href="{{ route('programs.edit', $program->id) }}">
                                                    <i class="fa fa-pen"></i> تعديل
                                                </a>
                                            </li>
                                            <li>
                                                <form class="dropdown-item" method="POST"
                                                    action="{{ route('programs.destroy', $program->id) }} ">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="nav-link"
                                                        onclick="return confirm('هل أنت متأكد من الحذف؟')">
                                                        <i class="fa fa-trash"></i> حذف
                                                    </button>
                                                </form>
                                            </li>
                                            <li> <a title="التفاصيل" href="{{ route('programs.show', $program->id) }}"
                                                    class="dropdown-item">
                                                    <i class="fa fa-info-circle"></i> تفاصيل
                                                </a>
                                            </li>


                                            <li>
                                                <hr class="dropdown-divider">
                                            </li>
                                            <li><a class="dropdown-item" title="إضافة مشاركين للدورة"
                                                    href="{{ route('participants.create', ['programId' => $program->id]) }}"><i
                                                        class="fa fa-print"></i>
                                                    إضافة مشاركين
                                                </a></li>

                                        </ul>
                                    </div>



                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot></tfoot>
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
    </div>
@endsection
