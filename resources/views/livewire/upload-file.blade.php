<div>
    @isset($message)
        <h2 class="Session_Message">{{ $message }}</h2>
    @endisset ()
    <form wire:submit.prevent="submit" class="upload_forms" method="post" enctype="multipart/form-data">
        @csrf
        <input type="file" class="file_input" name="user_file" wire:model="user_file">
        @error('user_file')
            {{ $message }}
        @enderror
        <br>
        {!! NoCaptcha::renderJs() !!}
        {!! NoCaptcha::display() !!}
        <br>
        <button type="submit" class="upload_form_btn">upload</button>
    </form>
</div>
