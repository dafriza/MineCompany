@props([
    'id' => 'basicModal',
    'title' => 'basicModal',
    'isFooterUsed' => 'true',
    'footer' => '',
])

<div id="{{ $id }}Modal" class="modal fade" tabindex="-1" role="dialog"
    aria-labelledby="{{ $id }}ModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="{{ $id }}ModalLabel" class="modal-title fs-5">{{ $title }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{ $slot }}
            </div>
            @if ($isFooterUsed !== 'false')
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            @elseif ($isFooterUsed === 'false')
                {{ $footer }}
            @endif
        </div>
    </div>
</div>
