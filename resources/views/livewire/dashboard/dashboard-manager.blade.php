<div>
    <!-- Кнопки -->

        <button wire:click="switchModule('query-manager')"
                class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition-colors">
            Query Manager
        </button>
        <button wire:click="switchModule('subscriber-manager')"
                class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition-colors">
            Subscriber Manager
        </button>


    @if($currentModule == 'query-manager')
        <div class="w-full  mx-auto mt-4 ">
            <livewire:dashboard.query-manager />
        </div>
    @elseif($currentModule == 'subscriber-manager')
        <div class="w-full mt-4">
            <livewire:dashboard.subscriber-manager />
        </div>
    @endif
</div>
