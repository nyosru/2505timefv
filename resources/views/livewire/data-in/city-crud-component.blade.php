<div class="container mx-auto">


    <div class="mb-5">
        <livewire:Cms2.App.Breadcrumb
                :menu="[
                            [ 'route'=>'tech.index','name'=>'Техничка' ],
        {{--                                ['route' => 'admin.organization.managment','name'=>'Организации'],--}}
{{--                            [ 'route' => 'admin.events','name'=>'Мероприятия' ]--}}
                            [ 'route' => 'admin.cities','name'=>'Города' ]
{{--                            ,--}}
{{--                            [ 'route' => 'admin.news.create','name'=> ( ( $editMode ? 'Редактирование' : 'Создание' ) . ' новости' ), 'link'=>'no' ]--}}
{{--                            ,--}}
{{--                            [ 'route' => 'admin.events.form', 'name'=> ( $id ? 'Редактирование мероприятия' : 'Добавление нового мероприятия' ), 'link'=>'no' ]--}}
{{--                        [ 'link'=>'no', 'name'=>'Счета']--}}
                ]"/>

    </div>

    <h2 class="text-2xl font-bold mb-4">Управление городами</h2>

    @if (session()->has('message'))
        <div class="mb-4 p-3 bg-green-200 text-green-800 rounded">
            {{ session('message') }}
        </div>
    @endif

    <div class="mb-6">
        @if ($updateMode)
            <h3 class="text-xl mb-2">Редактировать город</h3>
        @else
            <h3 class="text-xl mb-2">Добавить новый город</h3>
        @endif

        <form wire:submit.prevent="{{ $updateMode ? 'update' : 'store' }}">
            <div class="mb-3">
                <label class="block font-semibold mb-1">Название города *</label>
                <input type="text" wire:model.defer="name" class="border p-2 rounded w-full" />
                @error('name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-3">
                <label class="block font-semibold mb-1">Страна *</label>
                <select wire:model.defer="country_id" class="border p-2 rounded w-full">
                    <option value="">Выберите страну</option>
                    @foreach($countries as $country)
                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                    @endforeach
                </select>
                @error('country_id') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
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
            <th class="border border-gray-300 p-2 text-left">Название города</th>
            <th class="border border-gray-300 p-2 text-left">Страна</th>
            <th class="border border-gray-300 p-2 text-center">Действия</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($cities as $city)
            <tr>
                <td class="border border-gray-300 p-2">{{ $city->id }}</td>
                <td class="border border-gray-300 p-2">{{ $city->name }}</td>
                <td class="border border-gray-300 p-2">{{ $city->country->name ?? '-' }}</td>
                <td class="border border-gray-300 p-2 text-center space-x-2">
                    <button wire:click="edit({{ $city->id }})" class="text-blue-600 hover:underline">Редактировать</button>
                    <button wire:click="delete({{ $city->id }})"
                            onclick="confirm('Удалить город?') || event.stopImmediatePropagation()"
                            class="text-red-600 hover:underline">Удалить</button>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4" class="p-2 text-center text-gray-500">Города не найдены.</td>
            </tr>
        @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        {{ $cities->links('vendor.pagination.my1tailwind') }}
    </div>
</div>
