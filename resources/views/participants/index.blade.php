@extends('layouts.master')
@section('title', 'المشاركين')

@section('main')
    <div class="container-fluid w-75 py-5">
        <h1 class="text-center text-decoration-underline">المشاركين</h1>
        <a class="btn-solid-sm" href="{{ route('participants.create') }}"> <i class="fa fa-plus"></i> إضافة مشارك</a>
        <div class="table-responsive-md">
            <table class="table table-bordered table-hover m-0 mt-3 ">
                <thead class="table-secondary ">
                    <th>#</th>
                    <th>الاسم</th>
                    <th>البريد الإلكتروني</th>
                    <th>رقم الجوال</th>
                    <th>الجنس</th>
                    <th>تمت الإضافة بواسطة</th>
                    <th></th>
                </thead>
                <tbody class="table-group-divider">
                    @foreach ($participants as $key => $participant)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $participant->name }}</td>
                            <td>{{ $participant->email }}</td>
                            <td>{{ $participant->phone }}</td>
                            <td>{{ $participant->gender }}</td>
                            <td>{{ $participant->member->user->name ?? '' }}</td>
                            <td class="d-flex align-items-center justify-content-center gap-1">
                                <a href="{{ route('participants.edit', $participant->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fa fa-pen"></i>
                                </a>
                                <form action="{{ route('participants.destroy', $participant->id) }}" method="POST">
                                    @method('Delete')
                                    @csrf
                                    <button class="btn btn-danger btn-sm"
                                        onclick="return confirm('هل أنت متأكد من الحذف؟')">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                                <a href="{{ route('participants.show', $participant->id) }}"
                                    class="btn btn-secondary btn-sm">
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
