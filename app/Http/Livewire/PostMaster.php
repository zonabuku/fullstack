<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Illuminate\Pagination\LengthAwarePaginator;

// DIKERJAKAN BACKEND DEVELOPER :( 
class PostMaster extends Component
{
    use WithFileUploads;
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $userId, $title, $body, $postId, $postss;
    public $post_edit_id;
    public $post_delete_id;

    public $searchUserId;

    public function create()
    {
        $data = [
        'title' => $this->title,
        'body' => $this->body,
        'userId' => 1,
        ];

    $response = Http::post('https://jsonplaceholder.typicode.com/posts', $data);
    if ($response->successful()) {
        $this->resetInputs();
        $this->dispatchBrowserEvent('close-modal');
        session()->flash('message', 'Data baru berhasil ditambahkan');
        }
    }

    public function edit($postId)
    {
        $post = Http::get('https://jsonplaceholder.typicode.com/posts/' . $postId)->json();
        $this->post_edit_id = $post['id']; 
        $this->userId = $post['userId'];
        $this->title = $post['title'];
        $this->body = $post['body'];
        $this->dispatchBrowserEvent('show-edit-modal');
    }

    public function update()
    {
        $response = Http::put('https://jsonplaceholder.typicode.com/posts/'.$this->postId, [
            'title' => $this->title,
            'body' => $this->body,
            'userId' => $this->userId,
        ]);
        session()->flash('message', "Data *$this->title berhasil diperbarui");
        $this->resetInputs();
        $this->dispatchBrowserEvent('close-modal');
    }

   public function resetInputs()
    {
        $this->userId = '';
        $this->title = '';
        $this->body = '';
    }

    public function close()
    {
        $this->resetInputs();
    }

    public function deleteConfirmation($postId)
    {
        $this->post_delete_id = $postId;
        $this->dispatchBrowserEvent('show-delete-confirmation-modal');
    }

    public function destroy()
    {
        $response = Http::delete('https://jsonplaceholder.typicode.com/posts/'.$this->post_delete_id);
        if ($response->successful()) {
            $this->resetInputs();
            $this->dispatchBrowserEvent('close-modal');
            session()->flash('message', 'Data berhasil dihapus');
        }
    }
  

    public function render()
    {
        $posts = Http::get('https://jsonplaceholder.typicode.com/posts')->json();
        $users = Http::get('https://jsonplaceholder.typicode.com/users')->json();
        $userMapping = collect($users)->keyBy('id');

        foreach ($posts as $key => $post) {
            $userId = $post['userId'];
            $userName = $userMapping->get($userId)['name'];
            $posts[$key]['username'] = $userName;
        }

        $perPage = 10;
    
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentPageItems = collect($posts)->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $posts = new LengthAwarePaginator($currentPageItems, count($posts), $perPage);

        return view('livewire.post-master', ['posts' => $posts])->layout('livewire.layouts.app', ['title' => 'Post Manager']);
        }

        
    // public function render()
    // {
    //     $posts = Http::get('https://jsonplaceholder.typicode.com/posts')->json();
    //     $users = Http::get('https://jsonplaceholder.typicode.com/users')->json();
    //     $userMapping = collect($users)->keyBy('id');
    
    //     if ($this->searchUserId) {
    //         $posts = collect($posts)->where('userId', $this->searchUserId)->all();
    //     }
    
    //     foreach ($posts as $key => $post) {
    //         $userId = $post['userId'];
    //         $userName = $userMapping->get($userId)['name'];
    //         $posts[$key]['username'] = $userName;
    //     }
    
    //     $perPage = $this->paginate;
        
    //     $currentPage = LengthAwarePaginator::resolveCurrentPage();
    //     $currentPageItems = collect($posts)->slice(($currentPage - 1) * $perPage, $perPage)->all();
    //     $posts = new LengthAwarePaginator($currentPageItems, count($posts), $perPage);
    
    //     return view('livewire.post-master', ['posts' => $posts])->layout('livewire.layouts.app', ['title' => 'Post Manager']);
    // }


    // public function getLatestData()
    // {
    //     $response = Http::get('https://jsonplaceholder.typicode.com/posts', [
    //         '_sort' => 'id',
    //         '_order' => 'desc',
    //         '_limit' => $this->paginate, 
    //     ]);

    //     return $response->json();
    // }
}
