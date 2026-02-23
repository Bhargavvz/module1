@extends('layouts.app')

@section('content')

<div class="row mb-4">
    <div class="col-md-8">
        <h2>Active Polls</h2>
        <p class="text-muted">Click on any poll to see its options</p>
    </div>
    <div class="col-md-4 text-end">
        <a href="{{ route('polls.create') }}" class="btn btn-primary">+ Create New Poll</a>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="row">
    <div class="col-md-6">
        <h5 class="mb-3">Poll List</h5>

        @if($polls->count() > 0)
            @foreach($polls as $poll)
                <div class="card poll-card" onclick="loadPollDetails({{ $poll->id }})">
                    <div class="card-body">
                        <h5 class="card-title">{{ $poll->question }}</h5>
                        <span class="badge bg-success">{{ $poll->status }}</span>
                        <small class="text-muted float-end">
                            Created: {{ $poll->created_at->format('d M Y') }}
                        </small>
                    </div>
                </div>
            @endforeach
        @else
            <div class="alert alert-info">
                No active polls found. <a href="{{ route('polls.create') }}">Create one now!</a>
            </div>
        @endif
    </div>

    <div class="col-md-6">
        <h5 class="mb-3">Poll Details</h5>
        <div id="poll-details">
            <div class="poll-detail-box text-center text-muted">
                <p>Click on a poll to see its details here</p>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    function loadPollDetails(pollId) {
        $('#poll-details').html('<div class="poll-detail-box text-center"><p>Loading...</p></div>');

        $.ajax({
            url: '/polls/' + pollId,
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                var html = '<div class="poll-detail-box">';
                html += '<h4>' + data.question + '</h4>';
                html += '<span class="badge bg-success mb-3">' + data.status + '</span>';
                html += '<h6 class="mt-3">Options:</h6>';

                for (var i = 0; i < data.options.length; i++) {
                    html += '<div class="option-item">';
                    html += '<strong>Option ' + (i + 1) + ':</strong> ' + data.options[i].option_text;
                    html += '</div>';
                }

                html += '</div>';
                $('#poll-details').html(html);
            },
            error: function() {
                $('#poll-details').html('<div class="poll-detail-box text-center text-danger"><p>Error loading poll details. Please try again.</p></div>');
            }
        });
    }
</script>
@endsection
