<div class="list-users">
    <!-- search area -->
    <div class="filter-panel">
        <div class="grid grid-cols-12">
            <div class="col-span-4 filter-box">
            <label for="search" class="filter">Search</label>
                <input id="search" wire:model.live.delay.long="search" type="text" class="filter" placeholder="Search for Email or Name">
            </div>
            <div class="col-span-2 filter-box">
                <label for="user_type" class="filter">User Type</label>
                <select id="user_type" wire:model.live.delay="user_type" class="filter">
                    <option value="">Please select</option>
                    <option value="ADMIN">Admin</option>
                    <option value="USER_LEVEL_1">User Level 1</option>
                    <option value="USER_LEVEL_2">User Level 2</option>
                </select>
            </div>
        </div>
    </div>

    <!-- headers -->
    <div class="list-data-container">
        <div class="grid grid-cols-12">
            <div wire:click="sortBy('first_name')" class="grid col-span-2 header sortable">First Name
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15 12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                </svg>
            </div>
            <div wire:click="sortBy('last_name')" class="grid col-span-2 header sortable">Last Name
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15 12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                </svg>
            </div>
            <div wire:click="sortBy('email')" class="grid col-span-2 header sortable">Email
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15 12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                </svg>
            </div>
            <div wire:click="sortBy('user_type')" class="grid col-span-1 header sortable text-center">User Type
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15 12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                </svg>
            </div>
            <div wire:click="sortBy('last_login')" class="grid col-span-1 header sortable text-center">Last Login
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15 12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                </svg>
            </div>
            <div wire:click="sortBy('created_on')" class="grid col-span-2 header sortable text-center">Created On
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15 12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                </svg>
            </div>
            <div class="grid col-span-2 header"></div>
        </div>

        @foreach ( $records as $record )
            <div class="grid grid-cols-12">
                <div class="grid col-span-2 data-cell">{{ $record->first_name }}</div>
                <div class="grid col-span-2 data-cell">{{ $record->last_name }} </div>
                <div class="grid col-span-2 data-cell">{{ $record->email }}</div>
                <div class="grid col-span-1 data-cell text-center">{{ $record->user_type }}</div>
                <div class="grid col-span-1 data-cell text-center">{{ $record->last_login ? $record->last_login->format("d/m/Y H:i") : "" }}</div>
                <div class="grid col-span-2 data-cell text-center">{{ $record->created_at->format("d/m/Y") }}</div>
                <div class="grid col-span-2 data-cell buttons">
                    <button data-modal-target="delete-modal-{{$record->id}}" data-modal-toggle="delete-modal-{{$record->id}}" class="btn btn-red delete-button">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                        </svg>
                    </button>
                    @include('/components/delete_modal',['recordId' => $record->id])
                </div>
            </div>
        @endforeach
    </div>

    <div class="list-page-links">
        {{ $records->links() }}
    </div>
</div>