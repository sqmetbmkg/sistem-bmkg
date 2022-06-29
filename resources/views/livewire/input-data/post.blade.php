<div>
    <div class="w-1/2 mx-auto">
        <form wire:submit.prevent="simpan">
            <table class="w-full">
                <colgroup>
                    <col span="1" class="w-3/12">
                    <col span="1" class="w-9/12">
                </colgroup>
                <tbody>
                    <tr>
                        <td>UPT</td>
                        <td class="py-2 px-4">
                            @role('admin')
                            <x-jet-select wire:model="upt" id="upt">
                                <option selected>Pilih UPT...</option>
                                @foreach($stations as $station)
                                <option value="{{ $station->id }}">{{ $station->nama_stasiun }}</option>
                                @endforeach
                            </x-jet-select>
                            @else
                            @php
                            $stasiun = DB::table('stasiun')->where('wmo_id', '=', session('username'))->first();
                            @endphp
                            <p class="font-bold">{{ $stasiun->nama_stasiun }} {{ $upt }}</p>
                            <input type="hidden" value="{{ $stasiun->id }}" wire:model="upt">
                            @endrole
                        </td>
                    </tr>
                    <tr>
                        <td>Tanggal</td>
                        <td class="py-2 px-4">
                            <x-jet-datepicker  class="w-full" wire:model.defer="tanggal" />
                        </td>
                    </tr>
                    <tr>
                        <td>Jam</td>
                        <td class="py-2 px-4">
                            <x-jet-timepicker class="w-full" wire:model.defer="jam" />
                        </td>
                    </tr>
                    <tr>
                        <td>Nilai Suhu</td>
                        <td class="py-2 px-4">
                            <x-jet-input class="w-full" wire:model="suhu" type="number" step=".01" />
                        </td>
                    </tr>
                    <tr>
                        <td>Nilai Kelembapan</td>
                        <td class="py-2 px-4">
                            <x-jet-input class="w-full" wire:model="kelembapan" type="number" step=".01" />
                        </td>
                    </tr>
                    <tr>
                        <td>Nilai Tekanan</td>
                        <td class="py-2 px-4">
                            <x-jet-input class="w-full" wire:model="tekanan" type="number" step=".01" />
                        </td>
                    </tr>
                </tbody>
            </table>
            <x-jet-button type="submit">
                Simpan
            </x-jet-button>
        </form>
    </div>
</div>