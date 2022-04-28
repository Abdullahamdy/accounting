<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class Home extends Component
{
    public function render()
    {
        $admins = User::whereHas('roles', function ($q){
            return $q->where('name', 'Admin');
        })->get();

        $suppliers = User::whereHas('roles', function ($q){
            return $q->where('name', 'Supplier');
        })->get();

        $customers = User::whereHas('roles', function ($q){
            return $q->where('name', 'Customer');
        })->get();

        $employees = User::whereHas('roles', function ($q){
            return $q->where('name', 'Employee');
        })->get();

        $servants = User::whereHas('roles', function ($q){
            return $q->where('name', 'Servant');
        })->get();

        return view('livewire.home', compact('admins', 'suppliers', 'customers', 'employees', 'servants'));
    }
}
