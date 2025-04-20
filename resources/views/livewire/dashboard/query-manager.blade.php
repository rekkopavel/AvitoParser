<div class="p-4 w-full bg-gray-800 text-white">
    <h1 class="text-xl font-bold">Управление Запросами</h1>

    <button wire:click="create"
            class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition duration-300">
        Создать новый запрос
    </button>

    @if ($editing || $creating)
        <form wire:submit.prevent="{{ $creating ? 'store' : 'update' }}"
              class="space-y-4 bg-gray-700 p-4 rounded mt-4 shadow-lg">
            <div>
                <label>Title</label>
                <input type="text" wire:model="title"
                       class="w-full rounded border p-2 mt-1 text-sm shadow-md bg-gray-600 text-white placeholder-gray-300">
                @error('title') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label>URI</label>
                <input type="text" wire:model="uri"
                       class="w-full rounded border p-2 mt-1 text-sm shadow-md bg-gray-600 text-white placeholder-gray-300">
                @error('uri') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label>City</label>
                <input type="text" wire:model="city"
                       class="w-full rounded border p-2 mt-1 text-sm shadow-md bg-gray-600 text-white placeholder-gray-300">
            </div>

            <div>
                <label>Status</label>
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
            <th class="px-4 py-2 text-left">Title</th>
            <th class="px-4 py-2 text-left">URI</th>
            <th class="px-4 py-2 text-left">City</th>
            <th class="px-4 py-2 text-left">Status</th>
            <th class="px-4 py-2 text-left">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($queries as $query)
            <tr class="border-t hover:bg-gray-600">
                <td class="px-4 py-2">{{ $query->id }}</td>
                <td class="px-4 py-2">{{ $query->title }}</td>
                <td class="px-4 py-2">{{ $query->uri }}</td>
                <td class="px-4 py-2">{{ $query->city }}</td>
                <td class="px-4 py-2">{{ $query->active ? 'Активен' : 'Не активен' }}</td>
                <td class="px-4 py-2">
                    <div class="flex space-x-2">
                        <button wire:click="edit({{ $query->id }})"
                                class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition duration-300">
                            Редактировать
                        </button>
                        <button wire:click="delete({{ $query->id }})"
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
