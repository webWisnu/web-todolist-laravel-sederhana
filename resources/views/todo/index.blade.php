@extends('dashboard')

@section('content')
    <div class="container mt-4 mb-4">

        <!-- 01. Content-->
        <h1 class="text-center mb-4">To Do List</h1>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="mb-3">
                    <div>

                        <div class="d-flex align-items-center justify-content-start">
                            <button type="button" data-bs-toggle="modal" data-bs-target="#filterModal" class="">
                                <i class="fas fa-filter btn btn-success">
                                    filter
                                </i>
                            </button>
                            <div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="filterModalLabel">Filter Date</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('todo') }}" method="GET">
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text"><i class="bi bi-filter"></i></span>
                                                    <input type="date" name="from_date" id="from_date"
                                                        value="{{ request('from_date') }}" class="form-control">
                                                    <span class="input-group-text">To:</span>
                                                    <input type="date" name="to_date" id="to_date"
                                                        value="{{ request('to_date') }}" class="form-control">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger text-black"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit"
                                                        class="btn btn-secondary
                                                    text-black">Filter</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <form action="{{ route('create.todo') }}" method="POST">


                                @csrf


                                <button type="button" class="btn btn-primary text-black me-3 ms-3" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">

                                    ➕ Add

                                </button>
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Hello
                                                    {{ Auth::user()->username }} 🙌</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                @if ($errors->any())
                                                    <div class="alert alert-danger">
                                                        @foreach ($errors->all() as $error)
                                                            <p>{{ $error }}</p>
                                                        @endforeach
                                                    </div>
                                                @endif

                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" name="name"
                                                        id="todo-input" placeholder="Tambah todo baru" required>
                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger text-black"
                                                    data-bs-dismiss="modal">
                                                    <i class="fa-solid fa-xmark"></i></button>
                                                <button type="submit"
                                                    class="btn btn-secondary
                                                text-black">
                                                    <i class="fa-solid fa-floppy-disk"></i>
                                                    </i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                        </div>
                        </form>


                    </div>

                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <!-- 03. Searching -->
                    <form id="todo-form" action="{{ route('todo') }}" method="get">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="search" value="{{ request('search') }}"
                                placeholder="find by name">
                            <button class="btn btn-secondary text-primary" type="submit">
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
                                    <button class="btn btn-primary btn-sm edit-btn" onclick="toggleEdit(this)">🖋</button>
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
                                            <button class="btn btn-outline-primary"
                                            type="submit">Update</button>
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
                    <div style="visibility: visible;">
                        {{ $todos->links() }}
                    </div>




                </div>
            </div>
        </div>
    </div>
    </div>

    <x-notify::notify />
    @notifyJs
@endsection
