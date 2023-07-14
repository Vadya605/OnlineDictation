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
                        <span>Имя</span>
                        <div class="d-flex gap-1">
                            <x-arrows.arrow-up sortValue="Имя ув" />
                            <x-arrows.arrow-down sortValue="Имя уб" />
                        </div>
                    </div>
                </th>
                <th scope="col">
                    <div class="d-flex align-items-center gap-1">
                        <span>Email</span>
                        <div class="d-flex gap-1">
                            <x-arrows.arrow-up sortValue="Email ув" />
                            <x-arrows.arrow-down sortValue="Email уб" />
                        </div>
                    </div>
                </th>
                <th scope="col">
                    <div class="d-flex align-items-center gap-1">
                        <span>Роль</span>
                        <div class="d-flex gap-1">
                            <x-arrows.arrow-up sortValue="Роль ув" />
                            <x-arrows.arrow-down sortValue="Роль уб" />
                        </div>
                    </div>
                </th>
                <th scope="col">
                    <div class="d-flex align-items-center gap-1">
                        <span>Дата регистрации</span>
                        <div class="d-flex gap-1">
                            <x-arrows.arrow-up sortValue="Дата регистрации ув" />
                            <x-arrows.arrow-down sortValue="Дата регистрации уб" />
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
                            <x-buttons.edit-button :recordId="$user->id" />
                            <x-buttons.delete-button :recordId="$user->id" />
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