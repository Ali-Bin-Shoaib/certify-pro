@extends('layouts.master')
@section('title')
    الدورات
@endsection
@section('main')
    <div class="container">

        <h1 class="text-center text-decoration-underline">الدورات</h1>
        <a class="btn-solid-sm" href="{{ route('programs.create') }}"> <i class="fa fa-plus"></i> إضافة دورة</a>
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
                @foreach ($programs as $key => $program)
                    <tr>
                        <td>{{ ++$key }}</td>
                        {{-- <td>{{ $program->participants->count() }}</td> --}}
                        <td>{{ $program->title }}</td>
                        <td>{{ $program->location }}</td>
                        <td>{{ $program->category->title }}</td>
                        <td>{{ $program->member->user->name ?? '' }}</td>
                        <td>{{ date('Y/m/dD - h:i:s') }}</td>
                        <td class="d-flex align-items-center justify-content-center gap-1">
                            <div class=" dropdown btn btn-secondary">
                                <button class="nav-link dropdown-toggle" id="dropdown{{ $program->id }}"
                                    data-bs-toggle="dropdown" aria-expanded="false">إجراء</button>
                                <ul class="dropdown-menu  " aria-labelledby="dropdown{{ $program->id }}">
                                    <li class="dropdown-item-text">
                                        <a href="{{ route('programs.edit', $program->id) }}">
                                            <i class="fa fa-pen"></i> تعديل
                                        </a>
                                    </li>
                                    <li>
                                        <div class="dropdown-divider"></div>
                                    </li>
                                    <li class="dropdown-item-text">
                                        <form method="POST" action="{{ route('programs.destroy', $program->id) }} ">
                                            @csrf
                                            @method('DELETE')
                                            <button class="nav-link">
                                                <i class="fa fa-trash"></i> حذف
                                            </button>
                                        </form>
                                    </li>
                                    <li>
                                        <div class="dropdown-divider"></div>
                                    </li>
                                    <li> <a title="التفاصيل" href="{{ route('programs.show', $program->id) }}"
                                            class="   dropdown-item-text">
                                            <i class="fa fa-info-circle"></i> تفاصيل
                                        </a>
                                    </li>
                                    <li>
                                        <div class="dropdown-divider"></div>
                                    </li>
                                    <li>
                                        <a class="  dropdown-item-text" title="إصدار الشهادات"
                                            href="{{ route('participant-to-program.create') }}"><i class="fa fa-print"></i>
                                            إضافة مشاركين
                                    </li>
                                    {{-- @if ($program->participants->count() != 0) --}}
                                    <li>
                                        <a class="  dropdown-item-text" title="إصدار الشهادات" href=""><i
                                                class="fa fa-print"></i> إصدار الشهادات
                                    </li>
                                    {{-- @endif --}}
                                </ul>
                            </div>

                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot></tfoot>
        </table>
    </div>
@endsection
