@extends('layouts.master')
@section('title', 'التصنيفات')

@section('main')
    <div class="container-fluid w-75 py-5">
        <h1 class="text-center text-decoration-underline">التصنيفات</h1>
        <a class="btn-solid-sm" href="{{ route('categories.create') }}"> <i class="fa fa-plus"></i> إضافة تصنيف</a>
        <table class="table table-bordered table-hover m-0 mt-3 ">
            <thead class="table-secondary ">
                <th>#</th>
                <th>العنوان</th>
                <th>تمت الإضافة بواسطة</th>
                <th></th>
            </thead>
            <tbody class="table-group-divider">
                @foreach ($categories as $key => $category)
                    <tr cat-id="{{ $category->id }}">
                        <td>{{ ++$key }}</td>
                        <td>{{ $category->title }}</td>
                        <td>{{ $category->member->user->name ?? '' }}</td>
                        <td class="d-flex align-items-center justify-content-center gap-1">
                            <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning btn-sm">
                                <i class="fa fa-pen"></i>
                            </a>
                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                data-bs-target="#deleteModal{{ $category->id }}">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot></tfoot>
        </table>
                        <div class="pagination justify-content-center mt-3"
                    style="display: flex; justify-content:space-between;align-items:center">
                    <ul class="pagination justify-content-center">
                        @if ($categories->onFirstPage())
                            <li class="page-item disabled">
                                <span class="page-link">السابق</span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $categories->previousPageUrl() }}" rel="prev">السابق</a>
                            </li>
                        @endif
                        @foreach ($categories->getUrlRange(1, $categories->lastPage()) as $page => $url)
                            <li class="page-item {{ $page == $categories->currentPage() ? 'active' : '' }}">
                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endforeach
                        @if ($categories->hasMorePages())
                            <li class="page-item">
                                <a class="page-link" href="{{ $categories->nextPageUrl() }}" rel="next">التالي</a>
                            </li>
                        @else
                            <li class="page-item disabled">
                                <span class="page-link">التالي</span>
                            </li>
                        @endif
                    </ul>
                </div>

    </div>
    <!-- Button trigger modal -->
    <!-- Modal -->
    @foreach ($categories as $category)
        <div class="modal fade" id="deleteModal{{ $category->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-danger ">
                        <h1 class="modal-title fs-2 text-white text-dicoration-underline" id="exampleModalLabel">حذف</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="deleteForm{{ $category->id }}" name="deleteForm{{ $category->id }}"
                            action="{{ route('categories.destroy', $category->id) }}" method="POST">
                            @method('Delete')
                            @csrf
                            هل أنت متأكد من حذف التصنيف : {{ $category->title }}!
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                        <button type="submit" class="btn btn-danger" form="deleteForm{{ $category->id }}">تأكيد</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endsection
@section('script')

@endsection
