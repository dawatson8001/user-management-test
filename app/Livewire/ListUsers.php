<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class ListUsers extends Component
{
    use WithPagination;

    public $search = "";
    public $user_type;
    public $sortField = "id";
    public $sortDirection = 'asc';

    protected $queryString = ['sortField', 'sortDirection'];

    public function render()
    {
        $users = User::select("id", "first_name", "last_name", "user_type", "email", "last_login", "created_at")
        ->when($this->search, function($query, $search) {
            return $query->where(function($query) use ($search) {
                $query->where("fisrt_name", "LIKE", "%$search%")
                      ->orWhere("last_name", "LIKE", "%$search%")
                      ->orWhere("email", "LIKE", "%$search%");
            });
        })
        ->when($this->user_type, function($query, $user_type) {
            return $query->where("user_type", $user_type);
        })
        ->orderBy($this->sortField, $this->sortDirection)
        ->paginate(25);

        return view('livewire.list-users',[
            'records' => $users,
        ]);
    }

    public function sortBy($field)
    {
        if( $this->sortField === $field ) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortField = $field;
    }

    public function deleteRecord(int $userId)
    {
        if( isset($userId) ) {
            $user = User::findOrFail($userId);
            $user->delete();
        }
    }
}
