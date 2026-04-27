@props([
    'title'       => 'Are you sure?',
    'actionLabel' => 'Confirm',
    'actionClass' => 'btn-error',
    'method'      => 'DELETE',
])

<dialog x-ref="confirmModal" class="modal">
    <div class="modal-box">
        <div class="flex items-start gap-4">
            <div class="w-10 h-10 rounded-full bg-error/10 flex items-center justify-center shrink-0">
                <x-heroicon-o-exclamation-triangle class="h-5 w-5 text-error" />
            </div>
            <div>
                <h3 class="font-semibold text-base-content text-lg">{{ $title }}</h3>
                <p class="text-sm text-base-content/60 mt-1">{{ $slot }}</p>
            </div>
        </div>

        <div class="modal-action mt-6">
            <form method="dialog">
                <button class="btn btn-ghost btn-sm">Cancel</button>
            </form>
            <form :action="confirmAction" method="POST">
                @csrf
                @method($method)
                <button type="submit" class="btn btn-sm {{ $actionClass }}">{{ $actionLabel }}</button>
            </form>
        </div>
    </div>
    <form method="dialog" class="modal-backdrop">
        <button>close</button>
    </form>
</dialog>
