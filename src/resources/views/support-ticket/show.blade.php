@extends('layouts.app', ['pageName' => config('pages.support_ticket.show')])
@push('styles')
    <style>
        #ticketReplyForm .form-control {
            border-top-left-radius: 20px;
            border-bottom-left-radius: 20px;
        }

        ul.support-threads {
            border-radius: 20px;
            border: 1px solid #0d6efd2e;
        }
    </style>
@endpush
@section('content')
    @can('support_ticket_delete')
        <div class="d-flex mb-2 justify-content-end">
            <!-- Conditional link based on whether show_deleted parameter is present in the request -->
            @if($supportTicket->status)

                <form method="POST" action="{{ route('support_ticket.closeReply', $supportTicket->uuid) }}">
                    @csrf
                    <button class="btn btn-danger" type="submit">
                        <i class="bi bi-check2-circle"></i> {{ __('support_ticket.close') }}</button>
                </form>
            @else
                <form method="POST" action="{{ route('support_ticket.reOpenReply', $supportTicket->uuid) }}">
                    @csrf
                    <button class="btn btn-success" type="submit">
                        <i class="bi bi-arrow-counterclockwise"></i> {{ __('support_ticket.reopen') }}</button>
                </form>
            @endif
        </div>
    @endcan

    <div class="card">
        <div class="card-body">
            <div class="card mb-3">
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <label for="ticket_name" class="text-muted">{{ __('support_ticket.fields.title') }}:</label>
                        </div>
                        <div class="col-sm-9">
                            <p id="ticket_name" class="mb-0">{{ $supportTicket->name }}</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <label for="ticket_email" class="text-muted">{{ __('support_ticket.fields.email') }}
                                :</label>
                        </div>
                        <div class="col-sm-9">
                            <p id="ticket_email" class="mb-0">{{ $supportTicket->email }}</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <label for="ticket_message" class="text-muted">{{ __('support_ticket.fields.message') }}
                                :</label>
                        </div>
                        <div class="col-sm-9">
                            <p id="ticket_message" class="mb-0">{{ $supportTicket->message }}</p>
                        </div>
                    </div>
                </div>
            </div>


            @can('support_ticket_edit')
                @if($supportTicket->status)
                    <!-- Reply form -->
                    <div class="mb-3">
                        <form id="ticketReplyForm" method="POST"
                              action="{{ route('support_ticket.postReply', $supportTicket->uuid) }}">
                            @csrf()
                            <div class="input-group mb-3">
                                <input type="text" class="form-control"
                                       name="ticket"
                                       value="{{ $supportTicket->uuid }}"
                                       hidden>
                                <input type="text" class="form-control"
                                       name="reply"
                                       placeholder="{{ __('support_ticket.reply_placeholder') }}"
                                       aria-label="Reply"
                                       aria-describedby="button-addon2">
                                <button class="btn btn-primary" type="submit" id="button-addon2"><i
                                        class="bi bi-send"></i></button>
                            </div>
                        </form>
                    </div>
                @endif
            @endcan
            @can('support_ticket_show')
                @if(!empty($supportTicket->replies) && count($supportTicket->replies) > 1)
                    <!-- List of Replies -->
                    <ul class="list-group support-threads">
                        @foreach ($supportTicket->replies as $reply)
                            <li class="list-group-item">
                                <!-- Reply Content -->
                                <p>{{ $reply->reply }}</p>
                                <!-- Avatar, Name, and Timestamp -->
                                <div class="media mt-3 align-items-center">
                                    <!-- Avatar and Name -->
                                    <div class="d-flex align-items-center">
                                        <!-- Avatar -->
                                        <div class="col-auto">
                                            <img
                                                src="{{ $reply->repliedBy ? asset($reply->repliedBy->avatar) : asset(config('panel.avatar')) }}"
                                                class="rounded-circle mr-3" alt="User Avatar" width="50" height="50">
                                        </div>
                                        <!-- User Name -->
                                        <div class="col-auto">
                                            <h5 class="mt-0 mb-0 ms-2"> {{ $reply->repliedBy ? $reply->repliedBy->name : 'Anonymous User' }}</h5>
                                        </div>
                                    </div>
                                    <!-- Timestamp -->
                                    <div class="col text-muted text-end">
                                        <p class="mb-0">{{ $reply->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>

                @endif
            @endcan
        </div>
    </div>
@endsection
@push('script')
    <script>

        // Add event listener for form submission
        document.getElementById('ticketReplyForm').addEventListener('submit', function (event) {
            // Prevent default form submission
            event.preventDefault();

            // Collect form data
            let formData = new FormData(this);

            // Make a POST request using Axios
            axios.post(this.action, formData)
                .then(function (response) {
                    // Handle success response
                    // console.log(response.data);
                    // Optionally, you can redirect the user or show a success message
                })
                .catch(function (error) {
                    // Handle error
                    console.error(error);
                    // Optionally, you can show an error message to the user
                });
        });
    </script>
@endpush
