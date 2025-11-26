<form action="{{ route('comment.store') }}" method="post">
    @csrf
    <input type="hidden" name="idblog" value="{{ $blog->id }}">
    <div class="upper-space" style="padding-top: 16px;">
        @error('commentator')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <label for="commentator">Commentator:</label>
        <input class="form-control" required id="commentator" minlength="1" maxlength="100" type="text" name="commentator" placeholder="Author of the comment" value="{{ old('commentator') }}">
    </div>
    <div class="upper-space" style="padding-top: 16px;">
        @error('content')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <label for="content">Comment:</label>
        <textarea cols="60" rows="4" class="form-control" minlength="1" required id="text" name="content" placeholder="Comment">{{ old('content') }}</textarea>
    </div>
    <div class="upper-space" style="padding-top: 16px;">
        @error('liked')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <label for="liked">Do you like the new?</label>
        <select name="liked" id="liked" class="form-control">
            <option value=""
                @if(old('liked') == null)
                    selected
                @endif
            >👌</option>
            <option value="0"
                @if('0' === old('liked'))
                    selected
                @endif
            >👎</option>
            <option value="1"
                @if('1' === old('liked'))
                    selected
                @endif
            >👍</option>
        </select>
    </div>
    <div class="upper-space" style="padding-top: 16px;">
        <input class="btn btn-primary" type="submit" value="Create new comment">
    </div>
</form>