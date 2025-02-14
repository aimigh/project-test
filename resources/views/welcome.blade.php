<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To Do List App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


</head>

<body>
    <div class="container">
        <header>
            <h1 style="text-align: center">To Do List App</h1>
        </header>
        <form method="POST" action="{{ route('todo.store') }}">
            @csrf
            @method('POST')
            <div class="form-group">
                <div class="input-container">
                    <input type="text" id="item" name="item" placeholder="Enter your To do" required>
                    <button type="submit" id="btn" class="btn btn-primary">Add</button>
                </div>
            </div>
        </form>
    </div>

    @if (Session::has('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: "{{ Session::get('success') }}",
                toast: true, // Enable toast style
                position: 'top-end',
                showConfirmButton: false, // Hide the confirm button
                timer: 3000, // Auto-close the toast after 3 seconds (3000 ms)
                timerProgressBar: true,
            });
        </script>
    @elseif (Session::has('warning'))
        <script>
            Swal.fire({
                icon: 'warning',
                title: "{{ Session::get('warning') }}",
                toast: true, // Enable toast style
                position: 'top-end',
                showConfirmButton: false, // Hide the confirm button
                timer: 3000, // Auto-close the toast after 3 seconds (3000 ms)
                timerProgressBar: true,
            });
        </script>
    @elseif (Session::has('delete'))
        <script>
            Swal.fire({
                icon: 'error',
                title: "{{ Session::get('delete') }}",
                toast: true, // Enable toast style
                position: 'top-end',
                showConfirmButton: false, // Hide the confirm button
                timer: 3000, // Auto-close the toast after 3 seconds (3000 ms)
                timerProgressBar: true,
            });
        </script>
    @elseif (Session::has('done'))
        <script>
            Swal.fire({
                icon: 'info',
                title: "{{ Session::get('done') }}",
                toast: true, // Enable toast style
                position: 'top-end',
                showConfirmButton: false, // Hide the confirm button
                timer: 3000, // Auto-close the toast after 3 seconds (3000 ms)
                timerProgressBar: true,
            });
        </script>
    @endif

    <div class="container mt-5">
        <ul class="nav nav-tabs tab-content" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#home" role="tab"
                    aria-controls="home" aria-selected="true">To Do</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="done-tab" data-bs-toggle="tab" href="#done" role="tab"
                    aria-controls="done" aria-selected="false">Done</a>
            </li>
        </ul>

        @php
            $getData = App\Models\Todo::all();
            $existTodo = $getData->where('task', '!=', 'done');
        @endphp

        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <ul class="task-list" id="todo-list">
                    @forelse ($existTodo as $todo)
                        <li class="task-item">
                            <span>{{ $todo->item }}</span>
                            <div class="row">
                                <div class="col-auto">
                                    <form method="" action="{{ route('todo.done', $todo->id) }}">
                                        @csrf
                                        <button type="submit" class="btn btn-success">Done</button>
                                    </form>
                                </div>
                                <div class="col-auto">
                                    <form method="" action="{{ route('todo.delete', $todo->id) }}" id="delete">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger"
                                            onclick="deleteItem()">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </li>
                    @empty
                        <p>No task available.</p>
                    @endforelse
                </ul>
            </div>
            @php
                if ($getData) {
                    $doneTask = $getData->where('task', 'done');
                }
            @endphp
            <div class="tab-pane fade" id="done" role="tabpanel" aria-labelledby="done-tab">
                @forelse ($doneTask as $done)
                    <ul class="task-list task-item" id="done-list">
                        <li style="text-decoration: line-through;">{{ $done->item }}</li>
                        <form method="" action="{{ route('todo.revert', $done->id) }}">
                            @csrf
                            <button type="submit" class="btn-done btn btn-warning">Revert</button>
                        </form>
                    </ul>
                @empty
                    <p>Let's be productive today!</p>
                @endforelse

            </div>
        </div>
    </div>


    <!-- Add Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <script>
        // required validation
        $('#btn').on('click', function() {
            var item = $('#item').val();
            if (item == null || item == "") {
                Swal.fire({
                    title: 'warning!',
                    text: 'Fill in the field',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                });

                return false;
            }
            return true;

        })

        function deleteItem() {
            Swal.fire({
                icon: 'warning',
                title: 'Are you sure?',
                text: 'This action cannot be undone.',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#delete').submit();

                }
            });
        }
    </script>
</body>


<style>
    .form-group {
        margin-bottom: 1rem;
    }

    .input-container {
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .input-container input {
        width: 70%;
        padding: 6px;
        font-size: 16px;
    }

    .input-container button {
        width: 5%;
        /* Much smaller width */
        padding: 4px 8px;
        /* Reduce padding for a much smaller button */
        font-size: 15px;
        /* Smaller text size for the button */
        height: 42px;/
    }

    /* Adjust font size for smaller screens */
    @media (max-width: 768px) {
        .input-container input {
            width: 70%;
        }

        .input-container button {
            width: 30%;
        }
    }

    @media (max-width: 576px) {
        .input-container input {
            width: 60%;
        }

        .input-container button {
            width: 40%;
        }
    }

    /* Center the tabs and make them look good on smaller screens */
    #myTab {
        justify-content: left;
    }

    /* Custom styling for content areas */
    .tab-pane {
        padding: 10px;
    }

    .container {
        margin-top: 20px;
    }

    /* ///////////// */
    /* Tab content */
    .tab-content {
        width: 100%;
        max-width: 1000px;
        margin-left: 0;
        /* Align to the left */
        margin-right: auto;
    }

    /* Task list styling */
    .task-list {
        list-style: none;
        padding: 0;
    }

    .task-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px;
        border-bottom: 1px solid #ccc;
        flex-wrap: wrap;
        /* Allow wrapping for smaller screens */
    }

    .task-item .btn-done {
        /* background-color: #28a745;
      color: white;
      border: none; */
        padding: 5px 10px;
        cursor: pointer;
        transition: background-color 0.3s;
        margin-left: 10px;
    }

    /* Hover effect for button */
    /* .task-item .btn-done:hover {
      background-color: #218838;
  } */

    /* Completed task styling */
    .completed {
        text-decoration: line-through;
        color: #6c757d;
    }

    /* Media Queries for Responsiveness */

    /* Small screens (phones) */
    @media (max-width: 575.98px) {
        .task-item {
            flex-direction: column;
            align-items: flex-start;
            margin-bottom: 10px;
        }

        /* .task-item .btn-done {
        width: 5%;
      /* Much smaller width */
        padding: 4px 8px;
        /* Reduce padding for a much smaller button */
        font-size: 15px;
        /* Smaller text size for the button */
        height: 42px;/
        /* margin-left: 0;
          margin-top: 5px; */
    }

    */ .tab-content {
        width: 100%;
        margin-left: 0;
        /* Smaller width on mobile */
    }
    }

    /* Medium screens (tablets) */
    @media (min-width: 576px) and (max-width: 991.98px) {
        .task-item {
            flex-direction: row;
            justify-content: space-between;
        }

        .tab-content {
            width: 100%;
            margin-left: 0;
            /* Adjust width for medium-sized screens */
        }
    }

    /* Large screens (desktop) */
    @media (min-width: 992px) {
        .tab-content {
            width: 100%;
            margin-left: 0;
            /* Full width on large screens */
        }
    }
</style>

</html>
