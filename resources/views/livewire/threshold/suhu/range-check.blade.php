<div>
    <form wire:submit.prevent="simpan">
        <table class="w-full">
            <colgroup>
                <col span="1" class="w-1/3">
                <col span="1" class="w-2/3">
            </colgroup>
            <tbody>
                <tr>
                    <td class="py-2">Batas Atas Suspect Suhu</td>
                    <td class="p-2">
                        <x-jet-input class="w-full" type="number" wire:model="batasAtasSuspect" step=".01" />
                    </td>
                </tr>
                <tr>
                    <td class="py-2">Batas Bawah Suspect Suhu</td>
                    <td class="p-2">
                        <x-jet-input class="w-full" type="number" wire:model="batasBawahSuspect" step=".01" />
                    </td>
                </tr>
            </tbody>
        </table>
        <x-jet-button class="mt-4" type="submit">Simpan</x-jet-button>
    </form>
</div>