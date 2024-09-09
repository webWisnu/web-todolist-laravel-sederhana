@extends('dashboard')

@section('content')
    <div class="container mt-4 mb-4">
        <!-- 01. Content-->
        <h1 class="text-center mb-4">To Do List</h1>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-body">
                        <!-- 02. Form input data -->

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                @foreach ($errors->all() as $item)
                                    {{ $item }}
                                @endforeach
                            </div>
                        @endif
                        <form id="todo-form" action="{{ route('create.todo') }}" method="post">
                            @csrf
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="name"
                                id="todo-input"
                                 <input type="text" class="form-control" name="user_id" id="todo-input"
                                    placeholder="Tambah Data baru" value="{{ old('name') }}">
                                <button class="btn btn-primary text-black" type="submit">
                                    Simpan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <!-- 03. Searching -->
                        <form id="todo-form" action="" method="get">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="search" value=""
                                    placeholder="masukkan kata kunci">
                                <button class="btn btn-secondary text-warning" type="submit">
                                    Cari
                                </button>
                            </div>
                        </form>

                        <ul class="list-group mb-4" id="todo-list">
                            @foreach ($todos as $item)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span class="task-text">
                                        {!! $item->is_done == '1' ? '<del>' : '' !!}
                                        {{ $item->name }}

                                    </span>


                                    <input type="text" class="form-control edit-input" style="display: none;">
                                    <div class="btn-group">
                                        <form action="{{ route('todo.destroy', $item->id) }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger btn-sm delete-btn"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus item ini?')">✕</button>
                                        </form>
                                        <button class="btn btn-primary btn-sm edit-btn"
                                            onclick="toggleEdit(this)">🖋</button>
                                    </div>


                                </li>
                                <!-- 05. Update Data -->
                                <li class="list-group-item update-item" style="display: none;">
                                    <form action="{{ route('update.todo', $item->id) }}" method="POST">
                                        @csrf
                                        @method('put')
                                        <div>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name="name"
                                                    value="{{ $item->name }}">
                                                <button class="btn btn-outline-primary" type="submit">Update</button>
                                            </div>
                                        </div>
                                        <div class="d-flex">
                                            <div class="radio px-2">
                                                <label>
                                                    <input type="radio" value="1" name="is_done"
                                                        {{ $item->is_done == '1' ? 'checked' : '' }}> Selesai
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" value="0" name="is_done"
                                                        {{ $item->is_done == '0' ? 'checked' : '' }}> Belum
                                                </label>
                                            </div>
                                        </div>
                                    </form>
                                </li>
                            @endforeach

                        </ul>


                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-notify::notify />
    @notifyJs
@endsection
