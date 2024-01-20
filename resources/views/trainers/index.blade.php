@extends('layouts.master')
@section('title', 'المدربين')

@section('main')
    <div class="container-fluid w-75 py-5">
        <h1 class="text-center text-decoration-underline">المدربين</h1>
        <a class="btn-solid-sm" href="{{ route('trainers.create') }}"> <i class="fa fa-plus"></i> إضافة مدرب</a>
        <table class="table table-bordered table-hover m-0 mt-3 ">
            <thead class="table-secondary ">
                <th>#</th>
                <th>اسم العضو</th>
                <th>الجنس</th>
                <th>رقم الجوال</th>
                <th></th>
            </thead>
            <tbody class="table-group-divider">
                @foreach ($trainers as $key => $trainer)
                    <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ $trainer->name }}</td>
                        <td>{{ $trainer->gender }}</td>
                        <td>{{ $trainer->phone }}</td>
                        <td class="d-flex align-items-center justify-content-center gap-1">
                            <a href="{{ route('trainers.edit', $trainer->id) }}" class="btn btn-warning btn-sm">
                                <i class="fa fa-pen"></i>
                            </a>
                            <form action="{{ route('trainers.destroy', $trainer->id) }}" method="POST">
                                @method('Delete')
                                @csrf
                                <button class="btn btn-danger btn-sm">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                            <a href="{{ route('trainers.show', $trainer->id) }}" class="btn btn-secondary btn-sm">
                                <i class="fa fa-info-circle"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot></tfoot>
        </table>
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
