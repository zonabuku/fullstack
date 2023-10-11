<div>
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            {{-- <div class="search-icon-box card-box mb-30">
                <input wire:model.debounce.500ms="searchUserId" type="text" class="border-radius-10" id="filter_input"
                    placeholder="Search by User ID..." title="Type in a name">
                <i class="search_icon dw dw-search"></i>
            </div> --}}

            @if (session()->has('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('message') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                
            </div>
            @endif

            <div class="pd-20 card-box mb-30">
                <div class="clearfix mb-20">
                    <div class="pull-left">
                        <h4 class="text-blue h4">POST LIST</h4>
                        <select wire:model="paginate" class="form-control form-control-sm w-auto">
                            <option value="5">Show 5 data</option>
                            <option value="10">Show 10 data</option>
                            <option value="50">Show 50 data</option>
                            <option value="100">Show 100 data</option>
                        </select>
                    </div>
                    <div class="pull-right">
                        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addModal"><i
                                class="fa fa-plus"></i> Add</button>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="data-table table nowrap table-bordered">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Post By</th>
                                <th>Title</th>
                                <th>Body</th>
                                <th class="datatable-nosort">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($posts as $index => $post)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $post['username'] }}</td>
                                <td>{{ $post['title'] }}</td>
                                <td>{{ $post['body'] }}</td>

                                <td>
                                    <div class="dropdown">
                                        <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                                            role="button" data-toggle="dropdown" aria-expanded="false">
                                            <i class="dw dw-more"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                            <button class="dropdown-item"><i
                                                    class="dw dw-eye"></i> Detail
                                            </button>

                                            <button class="dropdown-item" wire:click="edit({{ $post['id'] }})">
                                                <i class="dw dw-edit2"></i> Edit
                                            </button>
                                            <button class="dropdown-item" wire:click="deleteConfirmation({{ $post['id'] }})"><i
                                                    class="dw dw-delete-3"></i> Hapus
                                            </button>

                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                           
                        </tbody>
                    </table>
                </div>

                {{-- @unless ($this->searchUserId) --}}
                <div class="clearfix">
                    <div class="pull-right">
                        <p class="text-blue">{{ $posts->links() }}</p>
                    </div>
                </div>
                {{-- @endunless --}}

            </div>
        </div>
    </div>

    <div wire:ignore.self class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="addLabel">Add Data</h6>
                    <button wire:click="close" type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row clearfix">
                        <div class="col-md-12 col-sm-12 ">
                            <div class="pd-20 height-100-p">
                                <form wire:submit.prevent="create">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12">
                                            <div class="form-group">
                                                <label for="UserID">POST BY</label>
                                                <input id="UserID" class="form-control" type="text" wire:model="userId" disabled>
                                                @error('userId')
                                                <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="title">TITLE</label>
                                                <input id="title" class="form-control" type="text" wire:model="title">
                                                @error('title')
                                                <span class="text-danger"
                                                    style="font-size: 11.5px;">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        
                                            <div class="form-group">
                                                <label for="body">BODY</label>
                                                <input id="body" class="form-control" type="text" wire:model="body">
                                                @error('body')
                                                <span class="text-danger"
                                                    style="font-size: 11.5px;">{{ $message }}</span>
                                                @enderror
                                            </div>
                                           
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary mr-2" wire:loading.attr="disabled">
                                        <div wire:loading wire:target="create" wire:key="create"><i
                                                class="fa fa-spinner fa-spin"></i></div> Save
                                    </button>
                                    <button wire:click="close" class="btn btn-light" data-dismiss="modal"
                                        aria-label="Close">
                                        <span aria-hidden="true">Cancel</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div wire:ignore.self class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="editLabel">Edit</h6>
                    <button wire:click="close" type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row clearfix">
                        <div class="col-md-12 col-sm-12 ">
                            <div class="pd-20 height-100-p">
                                <form wire:submit.prevent="update">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12">
                                            <div class="form-group">
                                                <label for="EditName">USER ID</label>
                                                <input id="EditName" class="form-control" type="text" wire:model="userId">
                                                @error('userId')
                                                <span class="text-danger"
                                                    style="font-size: 11.5px;">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="EditNPSN">TITLE</label>
                                                <input id="EditNPSN" class="form-control" type="text" wire:model="title">
                                                @error('title')
                                                <span class="text-danger"
                                                    style="font-size: 11.5px;">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="EditNPSN">Body</label>
                                                <input id="EditNPSN" class="form-control" type="text" wire:model="body">
                                                @error('body')
                                                <span class="text-danger"
                                                    style="font-size: 11.5px;">{{ $message }}</span>
                                                @enderror
                                            </div>

                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary mr-2" wire:loading.attr="disabled">
                                        <div wire:loading wire:target="update" wire:key="update"><i
                                                class="fa fa-spinner fa-spin"></i></div> Edit
                                    </button>
                                    <button wire:click="close" class="btn btn-light" data-dismiss="modal"
                                        aria-label="Close">
                                        <span aria-hidden="true">Cancel</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div wire:ignore.self class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body text-center font-18">
                    <h4 class="padding-top-30 mb-30 weight-500">Anda yakin ingin menghapus data?</h4>
                    <div class="padding-bottom-30 row" style="max-width: 170px; margin: 0 auto;">
                        <div class="col-6">
                            <button wire:click="cancel()" type="button"
                                class="btn btn-secondary border-radius-100 btn-block confirmation-btn"
                                data-dismiss="modal"><i class="fa fa-times"></i></button>
                            Cancel
                        </div>
                        <div class="col-6">
                            <button wire:click="destroy()" type="button"
                                class="btn btn-primary border-radius-100 btn-block confirmation-btn"
                                data-dismiss="modal"><i class="fa fa-check"></i></button>
                            Yes
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@push('js')
<script>
   
    window.addEventListener('close-modal', event => {
        $('#addModal').modal('hide');
        $('#editModal').modal('hide');
        $('#deleteModal').modal('hide');

    });
    window.addEventListener('show-edit-modal', event => {
        $('#editModal').modal('show');
    });
    window.addEventListener('show-delete-confirmation-modal', event => {
        $('#deleteModal').modal('show');
    });
    window.addEventListener('show-view-modal', event => {
        $('#viewModal').modal('show');
    });

</script>
@endpush
