<div class="table-responsive mt-4">
    <table class="table table-responsive-sm">
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
                        <span>Пользователь</span>
                        <div class="d-flex gap-1">
                            <x-arrows.arrow-up sortValue="User asc" />
                            <x-arrows.arrow-down sortValue="User desc" />
                        </div>
                    </div>
                </th>
                <th scope="col">
                    <div class="d-flex align-items-center gap-1">
                        <span>Диктант</span>
                        <div class="d-flex gap-1">
                            <x-arrows.arrow-up sortValue="Dictation asc" />
                            <x-arrows.arrow-down sortValue="Dictation desc" />
                        </div>
                    </div>
                </th>
                <th scope="col">
                    <div class="d-flex align-items-center gap-1">
                        <span>Email пользователя</span>
                        <div class="d-flex gap-1">
                            <x-arrows.arrow-up sortValue="Email asc" />
                            <x-arrows.arrow-down sortValue="Email desc" />
                        </div>
                    </div>
                </th>
                <th scope="col">
                    <div class="d-flex align-items-center gap-1">
                        <span>Текст диктанта</span>
                        <div class="d-flex gap-1">
                            <x-arrows.arrow-up sortValue="Text asc" />
                            <x-arrows.arrow-down sortValue="Text desc" />
                        </div>
                    </div>
                </th>
                <th scope="col">
                    <div class="d-flex align-items-center gap-1">
                        <span>Дата и время написания</span>
                        <div class="d-flex gap-1">
                            <x-arrows.arrow-up sortValue="Written asc" />
                            <x-arrows.arrow-down sortValue="Written desc" />
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
                    <td class="align-middle"><a href="#">{{ $dictationResult->user->name }}</a></td>
                    <td class="align-middle"><a href="#">{{ $dictationResult->dictation->title }}</a></td>
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