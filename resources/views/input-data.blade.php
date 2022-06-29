<x-app-layout>
    <div class="p-8">
        <div class="bg-white rounded-lg p-4 px-12">
            <h2 class="text-center text-lg mb-4">Input Data Pengamatan</h2>
            @livewire('input-data.post')
        </div>
    </div>

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