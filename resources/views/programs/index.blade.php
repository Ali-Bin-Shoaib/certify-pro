@extends('layouts.master')
@section('title')
    الدورات
@endsection
@section('main')
    <div class="container">

        <h1 class="text-center text-decoration-underline">الدورات</h1>
        <a class="btn-solid-sm" href="{{ route('programs.create') }}"> <i class="fa fa-plus"></i> إضافة دورة</a>
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
                        {{-- <td>{{ ++$i }}</td> --}}
                        <td>{{ $program->id }}</td>
                        {{-- <td>{{ $program->participants->count() }}</td> --}}
                        <td>{{ $program->title }}</td>
                        <td>{{ $program->location }}</td>
                        <td>{{ $program->category->title??'' }}</td>
                        <td>{{ $program->member->user->name ?? '' }}</td>
                        <td>{{ date('Y/m/dD - h:i:s') }}</td>
                        <td class="d-flex align-items-center justify-content-center gap-1">


                            <!-- Example single danger button -->
                            <div class="btn-group">
                                <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown"
                                    aria-expanded="false">
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
                                            <button class="nav-link">
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
                                    {{-- <li> <a class="dropdown-item {{ $program->participants->count() == 0 ? 'disabled' : '' }}"
                                            title="إصدار الشهادات" href=""><i class="fa fa-print"></i> إصدار
                                            الشهادات</a>
                                    </li> --}}
                                </ul>
                            </div>



                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot></tfoot>
        </table>
    </div>
@endsection
