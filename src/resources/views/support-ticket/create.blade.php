@extends('layouts.app', ['pageName' => config('pages.support_ticket.create')])
@section('content')
    @can('support_ticket_create')
        <div class="card">
            <div class="card-body">
                <form id="visitorForm" method="POST" action="{{ route('support_ticket.store') }}">
                    @csrf
                    <!-- CSRF token for form submission -->
                    <div class="mb-3">
                        <label for="subject"
                               class="form-label">{{ __('support-ticket::support_ticket.fields.subject') }}</label>
                        <!-- Input field for visitor's name -->
                        <input type="text"
                               class="form-control @if(isset($errors) && $errors->has('subject')) is-invalid @endif"
                               id="subject" name="subject" value="{{ old('subject') }}" required>
                        <!-- Display validation error message if present -->
                        @if (isset($errors) && $errors->has('subject'))
                            <div class="invalid-feedback">
                                {{ $errors->get('subject')[0] }}
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
            </div>
        </div>
    @endcan
@endsection
