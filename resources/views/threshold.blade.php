<x-app-layout>
    @livewire('threshold.threshold')
    @push('scripts')
    <script>
        window.addEventListener('berhasil-menyimpan', e => {
            Swal.fire(
                'Berhasil!',
                'Berhasil menyimpan data!',
                'success'
            )
        });
        window.addEventListener('gagal-menyimpan', e => {
            Swal.fire(
                'Gagal!',
                'Gagal menyimpan data!',
                'error'
            )
        });
    </script>
    @endpush
</x-app-layout>