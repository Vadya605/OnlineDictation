<div class="table-responsive mt-4">
    <table class="table table-responsive-sm">
        <thead>
            <tr>
                <th scope="col">
                    <div class="d-flex align-items-center gap-1">
                        <span>Id</span>
                        <div class="d-flex gap-1">
                            <x-arrows.arrow-up sortValue="Id ув" />
                            <x-arrows.arrow-down sortValue="Id уб" />
                        </div>
                    </div>
                </th>
                <th scope="col">
                    <div class="d-flex align-items-center gap-1">
                        <span>Пользователь</span>
                        <div class="d-flex gap-1">
                            <x-arrows.arrow-up sortValue="Пользователь ув" />
                            <x-arrows.arrow-down sortValue="Пользователь уб" />
                        </div>
                    </div>
                </th>
                <th scope="col">
                    <div class="d-flex align-items-center gap-1">
                        <span>Диктант</span>
                        <div class="d-flex gap-1">
                            <x-arrows.arrow-up sortValue="Диктант ув" />
                            <x-arrows.arrow-down sortValue="Диктант уб" />
                        </div>
                    </div>
                </th>
                <th scope="col">
                    <div class="d-flex align-items-center gap-1">
                        <span>Email пользователя</span>
                        <div class="d-flex gap-1">
                            <x-arrows.arrow-up sortValue="Email пользователя ув" />
                            <x-arrows.arrow-down sortValue="Email пользователя уб" />
                        </div>
                    </div>
                </th>
                <th scope="col">
                    <div class="d-flex align-items-center gap-1">
                        <span>Текст диктанта</span>
                        <div class="d-flex gap-1">
                            <x-arrows.arrow-up sortValue="Текст диктанта ув" />
                            <x-arrows.arrow-down sortValue="Текст диктанта уб" />
                        </div>
                    </div>
                </th>
                <th scope="col">
                    <div class="d-flex align-items-center gap-1">
                        <span>Дата и время написания</span>
                        <div class="d-flex gap-1">
                            <x-arrows.arrow-up sortValue="Дата и время написания ув" />
                            <x-arrows.arrow-down sortValue="Дата и время написания уб" />
                        </div>
                    </div>
                </th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dictationResults as $dictationResult)
                <tr>
                    <td class="align-middle">{{ $dictationResult->id }}</td>
                    <td class="align-middle"><a href="{{ route('admin.user.edit', $dictationResult->user) }}">{{ $dictationResult->user->name }}</a></td>
                    <td class="align-middle"><a href="{{ route('admin.dictation.edit', $dictationResult->dictation) }}">{{ $dictationResult->dictation->title }}</a></td>
                    <td class="align-middle">{{ $dictationResult->user->email }}</td>
                    <td class="align-middle">{{ Str::limit($dictationResult->text_result, 30) }}</td>
                    <td class="align-middle">{{ $dictationResult->date_time_result }}</td>
                    <td class="align-middle">
                        <div class="d-flex align-items-center gap-1 w-100">
                            <x-buttons.edit-button :recordId="$dictationResult->id" />
                            <x-buttons.delete-button :recordId="$dictationResult->id" />
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="d-flex justify-content-center">
    {{ $dictationResults->links() }}
</div>