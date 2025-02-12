@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <i class="fas fa-inbox me-2"></i> {{ __('Inbox') }}
                </div>

                <div class="card-body">
                    <!-- Message Table: Displays the list of messages in the inbox -->
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>From</th>
                                    <th>Subject</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($messages as $message)
                                    <tr>
                                        <td>{{ $message->from }}</td>
                                        <td>{{ $message->subject }}</td>
                                        <td>{{ $message->date->format('d/m/Y H:i') }}</td>
                                        <td>
                                            <!-- View Message Button: Allows the user to view the details of the message -->
                                            <a href="{{ route('messages.show', $message->id) }}" class="btn btn-sm btn-primary">
                                                <i class="fas fa-eye me-1"></i> View
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
