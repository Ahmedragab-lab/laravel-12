@php
    $fileExtension = is_string($file) ? pathinfo($file, PATHINFO_EXTENSION) : $file->getClientOriginalExtension();
@endphp

<div class="d-inline-block me-2 mb-2">
    @if (in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif', 'webp']))
        <div class="position-relative">
            <img width="70" src="{{ is_string($file) ? display_file($file) : $file->temporaryUrl() }}"
                 alt="Uploaded File"
                 class="img-fluid rounded shadow"
                 style="max-width: 200px; height: 70px; object-fit: cover;">
            @if(isset($key))

                <button type="button"
                        class="btn btn-sm btn-danger position-absolute"
                        style="top: 5px; right: 5px;"
                        wire:click="removeAttachment({{$key}})">
                    <i class="fa fa-trash"></i>
                </button>
            @endif
        </div>
    @elseif ($fileExtension === 'pdf')
        <div class="d-flex align-items-center">
            <a href="{{ is_string($file) ? display_file($file) : '#' }}"
               target="_blank"
               class="btn btn-primary">
                عرض الملف
            </a>
            @if(isset($key))
                <button type="button"
                        class="btn btn-sm btn-danger ms-2"
                        style="top: 5px; right: 5px;"
                        wire:click="removeAttachment({{$key}})">
                    <i class="fa fa-trash"></i>
                </button>
            @endif

        </div>
    @endif
</div>

