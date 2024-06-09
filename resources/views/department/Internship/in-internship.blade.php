@extends('base')

@section('tab-title', 'Student in Internship')
@section('content')

    <main class="container-fluid py-5 px-4 mt-5 col-lg-12 col-xl-9">
        <div class="ps-3 py-4">
            <h1 class="fw-light">Internship Students</h1>
            <p class="lead ps-2"></p>
        </div>



        <section class="container mx-auto px-3">

            <div class="container my-3 mx-3" id="send_button">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#send_emails">
                    Send Emails to Companies Supervisors
                </button>

                <!-- Modal -->
                <div class="modal fade" id="send_emails" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Send Supervisor Emails</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <span class="text-danger">You already send six weekly following form.</span>
                            </div>
                            <div class="modal-footer">
                                <form action="{% url 'send_email' dept.dept_name week %}" method="post">
                                    <input type="submit" value="Send Emails" class="btn btn-primary" disabled>
                                </form>
                            </div>
                            <div class="modal-body">
                                Are you sure to send First weekly following form to companies supervisors ?
                            </div>
                            <div class="modal-footer">
                                <form action="" method="post">
                                    <input type="submit" value="Send Emails" class="btn btn-primary">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>


        <section class="container mx-auto row">
            <form action="{{ route('department.store_in_int') }}" method="post">
                @csrf

                <div class="table-responsive p-3">
                    <table class="table table-hover table-bordered shadow">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th style="min-width: 8rem;">Name</th>
                                <th>Email</th>
                                <th>Supervisor</th>
                                <th>Report</th>
                            </tr>
                        </thead>

                        <tbody class="table-group-divider">
                            @foreach ($students as $student)
                                <tr>
                                    <th>{{ $loop->iteration }}</th>
                                    <td>{{ $student->user->first_name }} {{  $student->user->last_name }}</td>
                                    <td>{{  $student->user->email }}</td>
                                    <td class="bg-secondary-subtle">
                                        <select class="form-select" name="{{ $student->user->university_id }}">
                                            <option selected>
                                                Select Supervisor
                                            </option>
                                            @foreach ($supervisors as $supervisor)
                                                @if ($supervisor->id == $student->supervisor_id)
                                                    <option selected value="{{ $supervisor->user->university_id }}">
                                                        {{ $supervisor->user->first_name }} {{ $supervisor->user->last_name }}
                                                    </option>
                                                @else
                                                    <option value="{{ $supervisor->user->university_id }}">
                                                        {{ $supervisor->user->first_name }} {{ $supervisor->user->last_name }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </td>
                                    <td><a href="{{ route('department.show', $student) }}">view report</a></td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>

                <div class="container mb-3 d-flex flex-row-reverse row">
                    <input type="submit" value="Submit" class="btn btn-primary col-sm-12 col-lg-3">
                </div>
            </form>
        </section>

    </main>


    <script>
        function how_to_send(){
            var checkbox = document.getElementById('auto');
            var form_button = document.getElementById('send_button')
            var label = document.getElementById('label')

            // Check the initial state
            if (checkbox.checked) {
                form_button.style.display = 'none'
                label.style.color = 'black'
            } else {
                form_button.style.display = 'block'
                label.style.color = '#8e8e8e'
            }
        }
    </script>

@endsection
