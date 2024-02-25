@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h2>Visitor Form</h2>
            <form id="visitorForm" method="POST" action="{{ route('support-ticket.store') }}">
                @csrf
                <!-- CSRF token for form submission -->
                <div class="mb-3">
                    <label for="visitor_name"
                           class="form-label">{{ __('support-ticket::site_contact.visitor_name') }}</label>
                    <!-- Input field for visitor's name -->
                    <input type="text"
                           class="form-control @if(isset($errors) && $errors->has('visitor_name')) is-invalid @endif"
                           id="visitor_name" name="visitor_name" value="{{ old('visitor_name') }}" required>
                    <!-- Display validation error message if present -->
                    @if (isset($errors) && $errors->has('visitor_name'))
                        <div class="invalid-feedback">
                            {{ $errors->get('visitor_name')[0] }}
                        </div>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="visitor_email"
                           class="form-label">{{ trans('support-ticket::site_contact.visitor_email') }}</label>
                    <!-- Input field for visitor's email -->
                    <input type="email"
                           class="form-control @if(isset($errors) && $errors->has('visitor_email')) is-invalid @endif"
                           id="visitor_email" name="visitor_email" value="{{ old('visitor_email') }}" required>
                    <!-- Display validation error message if present -->
                    @if (isset($errors) && $errors->has('visitor_email'))
                        <div class="invalid-feedback">
                            {{ $errors->get('visitor_name')[0] }}
                        </div>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="message"
                           class="form-label">{{ trans('support-ticket::site_contact.visitor_message') }}</label>
                    <!-- Textarea field for visitor's message -->
                    <textarea class="form-control @if(isset($errors) && $errors->has('message')) is-invalid @endif"
                              id="message"
                              name="message" rows="4" required>{{ old('message') }}</textarea>
                    <!-- Display validation error message if present -->
                    @if (isset($errors) && $errors->has('message'))
                        <div class="invalid-feedback">
                            {{ $errors->get('visitor_name')[0] }}
                        </div>
                    @endif
                </div>
                <!-- Submit button -->
                <button type="submit"
                        class="btn btn-primary">{{ trans('support-ticket::site_contact.form_submit') }}</button>
            </form>
        </div>
    </div>
@endsection
