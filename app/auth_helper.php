<?php
    use Illuminate\Support\Facades\Auth;
    use App\Models\User;

    function current_user(): ?User
    {
        return Auth::user();
    }
?>