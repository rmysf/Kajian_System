@props([
    'title' => 'Konfirmasi Hapus',
    'message' => 'Apakah Anda yakin ingin menghapus data ini? Tindakan ini tidak dapat dibatalkan.',
    'closeAction' => 'deleteModalOpen = false',
    'formAction' => 'deleteFormAction'
])

<div x-show="deleteModalOpen" style="display: none;" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div x-show="deleteModalOpen" x-transition.opacity class="fixed inset-0 bg-gray-900/50 backdrop-blur-sm transition-opacity" @click="{{ $closeAction }}"></div>
    
    <div class="flex min-h-screen items-center justify-center p-4 text-center sm:p-0">
        <div x-show="deleteModalOpen" x-transition.scale.origin.center class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all sm:my-8 w-full max-w-md border border-brand-border-card">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-brand-danger-soft sm:mx-0 sm:h-10 sm:w-10">
                        <i data-lucide="alert-triangle" class="h-6 w-6 text-brand-danger"></i>
                    </div>
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <h3 class="text-lg leading-6 font-bold text-brand-ink" id="modal-title">{{ $title }}</h3>
                        <div class="mt-2">
                            <p class="text-sm text-brand-ink-soft">{!! $message !!}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse gap-3">
                <form method="POST" :action="{{ $formAction }}">
                    @csrf
                    @method('DELETE')
                    <x-admin.button variant="danger" type="submit" class="w-full sm:w-auto">
                        Ya, Hapus
                    </x-admin.button>
                </form>
                <x-admin.button variant="secondary" @click="{{ $closeAction }}" class="mt-3 sm:mt-0 w-full sm:w-auto">
                    Batal
                </x-admin.button>
            </div>
        </div>
    </div>
</div>
