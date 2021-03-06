@extends('admin.layouts.layout')

@section('content')
    <section class="content-header">

        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Статьи</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Blank Page</li>
                    </ol>
                </div>
            </div>
        </div>

    </section>

    <section class="content">

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Список статей</h3>
            </div>
            <div class="card-body">
                <a href="{{ route('admin.posts.create') }}" class="btn btn-primary mb-3">Добавить статью</a>

                @if (count($posts))
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th style="width: 30px">#</th>
                                <th>Наименование</th>
                                <th>Категория</th>
                                <th>Теги</th>
                                <th>Дата</th>
                                <th style="width: 100px">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($posts as $post)
                                <tr>
                                    <td>{{ $post->id }}</td>
                                    <td>{{ $post->desc }}</td>
                                    <td>{{ $post->category->title }}</td>
                                    <td>{{ $post->tags->pluck('title')->join(', ') }}</td>
                                    <td>{{ $post->created_at }}</td>
                                    <td>
                                        <a href="{{ route('admin.posts.edit', ['post' => $post]) }}"
                                           class="btn btn-info btn-sm float-left mr-1">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>

                                        @can('delete', $post)
                                            <form action="{{ route('admin.posts.destroy', ['post' => $post]) }}"
                                                  method="post" class="float-left">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Подтвердите удаление')">
                                                    <i
                                                        class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p>Статей пока нет...</p>
                @endif
            </div>

            <div class="card-footer clearfix">
                {{ $posts->links() }}
            </div>
        </div>

    </section>
@endsection
