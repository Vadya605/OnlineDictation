<div class="table-records">
    <div class="table-responsive mt-4">
        <table class="table">
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
                            <span>Имя</span>
                            <div class="d-flex gap-1">
                                <x-arrows.arrow-up sortValue="Name asc" />
                                <x-arrows.arrow-down sortValue="Name desc" />
                            </div>
                        </div>
                    </th>
                    <th scope="col">
                        <div class="d-flex align-items-center gap-1">
                            <span>Email</span>
                            <div class="d-flex gap-1">
                                <x-arrows.arrow-up sortValue="Email asc" />
                                <x-arrows.arrow-down sortValue="Email desc" />
                            </div>
                        </div>
                    </th>
                    <th scope="col">
                        <div class="d-flex align-items-center gap-1">
                            <span>Роль</span>
                            <div class="d-flex gap-1">
                                <x-arrows.arrow-up sortValue="Role asc" />
                                <x-arrows.arrow-down sortValue="Role desc" />
                            </div>
                        </div>
                    </th>
                    <th scope="col">
                        <div class="d-flex align-items-center gap-1">
                            <span>Дата регистрации</span>
                            <div class="d-flex gap-1">
                                <x-arrows.arrow-up sortValue="Registration asc" />
                                <x-arrows.arrow-down sortValue="Registration desc" />
                            </div>
                        </div>
                    </th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td class="align-middle">{{ $user->id }}</td>
                        <td class="align-middle">{{ $user->name }}</td>
                        <td class="align-middle">{{ $user->email }}</td>
                        <td class="align-middle">{{ $user->role }}</td>
                        <td class="align-middle">{{ $user->created_at }}</td>
                        <td class="align-middle">
                            <div class="d-flex gap-1 justify-content-center align-items-center">
                                <x-buttons.edit-button :record="$user->slug" />
                                <x-buttons.delete-button :record="$user->slug" />
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-center">
        {{ $users->links() }}
    </div>
</div>
