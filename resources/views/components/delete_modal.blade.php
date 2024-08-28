<div id="delete-modal-{{$recordId}}" tabindex="-1" class="hidden md:inset-0 h-[calc(100%-1rem)] delete-modal">
    <div class="p-4 max-w-md outer-container">
        <div class="dark:bg-gray-700 inner-container">
            <button type="button" class="close-button dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="delete-modal-{{$recordId}}">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="message-container p-4 md:p-5">
                <svg class="dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                </svg>
                <h3 class="message-text dark:text-gray-400">Are you sure you want to delete this record?</h3>
                <button wire:click="deleteRecord({{$recordId}})" data-modal-hide="delete-modal-{{$recordId}}" type="button" class="yes-button dark:focus:ring-red-800">
                    Yes
                </button>
                <button data-modal-hide="delete-modal-{{$recordId}}" type="button" class="no-button dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">No</button>
            </div>
        </div>
    </div>
</div>