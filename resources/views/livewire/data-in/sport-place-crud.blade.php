<div class="container mx-auto">


    <div class="mb-5">
        <livewire:Cms2.App.Breadcrumb
                :menu="[
                            [ 'route'=>'tech.index','name'=>'Техничка' ],
        {{--                                ['route' => 'admin.organization.managment','name'=>'Организации'],--}}
{{--                            [ 'route' => 'admin.events','name'=>'Мероприятия' ]--}}
                            [ 'route' => 'admin.sport-places','name'=>'Места проведения' ]
{{--                            ,--}}
{{--                            [ 'route' => 'admin.news.create','name'=> ( ( $editMode ? 'Редактирование' : 'Создание' ) . ' новости' ), 'link'=>'no' ]--}}
{{--                            ,--}}
{{--                            [ 'route' => 'admin.events.form', 'name'=> ( $id ? 'Редактирование мероприятия' : 'Добавление нового мероприятия' ), 'link'=>'no' ]--}}
{{--                        [ 'link'=>'no', 'name'=>'Счета']--}}
                ]"/>

    </div>

    <h2 class="text-2xl font-bold mb-4">Управление спортивными местами</h2>

    @if (session()->has('message'))
        <div class="mb-4 p-3 bg-green-200 text-green-800 rounded">
            {{ session('message') }}
        </div>
    @endif

    <div class="mb-6">
        @if ($updateMode)
            <h3 class="text-xl mb-2">Редактировать спортивное место</h3>
        @else
            <h3 class="text-xl mb-2">Добавить новое спортивное место</h3>
        @endif

        <form wire:submit.prevent="{{ $updateMode ? 'update' : 'store' }}">
            <div class="mb-3">
                <label class="block font-semibold mb-1">Название *</label>
                <input type="text" wire:model.defer="name" class="border p-2 rounded w-full" />
                @error('name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-3">
                <label class="block font-semibold mb-1">Город *</label>
                <select wire:model.defer="city_id" class="border p-2 rounded w-full">
                    <option value="">Выберите город</option>
                    @foreach($cities as $city)
                        <option value="{{ $city->id }}">{{ $city->name }} ({{ $city->country->name ?? '-' }})</option>
                    @endforeach
                </select>
                @error('city_id') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-3">
                <label class="block font-semibold mb-1">Адрес (для карты)</label>
                <input type="text" wire:model.defer="adress" class="border p-2 rounded w-full" placeholder="Адрес: улица дом" />
                @error('adress') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-3">
                <label class="block font-semibold mb-1">Фото (локальный путь)</label>
                <input type="text" wire:model.defer="photo" class="border p-2 rounded w-full" placeholder="Путь к фото" />
                @error('photo') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-3">
                <label class="block font-semibold mb-1">Ссылка на фото в S3</label>
                <input type="url" wire:model.defer="photo_s3_url" class="border p-2 rounded w-full" placeholder="https://..." />
                @error('photo_s3_url') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                @if ($updateMode)
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Обновить</button>
                    <button type="button" wire:click="cancel" class="ml-2 px-4 py-2 border rounded hover:bg-gray-100">Отмена</button>
                @else
                    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Создать</button>
                @endif
            </div>
        </form>
    </div>

    <table class="w-full border-collapse border border-gray-300">
        <thead>
        <tr>
            <th class="border border-gray-300 p-2 text-left">ID</th>
            <th class="border border-gray-300 p-2 text-left">Название</th>
            <th class="border border-gray-300 p-2 text-left">Город</th>
            <th class="border border-gray-300 p-2 text-left">Адрес</th>
            <th class="border border-gray-300 p-2 text-left">Фото</th>
            <th class="border border-gray-300 p-2 text-left">Фото S3</th>
            <th class="border border-gray-300 p-2 text-center">Действия</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($sportPlaces as $place)
            <tr>
                <td class="border border-gray-300 p-2">{{ $place->id }}</td>
                <td class="border border-gray-300 p-2">{{ $place->name }}</td>
                <td class="border border-gray-300 p-2">{{ $place->city->name ?? '-' }}</td>
                <td class="border border-gray-300 p-2">{{ $place->adress ?? '-' }}</td>
                <td class="border border-gray-300 p-2">
                    @if($place->photo)
                        {{ $place->photo }}
                    @else
                        -
                    @endif
                </td>
                <td class="border border-gray-300 p-2">
                    @if($place->photo_s3_url)
                        <a href="{{ $place->photo_s3_url }}" target="_blank" class="text-blue-600 hover:underline">Ссылка</a>
                    @else
                        -
                    @endif
                </td>
                <td class="border border-gray-300 p-2 text-center space-x-2">
                    <button wire:click="edit({{ $place->id }})" class="text-blue-600 hover:underline">Редактировать</button>
                    <button wire:click="delete({{ $place->id }})"
                            onclick="confirm('Удалить спортивное место?') || event.stopImmediatePropagation()"
                            class="text-red-600 hover:underline">Удалить</button>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="p-2 text-center text-gray-500">Спортивные места не найдены.</td>
            </tr>
        @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        {{ $sportPlaces->links('vendor.pagination.my1tailwind') }}
    </div>
</div>
