<div class="p-8">
    <h2 class="text-center text-xl mb-4 font-bold">Batas Suspect</h2>
    <div class="p-4 bg-white rounded-lg">
        <h2 class="text-center text-lg mb-4 font-bold">Nama UPT</h2>
        <x-jet-select wire:change="changeUPT" wire:model="id_stasiun" name="upt" id="upt">
            <option selected>Pilih UPT...</option>
            @foreach($stations as $station)
            <option value="{{ $station->id }}">{{ $station->nama_stasiun }}</option>
            @endforeach
        </x-jet-select>
    </div>
    <div class="grid grid-cols-2 gap-4 mt-4">
        <div class="p-4 bg-white rounded-lg">
            <h2 class="text-center text-lg mb-4 font-bold">Range Check Suhu</h2>
            @livewire("threshold.suhu.range-check", ['id_stasiun' => $id_stasiun])
        </div>
        <div class="p-4 bg-white rounded-lg">
            <h2 class="text-center text-lg mb-4 font-bold">Step Check Suhu</h2>
            @livewire("threshold.suhu.step-check", ['id_stasiun' => $id_stasiun])
        </div>
        <div class="p-4 bg-white rounded-lg">
            <h2 class="text-center text-lg mb-4 font-bold">Range Check Kelembapan</h2>
            @livewire("threshold.kelembapan.range-check", ['id_stasiun' => $id_stasiun])
        </div>
        <div class="p-4 bg-white rounded-lg">
            <h2 class="text-center text-lg mb-4 font-bold">Step Check Kelembapan</h2>
            @livewire("threshold.kelembapan.step-check", ['id_stasiun' => $id_stasiun])
        </div>
        <div class="p-4 bg-white rounded-lg">
            <h2 class="text-center text-lg mb-4 font-bold">Range Check Tekanan</h2>
            @livewire("threshold.tekanan.range-check", ['id_stasiun' => $id_stasiun])
        </div>
        <div class="p-4 bg-white rounded-lg">
            <h2 class="text-center text-lg mb-4 font-bold">Step Check Tekanan</h2>
            @livewire("threshold.tekanan.step-check", ['id_stasiun' => $id_stasiun])
        </div>
    </div>
    <h2 class="text-center text-xl my-4 mt-8 font-bold">Batas Error</h2>
    <div class="grid grid-cols-3 gap-4 mt-4">
        <div class="p-4 bg-white rounded-lg">
            <h2 class="text-center text-lg mb-4 font-bold">Range Check Suhu</h2>
            @livewire("threshold.suhu.error")
        </div>
        <div class="p-4 bg-white rounded-lg">
            <h2 class="text-center text-lg mb-4 font-bold">Range Check Kelembapan</h2>
            @livewire("threshold.kelembapan.error")
        </div>
        <div class="p-4 bg-white rounded-lg">
            <h2 class="text-center text-lg mb-4 font-bold">Range Check Tekanan</h2>
            @livewire("threshold.tekanan.error")
        </div>
    </div>
</div>