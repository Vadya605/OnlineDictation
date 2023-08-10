<div class="table-responsive mt-4">
    <table class="table table-responsive-sm" id="tableDictations">
        <thead>
            <tr>
                <th scope="col">
                    <div class="d-flex align-items-center gap-1">
                        <span>Id</span>
                        <div class="d-flex gap-1">
                            <x-arrows.arrow-up sortValue="Id asc" />
                            <x-arrows.arrow-down sortValue="Id desc" />
                        </div>
                    </div>
                </th>
                <th scope="col">
                    <div class="d-flex align-items-center gap-1">
                        <span>Название</span>
                        <div class="d-flex gap-1">
                            <x-arrows.arrow-up sortValue="Title asc" />
                            <x-arrows.arrow-down sortValue="Title desc" />
                        </div>
                    </div>
                </th>
                <th scope="col">
                    <div class="d-flex align-items-center gap-1">
                        <span>Видео</span>
                        <div class="d-flex gap-1">
                            <x-arrows.arrow-up sortValue="Video asc" />
                            <x-arrows.arrow-down sortValue="Video desc" />
                        </div>
                    </div>
                </th>
                <th scope="col">
                    <div class="d-flex align-items-center gap-1">
                        <span>Активен</span>
                        <div class="d-flex gap-1">
                            <x-arrows.arrow-up sortValue="Active asc" />
                            <x-arrows.arrow-down sortValue="Active desc" />
                        </div>
                    </div>
                </th>
                <th scope="col">
                    <div class="d-flex align-items-center gap-1">
                        <span>Описание</span>
                        <div class="d-flex gap-1">
                            <x-arrows.arrow-up sortValue="Description asc" />
                            <x-arrows.arrow-down sortValue="Description desc" />
                        </div>
                    </div>
                </th>
                <th scope="col">
                    <div class="d-flex align-items-center gap-1">
                        <span>Ответ</span>
                        <div class="d-flex gap-1">
                            <x-arrows.arrow-up sortValue="Answer asc" />
                            <x-arrows.arrow-down sortValue="Answer desc" />
                        </div>
                    </div>
                </th>
                <th scope="col">
                    <div class="d-flex align-items-center gap-1">
                        <span>Начало</span>
                        <div class="d-flex gap-1">
                            <x-arrows.arrow-up sortValue="Beginning asc" />
                            <x-arrows.arrow-down sortValue="Beginning desc" />
                        </div>
                    </div>
                </th>
                <th scope="col">
                    <div class="d-flex align-items-center gap-1">
                        <span>Окончание</span>
                        <div class="d-flex gap-1">
                            <x-arrows.arrow-up sortValue="Ending asc" />
                            <x-arrows.arrow-down sortValue="Ending desc" />
                        </div>
                    </div>
                </th>
                <th scope="col" class="text-center">
                    <div class="d-flex align-items-center gap-1">
                        <span>Дата создания</span>
                        <div class="d-flex">
                            <x-arrows.arrow-up sortValue="Creation asc" />
                            <x-arrows.arrow-down sortValue="Creation desc" />
                        </div>
                    </div>
                </th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dictations as $dictation)
                <tr>
                    <td class="align-middle text-center">{{ $dictation->id }}</td>
                    <td class="align-middle">{{ $dictation->title }}</td>
                    <td class="align-middle"><a target="blank" href="{{ $dictation->video_link }}">{{  Str::limit($dictation->video_link, 20) }}</a></td>
                    <td class="align-middle text-center">
                        @if ($dictation->is_active)
                            <span class="badge bg-success text-white">Да</span>
                        @else
                            <span class="badge bg-danger text-white">Нет</span>
                        @endif
                    </td>
                    <td class="align-middle">{{ Str::limit($dictation->description, 20) }}</td>
                    <td class="align-middle">{{ Str::limit($dictation->answer, 20) }}</td>
                    <td class="align-middle">{{ $dictation->from_date_time }}</td>
                    <td class="align-middle">{{ $dictation->to_date_time }}</td>
                    <td class="align-middle">{{ $dictation->created_at }}</td>
                    <td class="align-middle">
                        <div class="d-flex align-items-center justify-content-end gap-1">
                            <x-buttons.edit-button :record="$dictation->slug" /> 
                            <x-buttons.delete-button :record="$dictation->slug" />
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="d-flex justify-content-center">
    {{ $dictations->links() }}
</div>
