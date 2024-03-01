@extends('layouts.app')
@section('content')
    <h2>{{ __('support-ticket::support_ticket.form_header') }}</h2>
    <form id="visitorForm" method="POST" action="{{ route('support_ticket.store') }}">
        @csrf
        <!-- CSRF token for form submission -->
        <div class="mb-3">
            <label for="name"
                   class="form-label">{{ __('support-ticket::support_ticket.fields.title') }}</label>
            <!-- Input field for visitor's name -->
            <input type="text"
                   class="form-control @if(isset($errors) && $errors->has('name')) is-invalid @endif"
                   id="name" name="name" value="{{ old('name') }}" required>
            <!-- Display validation error message if present -->
            @if (isset($errors) && $errors->has('name'))
                <div class="invalid-feedback">
                    {{ $errors->get('name')[0] }}
                </div>
            @endif
        </div>
        <div class="mb-3">
            <label for="email"
                   class="form-label">{{ trans('support-ticket::support_ticket.fields.email') }}</label>
            <!-- Input field for visitor's email -->
            <input type="email"
                   class="form-control @if(isset($errors) && $errors->has('email')) is-invalid @endif"
                   id="email" name="email" value="{{ old('email') }}" required>
            <!-- Display validation error message if present -->
            @if (isset($errors) && $errors->has('email'))
                <div class="invalid-feedback">
                    {{ $errors->get('name')[0] }}
                </div>
            @endif
        </div>
        <div class="mb-3">
            <label for="message"
                   class="form-label">{{ trans('support-ticket::support_ticket.fields.message') }}</label>
            <!-- Textarea field for visitor's message -->
            <textarea class="form-control @if(isset($errors) && $errors->has('message')) is-invalid @endif"
                      id="message"
                      name="message" rows="4" required>{{ old('message') }}</textarea>
            <!-- Display validation error message if present -->
            @if (isset($errors) && $errors->has('message'))
                <div class="invalid-feedback">
                    {{ $errors->get('name')[0] }}
                </div>
            @endif
        </div>
        <!-- Submit button -->
        <button type="submit"
                class="btn btn-primary">{{ trans('support-ticket::support_ticket.form_submit') }}</button>
    </form>
@endsection
