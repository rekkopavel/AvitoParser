<div>
    <flux:navlist variant="outline">
        <flux:navlist.group class="grid">
            <flux:navlist.item icon="users" wire:click="switchModule('subscriber-manager')">
                {{ __('Subscribers') }}
            </flux:navlist.item>
            <flux:navlist.item icon="cog" wire:click="switchModule('query-manager')">
                {{ __('Dashboard') }}
            </flux:navlist.item>
        </flux:navlist.group>
    </flux:navlist>

    <div class="p-4">
        @if ($module)
            @livewire($module)
        @endif
    </div>
</div>
