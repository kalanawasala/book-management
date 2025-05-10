<?php

namespace App\Policies;

use Modules\V1\Entities\Book;
use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\V1\Entities\User;

class BookPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \Modules\V1\Entities\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \Modules\V1\Entities\User  $user
     * @param  \App\Book  $book
     * @return mixed
     */
    public function view(User $user, Book $book)
    {
        return $user->id === $book->user_id;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \Modules\V1\Entities\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->roles === 'admin';
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \Modules\V1\Entities\User  $user
     * @param  \App\Book  $book
     * @return mixed
     */
    public function update(User $user, Book $book)
    {
        return $user->id == $book->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \Modules\V1\Entities\User  $user
     * @param  \App\Book  $book
     * @return mixed
     */
    public function delete(User $user, Book $book)
    {
        return $user->can('Delete Post') && $user->id === $book->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \Modules\V1\Entities\User  $user
     * @param  \App\Book  $book
     * @return mixed
     */
    public function restore(User $user, Book $book)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \Modules\V1\Entities\User  $user
     * @param  \App\Book  $book
     * @return mixed
     */
    public function forceDelete(User $user, Book $book)
    {
        //
    }
}
