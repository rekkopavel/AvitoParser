<div class="p-4 w-full bg-gray-800 text-white">
    <h1 class="text-xl font-bold">Управление подписчиками</h1>

    <button wire:click="create"
            class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition duration-300">
        Создать нового подписчика
    </button>

    @if ($editing || $creating)
        <form wire:submit.prevent="{{ $creating ? 'store' : 'update' }}"
              class="space-y-4 bg-gray-700 p-4 rounded mt-4 shadow-lg">
            <div>
                <label>Name</label>
                <input type="text" wire:model="name"
                       class="w-full rounded border p-2 mt-1 text-sm shadow-md bg-gray-600 text-white placeholder-gray-300">
                @error('name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label>telegram_id</label>
                <input type="text" wire:model="telegram_id"
                       class="w-full rounded border p-2 mt-1 text-sm shadow-md bg-gray-600 text-white placeholder-gray-300">
                @error('telegram_id') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label>Mail</label>
                <input type="text" wire:model="mail"
                       class="w-full rounded border p-2 mt-1 text-sm shadow-md bg-gray-600 text-white placeholder-gray-300">
            </div>

            <div>
                <label>Статус</label>
                <div class="flex items-center space-x-2">
                    <!-- Используем checkbox для переключения статуса -->
                    <input type="checkbox" wire:model="active" class="h-5 w-5" id="active">
                    <span>{{ $active ? 'Активен' : 'Не активен' }}</span>
                </div>
            </div>

            <button type="submit"
                    class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition duration-300">
                {{ $creating ? 'Создать' : 'Сохранить' }}
            </button>
        </form>
    @endif

    <table class="w-full table-auto mt-4 bg-gray-700 shadow-md rounded-lg overflow-hidden">
        <thead class="bg-blue-500 text-white">
        <tr>
            <th class="px-4 py-2 text-left">ID</th>
            <th class="px-4 py-2 text-left">Name</th>
            <th class="px-4 py-2 text-left">telegram_id</th>
            <th class="px-4 py-2 text-left">mail</th>
            <th class="px-4 py-2 text-left">Status</th>
            <th class="px-4 py-2 text-left">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($subscribers as $subscriber)
            <tr class="border-t hover:bg-gray-600">
                <td class="px-4 py-2">{{ $subscriber->id }}</td>
                <td class="px-4 py-2">{{ $subscriber->name }}</td>
                <td class="px-4 py-2">{{ $subscriber->telegram_id }}</td>
                <td class="px-4 py-2">{{ $subscriber->mail }}</td>
                <td class="px-4 py-2">{{ $subscriber->active ? 'Активен' : 'Не активен' }}</td>
                <td class="px-4 py-2">
                    <div class="flex space-x-2">
                        <button wire:click="edit({{ $subscriber->id }})"
                                class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition duration-300">
                            Редактировать
                        </button>
                        <button wire:click="delete({{ $subscriber->id }})"
                                class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 transition duration-300">
                            Удалить
                        </button>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
