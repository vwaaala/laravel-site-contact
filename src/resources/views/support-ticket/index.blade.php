@extends('layouts.app', ['pageName' => config('pages.support_ticket.index')])
@section('content')

    @can('role_create')
        <div class="d-flex mb-2 justify-content-end">
            <a href="{{ route('support_ticket.create') }}" class="btn btn-success">
                <i class="bi bi-plus-circle"></i> {{ __('global.add') }} {{ __('support_ticket.title_singular') }}
            </a>
        </div>
    @endcan
    @can('support_ticket_show')
        <div class="card">
            <div class="card-body">

                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">{{ __('support_ticket.title_singular') }}</th>
                        <th scope="col">{{ __('support_ticket.fields.status') }}</th>
                        <th scope="col" style="width: 250px;">{{ __('global.action') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse ($tickets as $ticket)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $ticket->name }}</td>
                            <td>{!!  $ticket->status == 1 ? '<span class="badge text-success">open</span>' : '<span class="badge text-danger">closed</span>' !!}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('support_ticket.show',$ticket->uuid) }}"
                                       class="btn btn-primary btn-sm"
                                       title="{{ __('global.show') }}">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    {{--                                    @can('support_ticket_edit')--}}
                                    {{--                                        <a href="{{ route('support_ticket.edit',$ticket->uuid) }}"--}}
                                    {{--                                           class="btn btn-warning btn-sm"--}}
                                    {{--                                           title="{{ __('global.edit') }}">--}}
                                    {{--                                            <i class="bi bi-pencil"></i>--}}
                                    {{--                                        </a>--}}
                                    {{--                                    @endcan--}}
                                    {{--                                    @can('support_ticket_delete')--}}
                                    {{--                                        <a href="{{ route('support_ticket.destroy',$ticket->uuid) }}"--}}
                                    {{--                                           class="btn btn-danger btn-sm"--}}
                                    {{--                                           title="{{ __('global.delete') }}">--}}
                                    {{--                                            <i class="bi bi-trash"></i>--}}
                                    {{--                                        </a>--}}
                                    {{--                                    @endcan--}}
                                </div>
                            </td>
                        </tr>
                    @empty
                        <td colspan="3">
                        <span class="text-danger">
                            <strong>{{ __('support_ticket.not_found') }}</strong>
                        </span>
                        </td>
                    @endforelse
                    </tbody>
                </table>

                {{ $tickets->links() }}

            </div>
        </div>
    @endcan
@endsection
