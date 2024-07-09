<!-- Modal -->
<div class="modal fade" id="newTaskModal" tabindex="-1" aria-labelledby="newTaskModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newTaskModalLabel">Add Todo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form action="{{ route('todo.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <x-input-label for="title" :value="__('Enter Title')" />
                        <x-text-input id="title" type="text" name="title" :value="old('title')" placeholder="Enter Title" />
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>
                    <div class="mb-3">
                        <x-input-label for="task" :value="__('Enter Todo Tasks')" />
                        <x-text-input id="task" type="text" name="task[]" :value="old('task')" placeholder="Enter Task" />
                        <x-input-error :messages="$errors->get('task')" class="mt-2" />
                    </div>
                    <div class="mb-3">
                        <div class="d-flex justify-content-end mt-2">
                            <button type="button" class="add-more-btn btn btn-sm btn-outline-dark p-1 fs12">
                                Add More
                                <i class="fa fa-plus-circle fa-fw"></i>
                            </button>
                        </div>
                    </div>
                    <div class="todo-tasks-wrapper"></div>
                    <hr>
                    <div class="d-grid">
                        <x-primary-button>
                            {{ __('Add Todo List') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editTodoList" tabindex="-1" aria-labelledby="editTodoListLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editTodoListLabel">Edit Todo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form id="edit_todo_list" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="mb-3">
                        <x-input-label for="title" :value="__('Enter Title')" />
                        <x-text-input id="title" type="text" name="title" :value="old('title')" placeholder="Enter Title" />
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>
                    <div class="mb-3">
                        <x-input-label for="task" :value="__('Enter Todo Tasks')" />
                        <x-text-input id="task" type="text" name="task[]" :value="old('task')" placeholder="Enter Task" />
                        <x-input-error :messages="$errors->get('task')" class="mt-2" />
                    </div>
                    <div class="mb-3">
                        <div class="d-flex justify-content-end mt-2">
                            <button type="button" class="add-more-btn btn btn-sm btn-outline-dark p-1 fs12">
                                Add More
                                <i class="fa fa-plus-circle fa-fw"></i>
                            </button>
                        </div>
                    </div>
                    <div class="todo-tasks-wrapper"></div>
                    <hr>
                    <div class="d-grid">
                        <x-primary-button>
                            {{ __('Update Todo List') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.27/dist/sweetalert2.all.min.js"></script>

<script>
    $(document).ready(function() {
        $('.add-more-btn').click(function() {
            let newDiv = `
            <div class="mb-3">
                <input type="text" name="task[]" class="form-control" id="title" placeholder="Enter Task">
                <div class="d-flex justify-content-end mt-2">
                    <button type="button" class="add-more-btn btn btn-sm btn-outline-dark p-1 fs12 me-2">
                        Add More
                        <i class="fa fa-plus-circle fa-fw"></i>
                    </button>
                    <button type="button" class="delete-todo-btn btn btn-sm btn-outline-dark p-1 fs12">
                        Delete
                        <i class="fa fa-trash fa-fw"></i>
                    </button>
                </div>
            </div>`;
            $('.todo-tasks-wrapper').append(newDiv);
        });

        $('.todo-tasks-wrapper').on('click', '.add-more-btn', function() {
            let newDiv = `
            <div class="mb-3">
                <input type="text" name="task[]" class="form-control" id="title" placeholder="Enter Task">
                <div class="d-flex justify-content-end mt-2">
                    <button type="button" class="add-more-btn btn btn-sm btn-outline-dark p-1 fs12 me-2">
                        Add More
                        <i class="fa fa-plus-circle fa-fw"></i>
                    </button>
                    <button type="button" class="delete-todo-btn btn btn-sm btn-outline-dark p-1 fs12">
                        Delete
                        <i class="fa fa-trash fa-fw"></i>
                    </button>
                </div>
            </div>`;
            $(this).closest('.mb-3').after(newDiv);
        });

        $('.todo-tasks-wrapper').on('click', '.delete-todo-btn', function() {
            $(this).closest('.mb-3').remove();
        });

    });
</script>
