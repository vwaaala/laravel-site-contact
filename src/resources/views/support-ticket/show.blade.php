@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <span>{{ __('support-ticket::support_ticket.title_singular') }}</span>
            @can('support_ticket_delete')
                <!-- Conditional link based on whether show_deleted parameter is present in the request -->
                @if($supportTicket->status)

                    <form method="POST" action="{{ route('support_ticket.closeReply', $supportTicket->uuid) }}">
                        @csrf
                        <button class="btn btn-sm btn-secondary" type="submit">
                            <i class="bi bi-check2-circle"></i> {{ __('support_ticket.close') }}</button>
                    </form>
                @else
                    <form method="POST" action="{{ route('support_ticket.reOpenReply', $supportTicket->uuid) }}">
                        @csrf
                        <button class="btn btn-sm btn-secondary" type="submit">
                            <i class="bi bi-arrow-counterclockwise"></i> {{ __('support_ticket.reopen') }}</button>
                    </form>
                @endif
            @endcan
        </div>
        <div class="card-body">
            <div class="mb-3">
                <p>{{ $supportTicket->name }}</p>
            </div>

            <div class="mb-3">
                <p>{{ $supportTicket->email }}</p>
            </div>

            <div class="mb-3">
                <p>{{ $supportTicket->message }}</p>
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
                                <button class="btn btn-outline-secondary" type="submit" id="button-addon2"><i
                                        class="bi bi-send"></i></button>
                            </div>
                        </form>
                    </div>
                @endif
            @endcan
            @can('support_ticket_show')
                @if(!empty($supportTicket->replies) && count($supportTicket->replies) > 1)
                    <!-- List of Replies -->
                    <ul class="list-group">
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
