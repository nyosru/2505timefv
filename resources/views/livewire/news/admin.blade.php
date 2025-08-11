<div>

    <div class="mb-5">
        <livewire:Cms2.App.Breadcrumb
                :menu="[
                            [ 'route'=>'tech.index','name'=>'Техничка' ],
        {{--                                ['route' => 'admin.organization.managment','name'=>'Организации'],--}}
{{--                            [ 'route' => 'admin.events','name'=>'Мероприятия' ]--}}
                            [ 'route' => 'admin.news','name'=>'Новости' ]
{{--                            ,--}}
{{--                            [ 'route' => 'admin.news.create','name'=>'Добавить' ]--}}
{{--                            ,--}}
{{--                            [ 'route' => 'admin.events.form', 'name'=> ( $id ? 'Редактирование мероприятия' : 'Добавление нового мероприятия' ), 'link'=>'no' ]--}}
{{--                        [ 'link'=>'no', 'name'=>'Счета']--}}
                ]"/>

    </div>


    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Управление новостями</h2>
        {{--        <button wire:click="create" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">--}}
        {{--            + Добавить новость--}}
        {{--        </button>--}}

        {{--        @permission('р.НовостиАдмин / добавить новость')--}}
        @permission('р.НовостиАдмин / добавить новость')
        {{--        <button wire:click="create" class="btn btn-primary">+ Добавить новость</button>--}}
        <a href="{{ route('admin.news.create') }}" class="btn btn-primary">+ Добавить новость</a>
        @endpermission
    </div>

    @permission('р.НовостиАдмин (только свои) / изменить удалить')
    <div class="bg-yellow-200 p-2 rounded">Показаны ваши записи</div>
    @endpermission

    @if (session()->has('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif

    <!-- Search -->
    <div class="mb-4">
        <input
                type="text"
                wire:model.live="search"
                placeholder="Поиск по заголовкам..."
                class="w-full p-2 border rounded"
        >
    </div>

    <!-- Table -->
    <div class="overflow-x-auto rounded-lg border">
        <table class="min-w-full bg-white">
            <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Заголовок</th>
                <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Дата</th>
                <th class="px-6 py-3 text-right text-sm font-medium text-gray-500">Действия</th>
            </tr>
            </thead>
            <tbody>
            @forelse($news as $item)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4">{{ $item->title }}</td>
                    <td class="px-6 py-4">{{ $item->date->format('d.m.Y') }}</td>
                    <td class="px-6 py-4 text-right space-x-2">
                        @permission('р.НовостиАдмин / редактировать, удалить')
                        <a
                                href="{{ route('admin.news.edit', ['news' => $item->id]) }}"
                                class="text-blue-600 hover:text-blue-800"
                                {{--                                wire:click="edit({{ $item->id }})"--}}
                        >
                            ✏️
                        </a>
                        <button
                                class="text-red-600 hover:text-red-800"
                                wire:click="delete({{ $item->id }})"
                                wire:confirm(
                        'Удалить новость?')
                        >
                        🗑️
                        </button>
                        @else

                            @permission('р.НовостиАдмин (только свои) / изменить удалить')

                            <a
                                href="{{ route('admin.news.edit', ['news' => $item->id]) }}"
                                class="text-blue-600 hover:text-blue-800"
                                {{--                                wire:click="edit({{ $item->id }})"--}}
                        >
                            ✏️
                        </a>
                        <button
                                class="text-red-600 hover:text-red-800"
                                wire:click="delete({{ $item->id }})"
                                wire:confirm(
                        'Удалить новость?')
                        >
                        🗑️
                        </button>
                        @endpermission
                        @endpermission
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="px-6 py-4 text-center text-gray-500">Новостей не найдено</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    {{--    <!-- Pagination -->--}}
    <div class="mt-4">
        {{ $news->links() }}
    </div>

</div>