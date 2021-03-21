<div wire:ignore.self class="modal fade" id="mdl_create" tabindex="-1" role="dialog" aria-labelledby="create_modal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="create_modal">Create</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" wire:click="clearAndCloseModal">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form wire:submit.prevent="store">
                    <div class="form-group">
                        <label for="name">Product Name: <span class="text-danger">*</span></label>
                        <input wire:model.defer="name" type="text" class="form-control @error('name') is-invalid @enderror">
                        @include('components.error', ['field' => 'name'])
                    </div>
                    <div class="form-group">
                        <label for="photo">Photo: <span class="text-danger">*</span></label>
                        <div class="@error('photo') border border-danger rounded @enderror">
                            <div id="file_upload_create" class="fileinput fileinput-new input-group mb-0" wire:ignore wire:key="photo" data-provides="fileinput">
                                <div class="form-control" data-trigger="fileinput">
                                    <span class="fileinput-filename"></span>
                                </div>
                                <span class="input-group-append">
                                    <span class="input-group-text fileinput-exists" data-dismiss="fileinput">
                                        Remove
                                    </span>
                                    <span class="input-group-text btn-file">
                                        <span class="fileinput-new">Select file</span>
                                        <span class="fileinput-exists">Change</span>
                                        <input type="file" accept="image/*" wire:model.defer="photo">
                                    </span>
                                </span>
                            </div>
                        </div>
                        @include('components.error', ['field' => 'photo'])
                    </div>
                    <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea wire:model.defer="description" class="form-control  @error('description') is-invalid @enderror" placeholder="Description"></textarea>
                        @include('components.error', ['field' => 'description'])
                    </div>
                    <div class="form-group">
                        <label for="price">Price: <span class="text-danger">*</span></label>
                        <input wire:model.defer="price" type="number" class="form-control @error('price') is-invalid @enderror" min="0">
                        @include('components.error', ['field' => 'price'])
                    </div>
                    <div class="form-group">
                        <label for="price">Quantity: <span class="text-danger">*</span></label>
                        <input wire:model.defer="quantity" type="number" class="form-control @error('quantity') is-invalid @enderror" min="0">
                        @include('components.error', ['field' => 'quantity'])
                    </div>
                    <button class="btn btn-outline-primary" type="submit">Create</button>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $(function() {
            $('#file_upload_create').on('clear.bs.fileinput', function() {
                @this.set('photo', null);
            });

            $('#file_upload_create').on('reset.bs.fileinput', function() {
                @this.set('photo', null);
            });

            @this.on('clearFileInput', function() {
                $('#file_upload_create').fileinput('clear');
            });

            var invalidChars = ['-', 'e', '+', 'E'];

            $('input[type="number"]').on('keydown', function(e) {
                if (invalidChars.includes(e.key)) {
                    e.preventDefault();
                }
            });

            @this.on('closeModal', function() {
                $('#mdl_create').modal('hide');
            });
        });

    </script>
@endpush
