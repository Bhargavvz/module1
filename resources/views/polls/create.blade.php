@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4>Create a New Poll</h4>
            </div>
            <div class="card-body">

                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('polls.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="question" class="form-label">Poll Question</label>
                        <input type="text" class="form-control" id="question" name="question"
                               placeholder="Enter your poll question here..."
                               value="{{ old('question') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="status" name="status" required>
                            <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Options (at least 2 required)</label>

                        <div id="options-container">
                            <div class="input-group mb-2">
                                <input type="text" class="form-control" name="options[]"
                                       placeholder="Option 1" value="{{ old('options.0') }}" required>
                            </div>
                            <div class="input-group mb-2">
                                <input type="text" class="form-control" name="options[]"
                                       placeholder="Option 2" value="{{ old('options.1') }}" required>
                            </div>
                        </div>

                        <button type="button" class="btn btn-sm btn-outline-secondary" id="add-option-btn">
                            + Add Another Option
                        </button>
                    </div>

                    <hr>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('dashboard') }}" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-primary">Create Poll</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    var optionCount = 2;

    $('#add-option-btn').click(function() {
        optionCount++;

        var newOption = '<div class="input-group mb-2">';
        newOption += '<input type="text" class="form-control" name="options[]" placeholder="Option ' + optionCount + '" required>';
        newOption += '<button type="button" class="btn btn-outline-danger remove-option-btn">Remove</button>';
        newOption += '</div>';

        $('#options-container').append(newOption);
    });

    $(document).on('click', '.remove-option-btn', function() {
        if ($('#options-container .input-group').length > 2) {
            $(this).closest('.input-group').remove();
            optionCount--;
        } else {
            alert('You need at least 2 options!');
        }
    });
</script>
@endsection
