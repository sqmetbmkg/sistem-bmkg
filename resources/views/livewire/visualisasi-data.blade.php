<div class="bg-white w-full rounded-b-md p-4" x-data="{ chartSuhu: true, chartKelembapan: false, chartTekanan: false, chart: false, isEmpty: @entangle('isEmpty') }">
    <x-jet-dialog-modal id="test" wire:model="isShow">
        <x-slot name="title">
            {{$namaUPT}}
        </x-slot>
        <x-slot name="content">
            <div class="mx-auto mb-4 flex">
                <x-jet-datepicker id="waktu" class="w-full mr-2" wire:model="date" placeholder="Pilih Tanggal..." />
                <x-jet-button id="lihat" type="button" @click="chart = true">Lihat</x-jet-button>
            </div>
            <div class="flex space-x-2">
                <x-jet-button class="bg-green-500" @click="chartSuhu = true; chartKelembapan = false; chartTekanan = false;">Suhu</x-jet-button>
                <x-jet-button class="bg-blue-600" @click="chartSuhu = false; chartKelembapan = true; chartTekanan = false;">Kelembaban</x-jet-button>
                <x-jet-button class="bg-red-500" @click="chartSuhu = false; chartKelembapan = false; chartTekanan = true;">Tekanan</x-jet-button>
            </div>
            <div class="w-full p-2" x-show="chart">
                <h2 x-show="isEmpty" class="text-center my-4 p-4">Data pada tanggal tersebut masih kosong!</h2>
                <div x-show="!isEmpty">
                    <canvas x-show="chartSuhu" id="suhu-chart"></canvas>
                    <canvas x-show="chartKelembapan" id="kelembapan-chart"></canvas>
                    <canvas x-show="chartTekanan" id="tekanan-chart"></canvas>
                </div>
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-jet-button wire:click="$toggle('isShow')">
                Tutup
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>

    <script src="{{ mix('js/chart/init.js') }}"></script>
</div>