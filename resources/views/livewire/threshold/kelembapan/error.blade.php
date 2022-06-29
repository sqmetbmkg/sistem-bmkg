<div>
    <form wire:submit.prevent="simpan">
        <table class="w-full">
            <colgroup>
                <col span="1" class="w-1/2">
                <col span="1" class="w-1/2">
            </colgroup>
            <thead>
                <tr>
                    <th class="text-left p-2">Batas Bawah</th>
                    <th class="text-left p-2">Batas Atas</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="p-2">
                        <x-jet-input class="w-full" type="number" wire:model="batasBawahError" step=".01" />
                    </td>
                    <td class="p-2">
                        <x-jet-input class="w-full" type="number" wire:model="batasAtasError" step=".01" />
                    </td>
                </tr>
            </tbody>
        </table>
        <x-jet-button class="mt-4" type="submit">Simpan</x-jet-button>
    </form>
</div>